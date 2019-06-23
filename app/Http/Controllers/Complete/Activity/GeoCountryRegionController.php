<?php namespace App\Http\Controllers\Complete\Activity;

use App\Http\Controllers\Controller;
use App\Services\Activity\ActivityManager;
use App\Services\Activity\GeoCountryRegionManager;
use App\Services\FormCreator\Activity\GeoCountryRegion;
use App\Services\RequestManager\Activity\GeoCountryRegionRequestManager;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Class TitleController
 * Contains functions which allow user to add and update Activity Title
 * @package app\Http\Controllers\Complete\Activity
 */
class GeoCountryRegionController extends Controller
{
    /**
     * @var Title
     */
    protected $geoCountryRegion;
    /**
     * @var TitleManager
     */
    protected $geoCountryRegionManager;

    /**
     * @var ActivityManager
     */
    protected $activityManager;


    /**
     * @param TitleManager    $titleManager
     * @param Title           $title
     * @param ActivityManager $activityManager
     */
    function __construct(GeoCountryRegionManager $geoCountryRegionManager, GeoCountryRegion $geoCountryRegion, ActivityManager $activityManager)
    {
        $this->middleware('auth');
        $this->geoCountryRegion           = $geoCountryRegion;
        $this->geoCountryRegionManager    = $geoCountryRegionManager;
        $this->activityManager = $activityManager;
    }

    /**
     * returns the activity title edit form
     * @param $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $activityData = $this->activityManager->getActivityData($id);

        if (Gate::denies('ownership', $activityData)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }

        $activityScope = $this->geoCountryRegionManager->getActivityScopeData($id);
        $activityRecipientCountry = $this->geoCountryRegionManager->getRecipientCountryData($id);
        $activityRecipientRegion = $this->geoCountryRegionManager->getRecipientRegionData($id);
        $form = $this->geoCountryRegion->editForm($activityScope,$activityRecipientCountry,$activityRecipientRegion, $id);
        return view(
            'Activity.geoCountryRegion.edit',
            compact('form', 'id', 'activityData')
        );
    }

    /**
     * updates activity title
     * @param                     $id
     * @param Request             $request
     * @param TitleRequestManager $titleRequestManager
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request, GeoCountryRegion $geoCountryRegion)
    {
        if (!$this->currentUserIsAuthorizedForActivity($id)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }
        $data = $request->all();
        $data = $data['geoCountryRegion'][0];
        //Activity Title handler
        $dataToBeSaved['activity_scope'] = $data['activityScope'][0]['activity_scope'];
        //Activity date handler
        $dataToBeSaved['recipient_country'] = [];
        $dataToBeSaved['recipient_country'] = $data['activityRecipientCountry'][0]['recipient_country'];
        $dataToBeSaved['recipient_region'] = $data['activityRecipientRegion'][0]['recipient_region'];
        //Validate form data
        $messages = $this->validateData($dataToBeSaved);
        if ($messages) {
            $response = ['type' => 'danger', 'messages' => array_unique($messages)];

            return redirect()->back()->withInput()->withResponse($response);
        }
        foreach($dataToBeSaved['recipient_country'] as $countryIndex => $countryVal){
            if(strlen($countryVal['country_code']) == 0 || strlen($countryVal['percentage']) == 0){
                unset($dataToBeSaved['recipient_country'][$countryIndex]);
            }
        }
        foreach($dataToBeSaved['recipient_region'] as $regionIndex => $regionVal){
            if(strlen($regionVal['region_code']) == 0 || strlen($regionVal['percentage']) == 0){
                unset($dataToBeSaved['recipient_region'][$regionIndex]);
            }
        }
        //$dataToBeSaved['activity_status']
        //Activity date handler ends here
        $activityData = $this->activityManager->getActivityData($id);
        $this->authorizeByRequestType($activityData, 'title');
        if ($this->geoCountryRegionManager->update($dataToBeSaved, $activityData)) {
            $this->activityManager->resetActivityWorkflow($id);
            $response = ['type' => 'success', 'code' => ['updated', ['name' => trans('title.title')]]];

            return redirect()->to(sprintf('/activity/%s', $id))->withResponse($response);
        }
        $response = ['type' => 'danger', 'code' => ['update_failed', ['name' => trans('title.title')]]];

        return redirect()->back()->withInput()->withResponse($response);
    }

    private function validateData($activityData){
        $messages = [];
        $percentageCheck = 0;
        if(strlen($activityData['activity_scope']) == 0){
            //Removing the requirement check because this field is not needed as a manadatory field anymore
            //array_push($messages, 'Activity scope cannot be left empty');
        }
        // For Country data
        foreach($activityData['recipient_country'] as &$country){
            if(strlen($country['country_code']) != 0 || strlen($country['percentage']) != 0){
                if(strlen($country['country_code']) == 0){
                    array_push($messages, 'Country Code cannot be left empty');
                }
                else if(strlen($country['percentage']) == 0){
                    array_push($messages, 'Country Code cannot be left empty');   
                }
                else if(!is_numeric($country['percentage'])){
                    array_push($messages, 'Please enter a valid percentage amount for country');
                }
                else{
                    $percentageCheck = $percentageCheck + (int)$country['percentage'];
                }
            }
        }
        // For Region data
        foreach($activityData['recipient_region'] as &$region){
            if(strlen($region['region_code']) != 0 || strlen($region['percentage']) != 0){
                if(strlen($region['region_code']) == 0){
                    array_push($messages, 'Region Code cannot be left empty');
                }
                else if(strlen($region['percentage']) == 0){
                    array_push($messages, 'Region Code cannot be left empty');   
                }
                else if(!is_numeric($region['percentage'])){
                    array_push($messages, 'Please enter a valid percentage amount for region');
                }
                else{
                    $percentageCheck = $percentageCheck + (int)$region['percentage'];
                }
            }
        }
        if($percentageCheck > 100){
            array_push($messages, 'The summation of total percentage must be 100. You have exceeded the 100 percentage by '. ($percentageCheck - 100) . '%. Please, fix it.');
        }
        else if($percentageCheck < 100){
            array_push($messages, 'The summation of total percentage must be 100. You still need to distribute the remaining '. (100 - $percentageCheck) . '%. Please, fix it.');   
        }
        return $messages;
    }
}

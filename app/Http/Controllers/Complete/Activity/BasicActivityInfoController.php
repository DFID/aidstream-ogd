<?php namespace App\Http\Controllers\Complete\Activity;

use App\Http\Controllers\Controller;
use App\Services\Activity\ActivityManager;
use App\Services\Activity\BasicActivityInfoManager;
use App\Services\FormCreator\Activity\BasicActivityInfo;
use App\Services\RequestManager\Activity\BasicActivityInfoRequestManager;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Class TitleController
 * Contains functions which allow user to add and update Activity Title
 * @package app\Http\Controllers\Complete\Activity
 */
class BasicActivityInfoController extends Controller
{
    /**
     * @var Title
     */
    protected $basicActivityInfo;
    /**
     * @var TitleManager
     */
    protected $basicActivityInfoManager;

    /**
     * @var ActivityManager
     */
    protected $activityManager;


    /**
     * @param TitleManager    $titleManager
     * @param Title           $title
     * @param ActivityManager $activityManager
     */
    function __construct(BasicActivityInfoManager $basicActivityInfoManager, BasicActivityInfo $basicActivityInfo, ActivityManager $activityManager)
    {
        $this->middleware('auth');
        $this->basicActivityInfo           = $basicActivityInfo;
        $this->basicActivityInfoManager    = $basicActivityInfoManager;
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

        $activityTitle = $this->basicActivityInfoManager->getTitleData($id);
        $activityDate = $this->basicActivityInfoManager->getActivityDateData($id);
        $activityStatus = $this->basicActivityInfoManager->getActivityStatusData($id);
        $activityDescription = $this->basicActivityInfoManager->getDescriptionData($id);
        $budget = $this->basicActivityInfoManager->getbudgetData($id);
        $humScopeData = $this->basicActivityInfoManager->getActivityHumanitarianScopeData($id);
        $form          = $this->basicActivityInfo->editForm($activityTitle,$activityDate,$activityStatus, $activityDescription, $budget, $humScopeData, $id);
        return view(
            'Activity.basicActivityInfo.edit',
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
    public function update($id, Request $request, BasicActivityInfoManager $basicActivityInfoManager)
    {
        if (!$this->currentUserIsAuthorizedForActivity($id)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }
        $data = $request->all();
        $data = $data['basicActivityInfo'][0];
        //Activity Title handler
        $dataToBeSaved['title'] = [];
        $dataToBeSaved['title'] = $data['title'][0];
        //Activity date handler
        $dataToBeSaved['activity_date'] = [];
        $dataToBeSaved['activity_date'][0]['date'] = $data['activityDate'][0]['date_planned_start'];
        $dataToBeSaved['activity_date'][0]['type'] = $data['activityDate'][0]['type_planned_start'];
        $dataToBeSaved['activity_date'][0]['narrative'][0]['narrative'] = '';
        $dataToBeSaved['activity_date'][0]['narrative'][0]['language'] = '';
        $dataToBeSaved['activity_date'][1]['date'] = $data['activityDate'][0]['date_planned_end'];
        $dataToBeSaved['activity_date'][1]['type'] = $data['activityDate'][0]['type_planned_end'];
        $dataToBeSaved['activity_date'][1]['narrative'][0]['narrative'] = '';
        $dataToBeSaved['activity_date'][1]['narrative'][0]['language'] = '';
        //Only fill in actual start date if the planned start date is older than current start date
        if($data['activityDate'][0]['date_planned_start'] < date("Y-m-d")){
            $tempData = array();
            $tempData['date'] = $data['activityDate'][0]['date_planned_start'];
            $tempData['type'] = 2;
            $tempData['narrative'][0]['narrative'] = '';
            $tempData['narrative'][0]['language'] = '';
            array_push($dataToBeSaved['activity_date'], $tempData);
        }
        //Only fill in actual end date if the planned end date is older than current end date
        if($data['activityDate'][0]['date_planned_end'] < date("Y-m-d")){
            $tempData = array();
            $tempData['date'] = $data['activityDate'][0]['date_planned_end'];
            $tempData['type'] = 4;
            $tempData['narrative'][0]['narrative'] = '';
            $tempData['narrative'][0]['language'] = '';
            array_push($dataToBeSaved['activity_date'], $tempData);
        }
        //$dataToBeSaved['activity_status'] = $data['activityStatus'][0]['activity_status'];
        if($data['activityDate'][0]['date_planned_start'] > date("Y-m-d")){
            $dataToBeSaved['activity_status'] = 1;
        }
        elseif($data['activityDate'][0]['date_planned_start'] < date("Y-m-d") && $data['activityDate'][0]['date_planned_end'] > date("Y-m-d")){
            $dataToBeSaved['activity_status'] = 2;   
        }
        else{
            $dataToBeSaved['activity_status'] = 4;   
        }
        $dataToBeSaved['description'] = [];
        $dataToBeSaved['description'] = $data['activityDescription'];
        foreach($data['budget'] as &$budget){
            $budget['value'][0]['value_date'] = $budget['period_start'][0]['date'];
        }
        $dataToBeSaved['budget'] = $data['budget'];
        $dataToBeSaved['humanitarian_scope'] = [];
        foreach($data['humanitarian_scope'][0]['humanitarian_scope_emergency'] as &$emergencyData){
            if(strlen($emergencyData['code']) > 0){
                array_push($dataToBeSaved['humanitarian_scope'],$emergencyData);
            }
        }
        foreach($data['humanitarian_scope'][0]['humanitarian_scope_appeal'] as &$appealData){
            if(strlen($appealData['code']) > 0){
                array_push($dataToBeSaved['humanitarian_scope'],$appealData);
            }
        }
        //$dataToBeSaved['activity_status']
        //Activity date handler ends here
        //Data validation goes here
        $messages     = $this->validateData($dataToBeSaved);
        if ($messages) {
            $response = ['type' => 'danger', 'messages' => array_unique($messages)];

            return redirect()->back()->withInput()->withResponse($response);
        }
        foreach($dataToBeSaved['budget'] as $budgetIndex => $budgetVal){
            if($budgetVal['value'][0]['amount'] == ''){
                unset($dataToBeSaved['budget'][$budgetIndex]);
            }
        }
        $activityData = $this->basicActivityInfoManager->getActivityData($id);
        $this->authorizeByRequestType($activityData, 'title');
        if ($this->basicActivityInfoManager->update($dataToBeSaved, $activityData)) {
            $this->activityManager->resetActivityWorkflow($id);
            $response = ['type' => 'success', 'code' => ['updated', ['name' => trans('title.title')]]];

            return redirect()->to(sprintf('/activity/%s', $id))->withResponse($response);
        }
        $response = ['type' => 'danger', 'code' => ['update_failed', ['name' => trans('title.title')]]];

        return redirect()->back()->withInput()->withResponse($response);
    }

    private function validateData($activityData){
        $messages = [];
        if(strlen($activityData['title']['narrative'][0]['narrative']) == 0){
            //$messages['basicActivityInfo.0.title.0.narrative.0.narrative.required'] = 'Activity Title cannot be empty';
            array_push($messages, 'Activity Title cannot be empty');
        }
        if(strlen($activityData['activity_date'][0]['date']) == 0 || strlen($activityData['activity_date'][1]['date']) == 0){
            //$messages['dates'] = 'Activity Dates cannot be empty';
            array_push($messages, 'Activity Dates cannot be empty');   
        }
        if($activityData['activity_date'][0]['date'] > $activityData['activity_date'][1]['date']){
            array_push($messages, 'Planned end date cannot be older than planned start date.');
            //$messages['date_comparison'] = 'Planned end date cannot be older than planned start date.';
        }
        if($activityData['activity_status'] == ''){
            array_push($messages, 'Activity status cannot be left empty.');
            //$messages['activity_status'] = 'Activity status cannot be left empty.';   
        }
        foreach($activityData['budget'] as &$budget){
            if(strlen($budget['period_start'][0]['date']) > 0 || strlen($budget['period_end'][0]['date']) > 0 || strlen($budget['value'][0]['amount']) > 0){
                if(strlen($budget['period_start'][0]['date']) == 0 || strlen($budget['period_end'][0]['date']) == 0 || strlen($budget['value'][0]['amount']) == 0){
                    //$messages['budget_status'] = 'Please complete budget ';
                    array_push($messages, 'One or more of the budget fields is left empty.');
                }
            }
        }
        return $messages;
    }
}

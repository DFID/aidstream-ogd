<?php namespace App\Http\Controllers\Complete\Activity;

use App\Core\V201\Traits\GetCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Services\Activity\ActivityManager;
use App\Services\Activity\ParticipatingOrganizationManager;
use App\Services\FormCreator\Activity\ParticipatingOrganization as ParticipatingOrganizationForm;
use App\Services\RequestManager\Activity\ParticipatingOrganization as ParticipatingOrganizationRequestManager;
use Illuminate\Support\Facades\Gate;
use App\Core\Form\BaseForm;

/**
 * Class ParticipatingOrganizationController
 * @package app\Http\Controllers\Complete\Activity
 */
class ParticipatingOrganizationController extends Controller
{
    use GetCodes;

    /**
     * @var ActivityManager
     */
    protected $activityManager;
    /**
     * @var ParticipatingOrganizationForm
     */
    protected $participatingOrganizationForm;
    /**
     * @var ParticipatingOrganizationManager
     */
    protected $participatingOrganizationManager;

    protected $baseForm;

    /**
     * @param ParticipatingOrganizationManager $participatingOrganizationManager
     * @param ParticipatingOrganizationForm    $participatingOrganizationForm
     * @param ActivityManager                  $activityManager
     */
    function __construct(
        ParticipatingOrganizationManager $participatingOrganizationManager,
        ParticipatingOrganizationForm $participatingOrganizationForm,
        ActivityManager $activityManager,
        BaseForm $baseForm
    ) {
        $this->middleware('auth');
        $this->activityManager                  = $activityManager;
        $this->participatingOrganizationForm    = $participatingOrganizationForm;
        $this->participatingOrganizationManager = $participatingOrganizationManager;
        $this->baseForm = $baseForm;
    }

    /**
     * returns the activity contact info edit form
     * @param $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $activityData = $this->activityManager->getActivityData($id);

        if (Gate::denies('ownership', $activityData)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }
        
        if(Session('version') == 'V203'){
            $getCrsChannelCode = $this->baseForm->getCodeList('CRSChannelCode', 'Activity');
        } else {
            $getCrsChannelCode = [];
        }
        
        $participatingOrganization  = $this->participatingOrganizationManager->getParticipatingOrganizationData($id);
        $form                       = $this->participatingOrganizationForm->editForm($participatingOrganization, $id);
        $organizationTypes     = $this->getNameWithCode('Activity', 'OrganisationType');
        $organizationRoles     = $this->getNameWithCode('Activity', 'OrganisationRole');
        $partnerOrganizations  = $this->participatingOrganizationManager->getPartnerOrganizations(session('org_id'))->toArray();
        $reportingOrganisation = $activityData->organization->toArray();
        $reportingOrgData      = [
            'name'         => array_get($reportingOrganisation, 'reporting_org.0.narrative'),
            'identifier'   => array_get($reportingOrganisation, 'reporting_org.0.reporting_organization_identifier'),
            'country'      => array_get($reportingOrganisation, 'country'),
            'type'         => array_get($reportingOrganisation, 'reporting_org.0.reporting_organization_type'),
            'id'           => $activityData->organization->orgData()->where('is_reporting_org', true)->pluck('id')->first(),
            'is_publisher' => false
        ];

        array_push($partnerOrganizations, $reportingOrgData);

        $countries                  = $this->getNameWithCode('Organization', 'Country');
        $participatingOrganizations = $activityData->participating_organization;

        foreach ((array) $participatingOrganizations as $index => $organization) {
            (array_key_exists('country', $organization)) ?: $participatingOrganizations[$index]['country'] = '';
        }

        if ($participatingOrganizations) {
            $participatingOrganizations = array_values($participatingOrganizations);
        }

        return view(
            'Activity.participatingOrganization.edit',
            compact('form', 'activityData', 'id', 'participatingOrganizations', 'organizationRoles', 'organizationTypes', 'countries', 'partnerOrganizations','getCrsChannelCode')
        );
    }

    /**
     * updates activity participating organization
     * @param                                         $id
     * @param Request                                 $request
     * @param ParticipatingOrganizationRequestManager $participatingOrganizationRequestManager
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request, ParticipatingOrganizationRequestManager $participatingOrganizationRequestManager)
    {
        $tempData = $request->all();
        info($tempData);
        $activityData = $this->activityManager->getActivityData($id);

        if (Gate::denies('ownership', $activityData)) {
            return response()->json($this->getNoPrivilegesMessage(), 500);
        }

        $this->authorizeByRequestType($activityData, 'participating_organization');

        // if (!$this->validateData($request->get('participating_organization'))) {
        //     return response()->json(trans('V201/message.participating_org', ['name' => 'participating organization']), 500);
        // }
        $tempData = $request->all();
        $preparedData['participating_organization'] = [];
        if(isset($tempData)){
            if(isset($tempData['participating_organization'][0]['participating_org_accountable'][0]['narrative_accountable']) && strlen($tempData['participating_organization'][0]['participating_org_accountable'][0]['narrative_accountable']) > 0){
                $tdata['organization_role'] = 2;
                $tdata['identifier'] = $tempData['participating_organization'][0]['participating_org_accountable'][0]['identifier_accountable'];
                $tdata['organization_type'] = $tempData['participating_organization'][0]['participating_org_accountable'][0]['organization_type_accountable'];
                $tdata['activity_id'] = '';
                $tdata['crs_channel_code'] = '';
                $tdata['narrative'][0]['narrative'] = $tempData['participating_organization'][0]['participating_org_accountable'][0]['narrative_accountable'];
                $tdata['narrative'][0]['language'] = 'en';
                array_push($preparedData['participating_organization'], $tdata);
            }
            if(isset($tempData['participating_organization'][0]['participating_org_funding'][0]['narrative_funding']) && strlen($tempData['participating_organization'][0]['participating_org_funding'][0]['narrative_funding']) > 0){
                $tdata['organization_role'] = 1;
                $tdata['identifier'] = $tempData['participating_organization'][0]['participating_org_funding'][0]['identifier_funding'];
                $tdata['organization_type'] = $tempData['participating_organization'][0]['participating_org_funding'][0]['organization_type_funding'];
                $tdata['activity_id'] = '';
                $tdata['crs_channel_code'] = '';
                $tdata['narrative'][0]['narrative'] = $tempData['participating_organization'][0]['participating_org_funding'][0]['narrative_funding'];
                $tdata['narrative'][0]['language'] = 'en';
                array_push($preparedData['participating_organization'], $tdata);
            }
            if(isset($tempData['participating_organization'][0]['participating_org_implementing'][0]['narrative_implementing']) && strlen($tempData['participating_organization'][0]['participating_org_implementing'][0]['narrative_implementing']) > 0){
                $tdata['organization_role'] = 4;
                $tdata['identifier'] = $tempData['participating_organization'][0]['participating_org_implementing'][0]['identifier_implementing'];
                $tdata['organization_type'] = $tempData['participating_organization'][0]['participating_org_implementing'][0]['organization_type_implementing'];
                $tdata['activity_id'] = '';
                $tdata['crs_channel_code'] = '';
                $tdata['narrative'][0]['narrative'] = $tempData['participating_organization'][0]['participating_org_implementing'][0]['narrative_implementing'];
                $tdata['narrative'][0]['language'] = 'en';
                array_push($preparedData['participating_organization'], $tdata);
            }
        }
        $participatingOrganization['participating_organization']  = $this->participatingOrganizationManager->managePartnerOrganizations($activityData, $preparedData);

        if (!$participatingOrganization) {
            return response()->json(trans('V201/message.update_failed', ['name' => 'participating organization']), 400);
        }

        if ($this->participatingOrganizationManager->update($participatingOrganization, $activityData)) {
            $this->activityManager->resetActivityWorkflow($id);
            $response = ['type' => 'success', 'code' => ['updated', ['name' => trans('element.participating_organisation')]]];
            return redirect()->to(sprintf('/activity/%s', $id))->withResponse($response);
            //return response()->json(trans('V201/message.updated', ['name' => 'participating organization']), 200);
        }

        return response()->json(trans('V201/message.update_failed', ['name' => 'participating organization']), 500);
    }

    /**
     * validate participating organization data based on roles
     * @param array $data
     * @return bool
     */
    protected function validateData(array $data)
    {
        $check = false;

        foreach ($data as $participatingOrg) {
            $orgRole = $participatingOrg['organization_role'];
            if ($orgRole == "1" || $orgRole == "4") {
                $check = true;
                break;
            }
        }

        return $check;
    }

}

<?php namespace App\Http\Controllers\Complete\Activity;

use App\Http\Controllers\Controller;
use App\Services\Activity\ActivityManager;
use App\Services\Activity\AllDefaultValuesManager;
use App\Services\FormCreator\Activity\AllDefaultValues;
use App\Services\RequestManager\Activity\AllDefaultValuesRequestManager;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Class TitleController
 * Contains functions which allow user to add and update Activity Title
 * @package app\Http\Controllers\Complete\Activity
 */
class AllDefaultValuesController extends Controller
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
    function __construct(AllDefaultValuesManager $allDefaultValuesManager, AllDefaultValues $allDefaultValues, ActivityManager $activityManager)
    {
        $this->middleware('auth');
        $this->allDefaultValues           = $allDefaultValues;
        $this->allDefaultValuesManager    = $allDefaultValuesManager;
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

        $activityCollaborationType = $this->allDefaultValuesManager->getCollaborationTypeData($id);
        $activityFlowType = $this->allDefaultValuesManager->getDefaultFlowTypeData($id);
        $activityFinanceType = $this->allDefaultValuesManager->getDefaultFinanceTypeData($id);
        $activityAidType = $this->allDefaultValuesManager->getDefaultAidTypeData($id);
        $activityTiedStatus = $this->allDefaultValuesManager->getDefaultTiedStatusData($id);
        $form = $this->allDefaultValues->editForm($activityCollaborationType, $activityFlowType, $activityFinanceType, $activityAidType, $activityTiedStatus, $id);
        return view(
            'Activity.allDefaultValues.edit',
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
    public function update($id, Request $request, AllDefaultValues $allDefaultValues)
    {
        if (!$this->currentUserIsAuthorizedForActivity($id)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }
        $data = $request->all();
        $data = $data['allDefaultValues'][0];
        //Activity Title handler
        $dataToBeSaved['collaboration_type'] = $data['collaboration_type'][0]['collaboration_type'];
        $dataToBeSaved['default_flow_type'] = $data['flow_type'][0]['default_flow_type'];
        $dataToBeSaved['default_finance_type'] = $data['finance_type'][0]['default_finance_type'];
        $dataToBeSaved['default_aid_type'] = $data['aid_type'][0]['default_aid_type'];
        $dataToBeSaved['default_tied_status'] = $data['tied_status'][0]['default_tied_status'];
        $activityData = $this->activityManager->getActivityData($id);
        $this->authorizeByRequestType($activityData, 'title');
        if ($this->allDefaultValuesManager->update($dataToBeSaved, $activityData)) {
            $this->activityManager->resetActivityWorkflow($id);
            $response = ['type' => 'success', 'code' => ['updated', ['name' => trans('title.title')]]];

            return redirect()->to(sprintf('/activity/%s', $id))->withResponse($response);
        }
        $response = ['type' => 'danger', 'code' => ['update_failed', ['name' => trans('title.title')]]];

        return redirect()->back()->withInput()->withResponse($response);
    }
}

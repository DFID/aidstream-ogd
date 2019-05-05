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
        $form          = $this->basicActivityInfo->editForm($activityTitle,$activityDate, $id);
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
        //Activity Title handler
        $dataToBeSaved['title'] = [];
        $dataToBeSaved['title'] = $data['title'][0];
        //Activity date handler
        $dataToBeSaved['activity_date'] = [];
        $dataToBeSaved['activity_date'][0]['date'] = $data['activityDate'][0]['date_planned_start'];
        $dataToBeSaved['activity_date'][0]['type'] = $data['activityDate'][0]['type_planned_start'];
        $dataToBeSaved['activity_date'][1]['date'] = $data['activityDate'][0]['date_planned_end'];
        $dataToBeSaved['activity_date'][1]['type'] = $data['activityDate'][0]['type_planned_end'];
        $dataToBeSaved['activity_date'][0]['narrative'][0]['narrative'] = '';
        $dataToBeSaved['activity_date'][0]['narrative'][0]['language'] = '';
        $dataToBeSaved['activity_date'][1]['narrative'][0]['narrative'] = '';
        $dataToBeSaved['activity_date'][1]['narrative'][0]['language'] = '';
        //Activity date handler ends here
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
}

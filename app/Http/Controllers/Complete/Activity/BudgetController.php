<?php namespace App\Http\Controllers\Complete\Activity;

use App\Http\Controllers\Controller;
use App\Services\Activity\BudgetManager;
use App\Services\FormCreator\Activity\Budget as BudgetForm;
use App\Services\Activity\ActivityManager;
use App\Http\Requests\Request;
use App\Services\RequestManager\Activity\Budget as BudgetRequestManager;
use Illuminate\Support\Facades\Gate;

/**
 * Class BudgetController
 * @package App\Http\Controllers\Complete\Activity
 */
class BudgetController extends Controller
{
    /**
     * @var ActivityManager
     */
    protected $activityManager;

    /**
     * @param BudgetManager   $budgetManager
     * @param BudgetForm      $budgetForm
     * @param ActivityManager $activityManager
     */
    function __construct(BudgetManager $budgetManager, BudgetForm $budgetForm, ActivityManager $activityManager)
    {
        $this->middleware('auth');
        $this->budgetManager   = $budgetManager;
        $this->budgetForm      = $budgetForm;
        $this->activityManager = $activityManager;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $activityData = $this->activityManager->getActivityData($id);

        if (Gate::denies('ownership', $activityData)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }

        if(session('version') == 'V203'){
            $budget_not_provided = @$activityData["default_field_values"][0]["budget_not_provided"];
            if($budget_not_provided !== null && $budget_not_provided !== ""){
                $response = ['type' => 'danger', 'code' => ['budget_not_provided', ['link' => route('change-activity-default',$id)]]];

                return redirect()->to(sprintf('/activity/%s', $id))->withResponse($response);
            }
        }

        $budget = $this->budgetManager->getbudgetData($id);
        $form   = $this->budgetForm->editForm($budget, $id);

        return view('Activity.budget.edit', compact('form', 'activityData', 'id'));
    }

    /**
     * @param                      $id
     * @param Request              $request
     * @param BudgetRequestManager $budgetRequestManager
     * @return mixed
     */
    public function update($id, Request $request, BudgetRequestManager $budgetRequestManager)
    {
        $activityData = $this->activityManager->getActivityData($id);

        if (Gate::denies('ownership', $activityData)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }

        $this->authorizeByRequestType($activityData, 'budget');
        $budget = $request->all();
        foreach($budget['budget'] as &$budget){
            //$budget['value'][0]['value_date'] = $budget['period_start'][0]['date'];
        }
        if ($this->budgetManager->update($budget, $activityData)) {
            $this->activityManager->resetActivityWorkflow($id);
            $response = ['type' => 'success', 'code' => ['updated', ['name' => trans('element.budget')]]];

            return redirect()->to(sprintf('/activity/%s', $id))->withResponse($response);
        }
        $response = ['type' => 'danger', 'code' => ['update_failed', ['name' => trans('element.budget')]]];

        return redirect()->back()->withInput()->withResponse($response);
    }
}

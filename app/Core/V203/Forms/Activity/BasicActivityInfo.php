<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class Title
 * Contains the function to create the title form
 * @package App\Core\V201\Forms\Activity
 */
class BasicActivityInfo extends BaseForm
{
    /**
     * builds the activity title form
     */
    public function buildForm()
    {
        $this
            ->addCollection('title', 'Activity\Title','title hide-two',[], 'Activity Title')
            ->addCollection('activityDescription','Activity\Description','activityDescription hide-two',[],'General Description')
            ->addCollection('activityDate', 'Activity\ActivityDate', 'activityDate', [], 'Planned Activity Dates')
            ->addCollection('activityStatus','Activity\ActivityStatus','activityStatus hide-two hidden',[],'Activity Status')
            ->addCollection('budget', 'Activity\Budget', 'budget hide-three', [], trans('elementForm.budget'))
            ->addAddMoreButton('add_budget', 'budget')
            ->addCollection('humanitarian_scope', 'Activity\HumanitarianScopesOGD', 'humanitarian_scope hidden');
    }
}

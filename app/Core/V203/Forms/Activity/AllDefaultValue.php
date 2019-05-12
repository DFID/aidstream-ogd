<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class Title
 * Contains the function to create the title form
 * @package App\Core\V201\Forms\Activity
 */
class AllDefaultValue extends BaseForm
{
    /**
     * builds the activity title form
     */
    public function buildForm()
    {
        $this
            ->addCollection('collaborationType', 'Activity\CollaborationType', 'collaborationType')
            ->addCollection('defaultFlowType', 'Activity\DefaultFlowType', 'defaultFlowType')
            ->addCollection('defaultFinanceType', 'Activity\DefaultFinanceType', 'defaultFinanceType')
            ->addCollection('defaultAidType', 'Activity\DefaultAidType', 'defaultAidType')
            ->addCollection('defaultTiedStatus', 'Activity\DefaultTiedStatus', 'defaultTiedStatus');
    }
}

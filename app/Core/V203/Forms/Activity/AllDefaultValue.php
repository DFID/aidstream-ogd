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
            ->addCollection('collaboration_type', 'Activity\CollaborationType', 'Collaboration Type')
            ->addCollection('flow_type', 'Activity\DefaultFlowType', 'Default Flow Type')
            ->addCollection('finance_type', 'Activity\DefaultFinanceType', 'Default Finance Type')
            ->addCollection('aid_type', 'Activity\AidType', 'Default Aid Type')
            ->addCollection('tied_status', 'Activity\DefaultTiedStatus', 'Default Tied Status');
    }
}

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
            ->addCollection('collaboration_type', 'Activity\CollaborationType', 'hide-two Collaboration Type')
            ->addCollection('flow_type', 'Activity\DefaultFlowType', 'hide-two Default Flow Type')
            ->addCollection('finance_type', 'Activity\DefaultFinanceType', 'hide-two Default Finance Type')
            ->addCollection('aid_type', 'Activity\AidType', 'hide-two Default Aid Type')
            ->addCollection('tied_status', 'Activity\DefaultTiedStatus', 'hide-two Default Tied Status');
    }
}

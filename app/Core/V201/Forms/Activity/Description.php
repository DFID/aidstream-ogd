<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class Description
 * @package App\Core\V201\Forms\Activity
 */
class Description extends BaseForm
{
    /**
     * builds activity description form
     */
    public function buildForm()
    {
        $this
            ->addSelect('type', $this->getCodeList('DescriptionType', 'Activity'), 'Description Type', $this->addHelpText('Activity_Description-type'), '1', true)
            ->addNarrative('narrative', 'text', ['narrative_required' => true])
            ->addAddMoreButton('add_narrative', 'narrative')
            ->addRemoveThisButton('remove_description');
    }
}

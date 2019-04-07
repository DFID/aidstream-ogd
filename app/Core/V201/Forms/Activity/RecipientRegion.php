<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class RecipientRegion
 * @package App\Core\V201\Forms\Activity
 */
class RecipientRegion extends BaseForm
{
    /**
     * builds activity Recipient Region form
     */
    public function buildForm()
    {
        $this
            ->addSelect('region_code', $this->getCodeList('Region', 'Activity'), trans('elementForm.region_code'), $this->addHelpText('Activity_RecipientRegion-code'), null, true)
            ->add(
                'region_vocabulary',
                'hidden',
                [
                    'value' => '1'
                ]
            )
            ->addPercentage($this->addHelpText('Activity_RecipientRegion-percentage'))
            ->addRemoveThisButton('remove_recipient_region');
    }
}

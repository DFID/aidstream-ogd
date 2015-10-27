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
            ->add(
                'region_code',
                'select',
                [
                    'choices' => $this->addCodeList('Region', 'Activity'),
                ]
            )
            ->add(
                'region_vocabulary',
                'select',
                [
                    'choices' => $this->addCodeList('RegionVocabulary', 'Activity'),
                ]
            )
            ->add('percentage', 'text')
            ->addNarrative('narrative')
            ->addAddMoreButton('add_narrative', 'narrative')
            ->addRemoveThisButton('remove_recipient_region');
    }
}
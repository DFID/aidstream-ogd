<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class ActivityDate
 * @package App\Core\V201\Forms\Activity
 */
class ActivityDate extends BaseForm
{
    /**
     * builds activity activity date form
     */
    public function buildForm()
    {
        $this
            ->add(
                'date_planned_start',
                'date',
                ['label' => trans('elementForm.planned_start_date'), 'help_block' => $this->addHelpText('Activity_ActivityDate-StartDate'), 'required' => true, 'attr' => ['placeholder' => 'YYYY-MM-DD']]
            )
            ->add(
                'type_planned_start',
                'hidden',
                [
                    'value' => '1'
                ]
            )
            //->addSelect('type', $this->getCodeList('ActivityDateType', 'Activity'), trans('elementForm.activity_date_type'), $this->addHelpText('Activity_ActivityDate-type'), null, true)
            //->addNarrativeHidden('narrative hide_this')
            ->add(
                'date_planned_end',
                'date',
                ['label' => trans('elementForm.planned_end_date'), 'help_block' => $this->addHelpText('Activity_ActivityDate-EndDate'), 'required' => true, 'attr' => ['placeholder' => 'YYYY-MM-DD']]
            )
            ->add(
                'type_planned_end',
                'hidden',
                [
                    'value' => '3'
                ]
            );
            //->addNarrativeHidden('narrative2 hide_this');
    }
}

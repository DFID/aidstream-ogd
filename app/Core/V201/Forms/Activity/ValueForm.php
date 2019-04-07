<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class ValueForm
 * @package App\Core\V201\Forms\Activity
 */
class ValueForm extends BaseForm
{
    public function buildForm()
    {
        $this
            ->add('amount', 'text', ['label' => trans('elementForm.amount'), 'help_block' => $this->addHelpText('Activity_Budget_Value-text'), 'required' => true])
            ->add(
                'currency',
                'hidden',
                [
                    'value' => 'GBP'
                ]
            )
            //->addSelect('currency', $this->getCodeList('Currency', 'Activity'), trans('elementForm.currency'), $this->addHelpText('Activity_Budget_Value-currency'))
            ->add(
                'value_date',
                'hidden',
                [
                    'value' => ''
                ]
            );
    }
}

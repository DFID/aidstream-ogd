<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class HumanitarianScope
 * @package App\Core\V202\Forms\Activity
 */
class HumanitarianScopeAppeal extends BaseForm
{
    /**
     * build humanitarian scope form
     */
    public function buildForm()
    {
        $this
            ->add(
                'type',
                'hidden',
                [
                    'value' => '2'
                ]
            )
            ->add(
                'vocabulary',
                'hidden',
                [
                    'value' => '2-1'
                ]
            )
            //->addSelect('type', $this->getCodeList('HumanitarianScopeType', 'Activity'), trans('elementForm.type'), null, null, true, ['attr' => ['class' => 'humanitarian-type form-control']])
            // ->addSelect(
            //     'vocabulary',
            //     $this->getCodeList('HumanitarianScopeVocabulary', 'Activity'),
            //     trans('elementForm.vocabulary'),
            //     null,
            //     null,
            //     true,
            //     ['attr' => ['class' => 'humanitarian-vocabulary form-control', 'disabled' => 'disabled']]
            // )
            ->add(
                'vocabulary_uri',
                'hidden',
                [
                    'value' => 'https://fts.unocha.org/plan-code-list-iati'
                ]
            )
            //->add('vocabulary_uri', 'text', ['label' => trans('elementForm.vocabulary_uri')])
            ->add('code', 'text', ['label' => trans('elementForm.humanitarian_scope_appeal'), 'required' => false])
            ->addNarrativeHidden('humanitarian_narrative hidden')
            //->addAddMoreButton('add', 'humanitarian_narrative')
            ->addRemoveThisButton('remove');
    }
}

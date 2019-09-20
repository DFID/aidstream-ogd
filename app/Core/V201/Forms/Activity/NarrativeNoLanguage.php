<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;
use App\Models\Activity\Activity;

/**
 * Class Narrative
 * @package App\Core\V201\Forms\Activity
 */
class NarrativeNoLanguage extends BaseForm
{
    protected $showFieldErrors = true;

    /**
     * builds the narrative form
     *
     * default help-text for narrative and languages can be changed by
     * adding 'addData' before adding Narrative
     * with keys 'help-text-narrative' and 'help-text-language' respectively
     */
    public function buildForm()
    {
        $this
            ->add(
                'narrative',
                'textarea',
                [
                    'label'      => $this->getData('label'),
                    'help_block' => $this->addHelpText($this->getData('help-text-narrative') ? $this->getData('help-text-narrative') : 'Narrative-text'),
                    'attr'       => ['rows' => 8],
                    'required'   => $this->getData('narrative_required')
                ]
            )
            // ->addSelect(
            //     'language',
            //     $this->getCodeList('Language', 'Activity'),
            //     trans('elementForm.language'),
            //     $this->addHelpText($this->getData('help-text-language') ? $this->getData('help-text-language') : 'activity-xml_lang')
            // )
            ->add(
                'language',
                'hidden',
                [
                    'value' => ''
                ]
            );
    }
}
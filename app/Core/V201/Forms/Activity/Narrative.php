<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;
use App\Models\Activity\Activity;

/**
 * Class Narrative
 * @package App\Core\V201\Forms\Activity
 */
class Narrative extends BaseForm
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
        $defaultLanguage = getDefaultLanguage();

        $this->add(
            'narrative',
            'textarea',
            [
                'label'      => $this->getData('label'),
                'help_block' => $this->addHelpText($this->getData('help-text-narrative') ? $this->getData('help-text-narrative') : 'Narrative-text'),
                'attr'       => ['rows' => 4],
                'required'   => $this->getData('narrative_required')
            ]
        );

        $model = $this->model;
        if (isset($model['transaction'])) {
            $model = $model['transaction'];
        } elseif (isset($model['result'])) {
            $model = $model['result'];
        }
        !(checkDataExists($model)) ?: $defaultLanguage = null;
        $this->addSelect(
            'language',
            $this->getCodeList('Language', 'Activity'),
            null,
            $this->addHelpText($this->getData('help-text-language') ? $this->getData('help-text-language') : 'activity-xml_lang'),
            $defaultLanguage
        );

        $this->addRemoveThisButton('remove_from_collection');
    }
}

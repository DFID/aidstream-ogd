<?php namespace App\Core\V201\Forms\Settings;

use App\Core\Form\BaseForm;

/**
 * Class BasicActivityInformation
 * @package App\Core\V201\Forms\Settings
 */
class BasicActivityInformation extends BaseForm
{
    /**
     * build basic activity information form
     */
    public function buildForm()
    {
        $this
            ->addCheckBox('title', trans('element.title'))
            ->addCheckBox('description', trans('element.description'))
            ->addCheckBox('activity_status', trans('element.activity_status'))
            ->addCheckBox('activity_date', trans('element.activity_date'))
            ->addCheckBox('contact_info', trans('element.contact_info'))
            ->addCheckBox('activity_scope', trans('element.activity_scope'))
            ->addCheckBox('basic_activity_info', trans('element.basic_activity_info_(lite)'));
    }
}

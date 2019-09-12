<?php namespace App\Core\V203\Forms\Organization;

use App\Core\Form\BaseForm;

/**
 * Class DocumentLinkForm
 * @package App\Core\V202\Forms\Organization
 */
class DocumentLinkForm extends BaseForm
{
    /**
     * build organization document link form
     */
    public function buildForm()
    {
        $this
            ->add('url', 'text', ['label' => trans('elementForm.url'), 'required' => true])
            ->add(
                'upload_text',
                'static',
                [
                    'tag'           => 'em',
                    'label'         => false,
                    'default_value' => trans('elementForm.url_text')
                ]
            )
            ->addNarrative('narrative hide-two',null,null,'Title')
            //->addAddMoreButton('add_narrative', 'narrative')
            ->addCollection('description', 'Activity\Title', 'hide-two', [], trans('elementForm.description'))
            ->addSelect('format', $this->getCodeListWithNameOnly('FileFormat', 'Activity'), trans('elementForm.format'), null, null, true)
            ->addCollection('category', 'Organization\CategoryCodeForm', 'category hide-two', [], trans('elementForm.category'))
            ->addAddMoreButton('add_category', 'category')
            ->addCollection('language', 'Organization\LanguageCodeForm', 'language hidden', [], trans('elementForm.language'))
            //->addAddMoreButton('add_language', 'language')
            ->addCollection('document_date', 'Organization\PeriodStart', 'hide-two', [], trans('elementForm.document_date'))
            ->addCollection('recipient_country', 'Organization\RecipientCountryForm', 'recipient_country hidden', [], trans('elementForm.recipient_country'))
            //->addAddMoreButton('add_recipient_country', 'recipient_country')
            ->addRemoveThisButton('remove_document_link');
    }
}

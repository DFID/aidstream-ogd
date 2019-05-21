<?php namespace App\Core\V202\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class HumanitarianScopes
 * @package App\Core\V202\Forms\Organization
 */
class HumanitarianScopesOGD extends BaseForm
{
    /**
     * build organization humanitarian scope form
     */
    public function buildForm()
    {
        $this
            ->addCollectionHideLabel('humanitarian_scope', 'Activity\HumanitarianScopeEmergency', 'humanitarian_scope',[], trans('elementForm.humanitarian_scope_emergency'))
            ->addAddMoreButton('add', 'humanitarian_scope')
            ->addCollectionHideLabel('humanitarian_scope_appeal', 'Activity\HumanitarianScopeAppeal', 'humanitarian_scope_appeal',[], trans('elementForm.humanitarian_scope_appeal'))
            ->addAddMoreButton('add_appeal', 'humanitarian_scope_appeal');
    }
}

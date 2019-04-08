<?php namespace App\Core\V202\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class HumanitarianScopes
 * @package App\Core\V202\Forms\Organization
 */
class HumanitarianScopes extends BaseForm
{
    /**
     * build organization humanitarian scope form
     */
    public function buildForm()
    {
        $this
            ->addCollection('humanitarian_scope_emergency', 'Activity\HumanitarianScopeEmergency', 'humanitarian_scope');
            ->addAddMoreButton('add', 'humanitarian_scope_emergency');
            ->addCollection('humanitarian_scope_appeal', 'Activity\HumanitarianScopeAppeal', 'humanitarian_scope');
            ->addAddMoreButton('add', 'humanitarian_scope_appeal');
    }
}

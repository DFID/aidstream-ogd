<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class ParticipatingOrganization
 * @package App\Core\V201\Forms\Activity
 */
class ParticipatingOrganization extends BaseForm
{
    /**
     * builds activity participating organization form
     */
    public function buildForm()
    {
        $this
            ->addCollection('participating_org_accountable', 'Activity\ParticipatingOrgAccountable', 'participating_org_accountable hidden',[], trans('elementForm.participating_org_accountable'))
            //->addAddMoreButton('add_accountable', 'participating_org_accountable')
            ->addCollection('participating_org_funding', 'Activity\ParticipatingOrgFunding', 'participating_org_funding',[], trans('elementForm.participating_org_funding'))
            ->addAddMoreButton('add_funding', 'participating_org_funding')
            ->addCollection('participating_org_implementing', 'Activity\ParticipatingOrgImplementing', 'participating_org_implementing',[], trans('elementForm.participating_org_implementing'))
            ->addAddMoreButton('add_implementing', 'participating_org_implementing')
            ;
    }
}

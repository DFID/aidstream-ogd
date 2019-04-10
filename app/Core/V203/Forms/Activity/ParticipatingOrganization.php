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
            ->add(
                'organization_role',
                'hidden',
                [
                    
                ]
            )
            // ->addSelect(
            //     'organization_role',
            //     $this->getCodeList('OrganisationRole', 'Activity'),
            //     trans('elementForm.organisation_role'),
            //     $this->addHelpText('Activity_ParticipatingOrg-role'),
            //     null,
            //     true
            // )
            ->add('identifier', 'hidden', ['label' => trans('elementForm.identifier'), 'help_block' => $this->addHelpText('Activity_ParticipatingOrg-ref')])
            ->add(
                'organization_type',
                'hidden',
                [
                    
                ]
            )
            //->addSelect('organization_type', $this->getCodeList('OrganisationType', 'Activity'), trans('elementForm.organisation_type'), $this->addHelpText('Activity_ParticipatingOrg-type'))
            ->add('activity_id', 'hidden', ['label' => trans('elementForm.activity_id')])
            ->add('crs_channel_code','hidden',['label' => 'Crs Channel Code'])
            ->addNarrative('narrative hidden', trans('elementForm.organisation_name'))
            //->addAddMoreButton('add', 'narrative')
            //->addRemoveThisButton('remove_narrative')
            ->addCollection('participating_org_funding', 'Activity\ParticipatingOrgFunding', 'participating_org_funding',[], trans('elementForm.humanitarian_scope_emergency'))
            ->addCollection('participating_org_accountable', 'Activity\ParticipatingOrgAccountable', 'participating_org_accountable',[], trans('elementForm.humanitarian_scope_emergency'))
            ->addCollection('participating_org_implementing', 'Activity\ParticipatingOrgImplementing', 'participating_org_implementing',[], trans('elementForm.humanitarian_scope_emergency'))
            ;
    }
}

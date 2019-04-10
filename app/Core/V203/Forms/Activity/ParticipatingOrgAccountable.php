<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class ParticipatingOrganization
 * @package App\Core\V201\Forms\Activity
 */
class ParticipatingOrgAccountable extends BaseForm
{
    /**
     * builds activity participating organization form
     */
    public function buildForm()
    {
        $this
            ->add('narrative_accountable', 'text', ['label' => trans('elementForm.organisation_name'), 'help_block' => $this->addHelpText('Activity_ParticipatingOrg-ref')])
            ->addSelect('organization_type_accountable', $this->getCodeList('OrganisationType', 'Activity'), trans('elementForm.organisation_type'), $this->addHelpText('Activity_ParticipatingOrg-type'))
            ->add('identifier_accountable', 'text', ['label' => trans('elementForm.identifier'), 'help_block' => $this->addHelpText('Activity_ParticipatingOrg-ref')]);
    }
}

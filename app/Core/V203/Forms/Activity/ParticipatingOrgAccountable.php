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
            //->add('identifier', 'hidden', ['label' => trans('elementForm.identifier'), 'help_block' => $this->addHelpText('Activity_ParticipatingOrg-ref')])
            ->add(
                'organization_role',
                'hidden',
                [
                    'value' => 2
                ]
            )
            // ->add(
            //     'organization_type',
            //     'hidden',
            //     [

            //     ]
            // )
            ->add('activity_id', 'hidden', ['label' => trans('elementForm.activity_id')])
            ->add('crs_channel_code','hidden',['label' => 'Crs Channel Code'])
            ->addNarrative('narrative hidden', trans('elementForm.organisation_name'))
            ->add('narrative_accountable', 'text', ['label' => trans('elementForm.organisation_name'), 'help_block' => $this->addHelpText('Activity_ParticipatingOrg-ref')])
            ->addSelect('organization_type', $this->getCodeList('OrganisationType', 'Activity'), trans('elementForm.organisation_type'), $this->addHelpText('Activity_ParticipatingOrg-type'))
            ->add('identifier', 'text', ['label' => trans('elementForm.identifier'), 'help_block' => $this->addHelpText('Activity_ParticipatingOrg-ref')]);
    }
}

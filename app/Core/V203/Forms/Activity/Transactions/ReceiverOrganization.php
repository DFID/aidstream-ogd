<?php namespace App\Core\V203\Forms\Activity\Transactions;

use App\Core\Form\BaseForm;

/**
 * Class ReceiverOrganization
 * @package App\Core\V202\Forms\Activity\Transactions
 */
class ReceiverOrganization extends BaseForm
{
    /**
     * builds receiver org form
     */
    public function buildForm()
    {
        $this
            ->add('receiver_org_narrative', 'text', [
                'label' => 'Organisation Name'
            ])
            ->addSelect('type', $this->getCodeList('OrganisationType', 'Activity'), trans('elementForm.organisation_type'), $this->addHelpText('Activity_ParticipatingOrg-type'))
            ->add('organization_identifier_code', 'text', ['label' => trans('elementForm.organisation_identifier_code')])
             ->add('receiver_activity_id', 'text', ['label' => trans('elementForm.receiver_activity_id')]);
             //->addSelect('type', $this->getCodeList('OrganisationType', 'Activity'), trans('elementForm.type'), $this->addHelpText('Activity_ParticipatingOrg-type'))
            //  ->add(
            //     'type',
            //     'hidden',
            //     [
                    
            //     ]
            // )
            //  ->addNarrativeHidden('receiver_org_narrative hidden');
             //->addAddMoreButton('add_receiver_org_narrative', 'receiver_org_narrative');
    }
}

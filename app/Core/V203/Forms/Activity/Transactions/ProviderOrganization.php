<?php namespace App\Core\V203\Forms\Activity\Transactions;

use App\Core\Form\BaseForm;

/**
 * Class ProviderOrganization
 * @package App\Core\V202\Forms\Activity\Transactions
 */
class ProviderOrganization extends BaseForm
{
    /**
     * builds provider org form
     */
    public function buildForm()
    {
        $this
            ->add('provider_org_narrative', 'text', [
                'label' => 'Organisation Name'
            ])
            ->addSelect('type', $this->getCodeList('OrganisationType', 'Activity'), trans('elementForm.organisation_type'), $this->addHelpText('Activity_ParticipatingOrg-type'))
            ->add('organization_identifier_code', 'text', ['label' => trans('elementForm.organisation_identifier_code')])
             ->add('provider_activity_id', 'text', ['label' => trans('elementForm.provider_activity_id')]);
            //  ->add(
            //     'type',
            //     'hidden',
            //     [
                    
            //     ]
            // )
             //->addAddMoreButton('add_provider_org_narrative', 'provider_org_narrative');
    }
}

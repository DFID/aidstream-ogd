<?php namespace App\Services\FormCreator\Activity;

use App\Core\Version;
use Kris\LaravelFormBuilder\FormBuilder;

/**
 * Class Transaction
 * @package App\Services\FormCreator\Activity
 */
class Transaction
{

    protected $formBuilder;
    protected $version;
    protected $formPath;

    function __construct(FormBuilder $formBuilder, Version $version)
    {
        $this->formBuilder = $formBuilder;
        $this->formPath    = $version->getActivityElement()->getTransaction()->getForm();
    }

    public function createForm($activityId, $reportingOrgData = null, $transactionType = null, $activityIdentifier = null)
    {
        return $this->displayForm('POST', sprintf('activity/%d/transaction', $activityId), null, $activityId, $reportingOrgData, $transactionType, $activityIdentifier);
    }

    public function editForm($activity, $transactionId, $transactionDetails)
    {
        return $this->displayForm('PUT', route('activity.transaction.update', [$activity->id, $transactionId]), $transactionDetails,$activity->id);
    }

    public function displayForm($method, $url, $data = null, $activityId = null, $reportingOrgData = null, $transactionType = null, $activityIdentifier = null)
    {
        $model['transaction'][0] = $data;
        if(isset($model['transaction'][0])){
            $model['transaction'][0]['value'][0]['date'] = $model['transaction'][0]['transaction_date'][0]['date'];
        }
        if($data != null){
            $model['transaction'][0]['provider_organization'][0]['provider_org_narrative'] = $model['transaction'][0]['provider_organization'][0]['narrative'][0]['narrative'];
            $model['transaction'][0]['receiver_organization'][0]['receiver_org_narrative'] = $model['transaction'][0]['receiver_organization'][0]['narrative'][0]['narrative'];
        }
        if($transactionType != null && $data == null){
            $model['transaction'][0]['transaction_type'][0]['transaction_type_code'] = $transactionType;
            if($transactionType == 1){
                if($reportingOrgData != null){
                    $model['transaction'][0]['receiver_organization'][0]['receiver_org_narrative'] = $reportingOrgData['reporting_org'][0]['narrative'][0]['narrative'];
                    $model['transaction'][0]['receiver_organization'][0]['type'] = $reportingOrgData['reporting_org'][0]['reporting_organization_type'];
                    $model['transaction'][0]['receiver_organization'][0]['organization_identifier_code'] = $reportingOrgData['reporting_org'][0]['reporting_organization_identifier'];
                    $model['transaction'][0]['receiver_organization'][0]['receiver_activity_id'] = $activityIdentifier;
                }
            }
            if($transactionType == 3 || $transactionType == 4 || $transactionType == 2){
                if($reportingOrgData != null){
                    $model['transaction'][0]['provider_organization'][0]['provider_org_narrative'] = $reportingOrgData['reporting_org'][0]['narrative'][0]['narrative'];
                    $model['transaction'][0]['provider_organization'][0]['type'] = $reportingOrgData['reporting_org'][0]['reporting_organization_type'];
                    $model['transaction'][0]['provider_organization'][0]['organization_identifier_code'] = $reportingOrgData['reporting_org'][0]['reporting_organization_identifier'];
                    $model['transaction'][0]['provider_organization'][0]['provider_activity_id'] = $activityIdentifier;   
                }
            }
        }
        return $this->formBuilder->create(
            $this->formPath,
            [
                'method' => $method,
                'model'  => $model,
                'url'    => $url
            ]
        )->add('Save', 'submit', ['label' => trans('global.save') ,'attr' => ['class' => 'btn btn-submit btn-form']])
            ->add('Cancel', 'static', [
                'tag'     => 'a',
                'label' => false,
                'value' => trans('global.cancel'),
                'attr'    => [
                    'class' => 'btn btn-cancel',
                    'href'  => route('activity.transaction.index',$activityId)
                ],
                'wrapper' => false
            ]);
    }
}

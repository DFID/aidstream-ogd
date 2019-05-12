<?php
namespace App\Services\FormCreator\Activity;

use App\Core\Version;
use Kris\LaravelFormBuilder\FormBuilder;

/**
 * Class Title
 * Contains function that return activity title edit form
 * @package App\Services\FormCreator\Activity
 */
class AllDefaultValues
{

    protected $formBuilder;
    protected $version;
    protected $formPath;

    /**
     * @param FormBuilder $formBuilder
     * @param Version     $version
     */
    function __construct(FormBuilder $formBuilder, Version $version)
    {
        $this->formBuilder = $formBuilder;
        $this->version     = $version;
        $this->formPath    = $this->version->getActivityElement()->getAllDefaultValues()->getForm();
    }

    /**
     * @param array $data
     * @param       $activityId
     * @return $this
     * return activity title edit form.
     */
    public function editForm($activityCollaborationType, $activityFlowType, $activityFinanceType, $activityAidType, $activityTiedStatus, $activityId)
    {
        $model = [];
         $model['collaborationType'][0]['collaboration_type'] = $activityCollaborationType;
         $model['defaultFlowType'][0]['default_flow_type'] = $activityFlowType;
         $model['defaultFinanceType'][0]['default_finance_type'] = $activityFinanceType;
         $model['defaultAidType'][0]['default_aid_type'] = $activityAidType;
         $model['defaultTiedStatus'][0]['default_tied_status'] = $activityTiedStatus;
        $finalDataSet['allDefaultValues'][0] = $model;
        return $this->formBuilder->create(
            $this->formPath,
            [
                'method' => 'PUT',
                'model'  => $finalDataSet,
                'url'    => route('activity.all-default-values.update', [$activityId, 0])
            ]
        )->add('Save', 'submit', ['attr' => ['class' => 'btn btn-submit btn-form'],'label' => trans('global.save')])
            ->add('Cancel', 'static', [
                'tag'     => 'a',
                'label' => false,
                'value' => trans('global.cancel'),
                'attr'    => [
                    'class' => 'btn btn-cancel',
                    'href'  => route('activity.show', $activityId)
                ],
                'wrapper' => false
            ]);
    }
}


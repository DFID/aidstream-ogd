<?php namespace App\Services\FormCreator\Activity;

use App\Core\Version;
use Kris\LaravelFormBuilder\FormBuilder;

/**
 * Class ParticipatingOrganization
 * @package App\Services\FormCreator\Activity
 */
class ParticipatingOrganization
{
    /**
     * @var FormBuilder
     */
    protected $formBuilder;
    /**
     * @var Version
     */
    protected $version;
    /**
     * @var
     */
    protected $formPath;

    /**
     * @param FormBuilder $formBuilder
     * @param Version     $version
     */
    function __construct(FormBuilder $formBuilder, Version $version)
    {
        $this->formBuilder = $formBuilder;
        $this->version     = $version;
        $this->formPath    = $this->version->getActivityElement()->getParticipatingOrganization()->getForm();
    }

    /**
     * @param array $data
     * @param       $activityId
     * @return $this
     * return activity Participating Organization edit form.
     */
    public function editForm($data, $activityId, $reportingOrganisation)
    {
        $model['participating_organization'] = [];
        $model['participating_organization'][0]['participating_org_accountable'] = [];
        $model['participating_organization'][0]['participating_org_funding'] = [];
        $model['participating_organization'][0]['participating_org_implementing'] = [];
        $triggerForFunding = 0;
        if(sizeof($data) > 0){
            foreach($data as &$d){
                if($d['organization_role'] == 1){
                    $tempData = $d;
                    $tempData['narrative_funding'] = $d['narrative'][0]['narrative'];
                    //$tempData['organization_type_funding'] = $d['organization_type'];
                    //$tempData['identifier_funding'] = $d['identifier'];
                    array_push($model['participating_organization'][0]['participating_org_funding'], $tempData);
                    $triggerForFunding++;
                }
                if($d['organization_role'] == 2){
                    $tempData = $d;
                    $tempData['narrative_accountable'] = $d['narrative'][0]['narrative'];
                    // $tempData['organization_type_accountable'] = $d['organization_type'];
                    // $tempData['identifier_accountable'] = $d['identifier'];
                    array_push($model['participating_organization'][0]['participating_org_accountable'], $tempData);
                }
                if($d['organization_role'] == 4){
                    $tempData = $d;
                    $tempData['narrative_implementing'] = $d['narrative'][0]['narrative'];
                    // $tempData['organization_type_implementing'] = $d['organization_type'];
                    // $tempData['identifier_implementing'] = $d['identifier'];
                    array_push($model['participating_organization'][0]['participating_org_implementing'], $tempData);
                }
            }
        }
        if($triggerForFunding == 0){
            $tempData['organization_role'] = 1;
            $tempData['activity_id'] = '';
            $tempData['crs_channel_code'] = '';
            $tempData['narrative'][0]['narrative'] = array_get($reportingOrganisation, 'reporting_org.0.narrative.0.narrative');
            $tempData['narrative'][0]['language'] = 'en';
            $tempData['narrative_funding'] = array_get($reportingOrganisation, 'reporting_org.0.narrative.0.narrative');
            $tempData['organization_type'] = array_get($reportingOrganisation, 'reporting_org.0.reporting_organization_type');
            $tempData['identifier'] = array_get($reportingOrganisation, 'reporting_org.0.reporting_organization_identifier');
            array_push($model['participating_organization'][0]['participating_org_funding'], $tempData);
        }
        return $this->formBuilder->create(
            $this->formPath,
            [
                'method' => 'PUT',
                'model'  => $model,
                'url'    => route('activity.participating-organization.update', [$activityId, 0])
            ]
        )
                                 ->add('Save', 'submit', ['attr' => ['class' => 'btn btn-submit btn-form'],'label' => trans('global.save')])
                                 ->add(
                                     'Cancel',
                                     'static',
                                     [
                                         'tag'     => 'a',
                                         'label' => false,
                                         'value' => trans('global.cancel'),
                                         'attr'    => [
                                             'class' => 'btn btn-cancel',
                                             'href'  => route('activity.show', $activityId)
                                         ],
                                         'wrapper' => false
                                     ]
                                 );
    }
}

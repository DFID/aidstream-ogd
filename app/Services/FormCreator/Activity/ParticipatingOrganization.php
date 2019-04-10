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
    public function editForm($data, $activityId)
    {
        //$model['participating_organization'] = $data;
        $model['participating_organization'] = [];
        if(sizeof($data) > 0){
            foreach($data as &$d){
                if($d['organization_role'] == 1){
                    $model['participating_organization'][0]['participating_org_funding'] = [];
                    $model['participating_organization'][0]['participating_org_funding'][0]['narrative_funding'] = $d['narrative'][0]['narrative'];
                    $model['participating_organization'][0]['participating_org_funding'][0]['organization_type_funding'] = $d['organization_type'];
                    $model['participating_organization'][0]['participating_org_funding'][0]['identifier_funding'] = $d['identifier'];
                }
                if($d['organization_role'] == 2){
                    $model['participating_organization'][0]['participating_org_accountable'] = [];
                    $model['participating_organization'][0]['participating_org_accountable'][0]['narrative_accountable'] = $d['narrative'][0]['narrative'];
                    $model['participating_organization'][0]['participating_org_accountable'][0]['organization_type_accountable'] = $d['organization_type'];
                    $model['participating_organization'][0]['participating_org_accountable'][0]['identifier_accountable'] = $d['identifier'];
                }
                if($d['organization_role'] == 4){
                    $model['participating_organization'][0]['participating_org_implementing'] = [];
                    $model['participating_organization'][0]['participating_org_implementing'][0]['narrative_implementing'] = $d['narrative'][0]['narrative'];
                    $model['participating_organization'][0]['participating_org_implementing'][0]['organization_type_implementing'] = $d['organization_type'];
                    $model['participating_organization'][0]['participating_org_implementing'][0]['identifier_implementing'] = $d['identifier'];
                }
            }
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

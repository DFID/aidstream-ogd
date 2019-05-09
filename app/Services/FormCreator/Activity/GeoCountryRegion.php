<?php
namespace App\Services\FormCreator\Activity;

use App\Core\Version;
use Kris\LaravelFormBuilder\FormBuilder;

/**
 * Class Title
 * Contains function that return activity title edit form
 * @package App\Services\FormCreator\Activity
 */
class GeoCountryRegion
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
        $this->formPath    = $this->version->getActivityElement()->getGeoCountryRegion()->getForm();
    }

    /**
     * @param array $data
     * @param       $activityId
     * @return $this
     * return activity title edit form.
     */
    public function editForm($activityScope, $activityRecipientCountry, $activityRecipientRegion, $activityId)
    {
        $model = [];
        $model['activityScope'][0]['activity_scope'] = $activityScope;
        $model['activityRecipientCountry'][0]['recipient_country'] = [];
        $model['activityRecipientCountry'][0]['recipient_country'] = $activityRecipientCountry;
        $model['activityRecipientRegion'][0]['recipient_region'] = [];
        $model['activityRecipientRegion'][0]['recipient_region'] = $activityRecipientRegion;
        $finalDataSet['geoCountryRegion'][0] = $model;
        return $this->formBuilder->create(
            $this->formPath,
            [
                'method' => 'PUT',
                'model'  => $finalDataSet,
                'url'    => route('activity.geo-country-region.update', [$activityId, 0])
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


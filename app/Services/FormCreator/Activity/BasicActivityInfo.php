<?php
namespace App\Services\FormCreator\Activity;

use App\Core\Version;
use Kris\LaravelFormBuilder\FormBuilder;

/**
 * Class Title
 * Contains function that return activity title edit form
 * @package App\Services\FormCreator\Activity
 */
class BasicActivityInfo
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
        $this->formPath    = $this->version->getActivityElement()->getBasicActivityInfo()->getForm();
    }

    /**
     * @param array $data
     * @param       $activityId
     * @return $this
     * return activity title edit form.
     */
    public function editForm($activityTitle, $activityDate, $activityStatus, $activityDescription, $activityId)
    {
        info($activityDescription);
        $model['title'][0]['narrative'] = $activityTitle;
        $model['activityDate'] = [];
        $model['activityDate'][0]['date_planned_start'] = $activityDate[0]['date'];
        $model['activityDate'][0]['type_planned_start'] = $activityDate[0]['type'];
        $model['activityDate'][0]['date_planned_end'] = $activityDate[1]['date'];
        $model['activityDate'][0]['type_planned_end'] = $activityDate[1]['type'];
        $model['activityStatus'][0]['activity_status'] = $activityStatus;
        $model['activityDescription'] = [];
        $model['activityDescription'] = $activityDescription;
        return $this->formBuilder->create(
            $this->formPath,
            [
                'method' => 'PUT',
                'model'  => $model,
                'url'    => route('activity.basic-activity-info.update', [$activityId, 0])
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


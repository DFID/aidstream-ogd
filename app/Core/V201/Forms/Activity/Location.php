<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class Location
 * @package App\Core\V201\Forms\Activity
 */
class Location extends BaseForm
{
    protected $showFieldErrors = true;

    /**
     * builds location form
     */
    public function buildForm()
    {
        $this
            //->add('reference', 'text', ['label' => trans('elementForm.reference'),'label' => trans('elementForm.reference'), 'help_block' => $this->addHelpText('Activity_Location-ref')])
            ->add(
                'reference',
                'hidden',
                [
                    'value' => ''
                ]
            )
            ->addCollection('location_reach', 'Activity\LocationReach', 'hidden', [], trans('elementForm.location_reach'))
            ->addCollection('location_id', 'Activity\LocationId', 'location_id hidden', [], trans('elementForm.location_id'))
            //->addAddMoreButton('add', 'location_id')
            ->addCollection('name', 'Activity\Name', '', [], trans('elementForm.name'))
            ->addCollection('location_description', 'Activity\LocationDescription', 'hidden', [], trans('elementForm.location_description'))
            ->addCollection('activity_description', 'Activity\ActivityDescription', 'hidden', [], trans('elementForm.activity_description'))
            ->addCollection('administrative', 'Activity\Administrative', 'administrative hidden', [], trans('elementForm.administrative'))
            //->addAddMoreButton('add_administrative', 'administrative')
            ->addCollection('point', 'Activity\Point', '', [], trans('elementForm.point'))
            ->addCollection('exactness', 'Activity\Exactness', '', [], trans('elementForm.exactness'))
            ->addCollection('location_class', 'Activity\LocationClass', '', [], trans('elementForm.location_class'))
            ->addCollection('feature_designation', 'Activity\FeatureDesignation', '', [], trans('elementForm.feature_designation'))
            ->addRemoveThisButton('remove');
    }
}

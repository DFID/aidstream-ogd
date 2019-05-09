<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class Title
 * Contains the function to create the title form
 * @package App\Core\V201\Forms\Activity
 */
class GeoCountryRegion extends BaseForm
{
    /**
     * builds the activity title form
     */
    public function buildForm()
    {
        $this
            ->addCollection('activityScope', 'Activity\ActivityScope','activityScope',[], trans('elementForm.activity_scope'))
            ->addCollection('activityRecipientCountry', 'Activity\MultipleRecipientCountry', 'activityRecipientCountry', [], 'Activity Recipient Countries')
            ->addCollection('activityRecipientRegion', 'Activity\MultipleRecipientRegion', 'activityRecipientRegion', [], 'Activity Recipient Regions');
    }
}

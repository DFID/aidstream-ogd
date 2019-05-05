<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class Title
 * Contains the function to create the title form
 * @package App\Core\V201\Forms\Activity
 */
class BasicActivityInfo extends BaseForm
{
    /**
     * builds the activity title form
     */
    public function buildForm()
    {
        $this
            ->addCollection('title', 'Activity\Title','title',[], trans('elementForm.text'))
            ->addCollection('activityDate', 'Activity\ActivityDate', 'activityDate', [], 'Activity Dates');
    }
}

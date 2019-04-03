<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class ActivityDescription
 * @package App\Core\V201\Forms\Activity
 */
class ActivityDescription extends BaseForm
{
    protected $showFieldErrors = true;

    /**
     * builds activity description form
     */
    public function buildForm()
    {
        $this
            ->addNarrative('activity_description_narrative');
    }
}

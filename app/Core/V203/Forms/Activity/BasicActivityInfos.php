<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

class BasicActivityInfos extends BaseForm
{
    public function buildForm()
    {
        $this
            ->addCollection('basicActivityInfo', 'Activity\BasicActivityInfo', 'basicActivityInfo');
    }
}

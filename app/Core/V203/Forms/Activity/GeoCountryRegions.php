<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

class GeoCountryRegions extends BaseForm
{
    public function buildForm()
    {
        $this
            ->addCollection('geoCountryRegion', 'Activity\GeoCountryRegion', 'geoCountryRegion');
    }
}

<?php namespace App\Services\RequestManager\Activity;

use App\Core\Version;
Use App;

class GeoCountryRegionRequestManager 
{
    protected $req;

    /**
     * @param Version $version
     */
    function __construct(Version $version)
    {
        $this->req = $version->getActivityElement()->getGeoCountryRegionRequest();

        return $this->req;
    }
}

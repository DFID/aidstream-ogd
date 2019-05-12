<?php namespace App\Services\RequestManager\Activity;

use App\Core\Version;
Use App;

class AllDefaultValuesRequestManager 
{
    protected $req;

    /**
     * @param Version $version
     */
    function __construct(Version $version)
    {
        $this->req = $version->getActivityElement()->getAllDefaultValuesRequest();

        return $this->req;
    }
}

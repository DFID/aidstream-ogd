<?php namespace App\Services\Activity;

use App\Core\Version;
use App\Models\Activity\Activity;
use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TitleManager
 * Contains the function that will update the activity title and returns the activity data.
 * @package app\Services\Activity
 */
class GeoCountryRegionManager
{
    /**
     * @var Guard
     */
    protected $auth;
    /**
     * @var Log
     */
    protected $log;
    /**
     * @var Version
     */
    protected $version;

    /**
     * @param Version $version
     * @param Log     $log
     * @param Guard   $auth
     */
    public function __construct(Version $version, Log $log, Guard $auth)
    {
        $this->auth          = $auth;
        $this->log           = $log;
        $this->version       = $version;
        $this->activityScopeRepo = $version->getActivityElement()->getActivityScope()->getRepository();
        $this->recipientCountryRepo = $version->getActivityElement()->getRecipientCountry()->getRepository();
        $this->recipientRegionRepo = $version->getActivityElement()->getRecipientRegion()->getRepository();
    }

    /**
     * updates Activity Title
     * @param array    $activityDetails
     * @param Activity $activity
     * @return bool
     */
    public function update(array $activityDetails, Activity $activity)
    {
        try {
            $this->activityScopeRepo->update($activityDetails, $activity);
            $this->recipientCountryRepo->update($activityDetails, $activity);
            $this->recipientRegionRepo->update($activityDetails, $activity);
            $this->log->info(
                'Activity Title Updated!',
                ['for ' => $activity['narrative']]
            );
            $this->log->activity(
                "activity.title_updated",
                [
                    'activity_id'     => $activity->id,
                    'organization'    => $this->auth->user()->organization->name,
                    'organization_id' => $this->auth->user()->organization->id
                ]
            );

            return true;
        } catch (Exception $exception) {
            $this->log->error($exception, ['Title' => $activityDetails]);
        }

        return false;
    }

    /**
     * Get the Activity Scope data for Activity with the given id.
     * @param $id
     * @return Model
     */
    public function getActivityScopeData($id)
    {
        return $this->activityScopeRepo->getActivityScopeData($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getRecipientCountryData($id)
    {
        return $this->recipientCountryRepo->getRecipientCountryData($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getRecipientRegionData($id)
    {
        return $this->recipientRegionRepo->getRecipientRegionData($id);
    }
}

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
class BasicActivityInfoManager
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
        $this->iatiTitleRepo = $version->getActivityElement()->getTitle()->getRepository();
        $this->iatiActivtyDateRepo = $version->getActivityElement()->getActivityDate()->getRepository();
        $this->activityStatusRepo = $version->getActivityElement()->getActivityStatus()->getRepository();

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
            $this->iatiTitleRepo->update($activityDetails['title'], $activity);
            $this->iatiActivtyDateRepo->update($activityDetails, $activity);
            $this->activityStatusRepo->update($activityDetails, $activity);
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
     * @param $id
     * @return Model
     */
    public function getTitleData($id)
    {
        return $this->iatiTitleRepo->getTitleData($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getActivityDateData($id)
    {
        return $this->iatiActivtyDateRepo->getActivityDateData($id);
    }
    
    /**
     * Get the Activity Status data for Activity with the given id.
     * @param $id
     * @return Model
     */
    public function getActivityStatusData($id)
    {
        return $this->activityStatusRepo->getActivityStatusData($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getActivityData($id)
    {
        return $this->iatiTitleRepo->getActivityData($id);
    }
}

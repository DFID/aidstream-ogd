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
class AllDefaultValuesManager
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
        $this->collaborationTypeRepo = $version->getActivityElement()->getCollaborationType()->getRepository();
        $this->defaultFlowTypeRepo = $version->getActivityElement()->getDefaultFlowType()->getRepository();
        $this->defaultFinanceTypeRepo = $version->getActivityElement()->getDefaultFinanceType()->getRepository();
        $this->defaultAidTypeRepo = $version->getActivityElement()->getDefaultAidType()->getRepository();
        $this->defaultTiedStatusRepo = $version->getActivityElement()->getDefaultTiedStatus()->getRepository();
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
            $this->collaborationTypeRepo->update($activityDetails, $activity);
            $this->defaultFlowTypeRepo->update($activityDetails, $activity);
            $this->defaultFinanceTypeRepo->update($activityDetails, $activity);
            $this->defaultAidTypeRepo->update($activityDetails, $activity);
            $this->defaultTiedStatusRepo->update($activityDetails, $activity);
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
    public function getCollaborationTypeData($id)
    {
        return $this->collaborationTypeRepo->getCollaborationTypeData($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getDefaultFlowTypeData($id)
    {
        return $this->defaultFlowTypeRepo->getDefaultFlowTypeData($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getDefaultFinanceTypeData($id)
    {
        return $this->defaultFinanceTypeRepo->getDefaultFinanceTypeData($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getDefaultAidTypeData($id)
    {
        return $this->defaultAidTypeRepo->getDefaultAidTypeData($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getDefaultTiedStatusData($id)
    {
        return $this->defaultTiedStatusRepo->getDefaultTiedStatusData($id);
    }

}

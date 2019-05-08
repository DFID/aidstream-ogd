<?php namespace App\Core\V203\Element\Activity;

use App\Core\Elements\BaseElement;
use App\Models\Activity\Activity;

/**
 * Class BasicActivityInfo
 * contains the function that returns the title form and title repository
 * @package app\Core\V201\Element\Activity
 */
class BasicActivityInfo extends BaseElement
{
    /**
     * @return title form
     */
    public function getForm()
    {
        return 'App\Core\V203\Forms\Activity\BasicActivityInfos';
    }

    /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function getRepository()
    {
        return App('App\Core\V203\Repositories\Activity\BasicActivityInfo');
    }

    /**
     * @param $activity
     * @return array
     */
    public function getXmlData(Activity $activity)
    {
        // $titles         = (array) $activity->title;
        // $activityData[] = [
        //     'narrative' => $this->buildNarrative($titles)
        // ];

        // return $activityData;
        return true;
    }
}

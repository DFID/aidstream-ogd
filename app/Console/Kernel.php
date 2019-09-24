<?php namespace App\Console;

use App\Console\Commands\AddTzToSystemVersions;
use App\Console\Commands\SyncPartnerOrganizations;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Activity\Activity;

class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\Inspire',
        AddTzToSystemVersions::class,
        SyncPartnerOrganizations::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('inspire')->hourly();

        //$schedule->command('backup:run')->daily(7, 14);
        //$schedule->command('db:backup --database=pgsql --destination=sftp --destinationPath=`date +\%Y/%d-%m-%Y` --compression=gzip')->daily(7, 14);
        // $schedule->call(function(){
        //     //
        // });
        $schedule->call(function(){
            $activity = new Activity;
            $allActivities = $activity->all();
            foreach($allActivities as $activity){
                $updateActivityStatusTrigger = 0;
                if(isset($activity['activity_date'])){
                    $plannedStartDate = '';
                    $plannedEndDate = '';
                    foreach($activity['activity_date'] as $date){
                        if($date['type'] == 1){
                            $updateActivityStatusTrigger++;
                            $plannedStartDate = $date['date'];
                        }
                        if($date['type'] == 3){
                            $updateActivityStatusTrigger++;
                            $plannedEndDate = $date['date'];
                        }
                    }
                }
                if($updateActivityStatusTrigger == 2){
                    if(date("Y-m-d") < $plannedStartDate && $activity->activity_status != 1){
                       $activity->activity_status = 1;
                       $activity->activity_workflow = 0;
                       $activity->save(); 
                    }
                    if(date("Y-m-d") >= $plannedStartDate && date("Y-m-d") <= $plannedEndDate && $activity->activity_status != 2){
                        //info('Project should be under implementation');
                       $activity->activity_status = 2;
                       $activity->activity_workflow = 0;
                       $activity->save(); 
                    }
                    if(date("Y-m-d") > $plannedEndDate && $activity->activity_status != 4){
                        $activity->activity_status = 4;
                        $activity->activity_workflow = 0;
                       $activity->save();
                    }
                    //Add/Remove actual start and end dates logic
                    unset($activity['activity_date']);
                    $tempDates = [];
                    //$activity['activity_date'] = [];
                    $tempDates[0]['date'] = $plannedStartDate;
                    $tempDates[0]['type'] = 1;
                    $tempDates[0]['narrative'][0]['narrative'] = '';
                    $tempDates[0]['narrative'][0]['language'] = '';
                    $tempDates[1]['date'] = $plannedEndDate;
                    $tempDates[1]['type'] = 3;
                    $tempDates[1]['narrative'][0]['narrative'] = '';
                    $tempDates[1]['narrative'][0]['language'] = '';
                    //Only fill in actual start date if the planned start date is older than current start date
                    if($plannedStartDate < date("Y-m-d")){
                        $tempData = array();
                        $tempData['date'] = $plannedStartDate;
                        $tempData['type'] = 2;
                        $tempData['narrative'][0]['narrative'] = '';
                        $tempData['narrative'][0]['language'] = '';
                        array_push($tempDates, $tempData);
                    }
                    //Only fill in actual end date if the planned end date is older than current end date
                    if($plannedEndDate < date("Y-m-d")){
                        $tempData = array();
                        $tempData['date'] = $plannedEndDate;
                        $tempData['type'] = 4;
                        $tempData['narrative'][0]['narrative'] = '';
                        $tempData['narrative'][0]['language'] = '';
                        array_push($tempDates, $tempData);
                    }
                }
                $activity['activity_date'] = [];
                $activity['activity_date'] = $tempDates;
                //info($activity->$activity_date);
                $activity->save();
                //info($activity->$activity_date);
                // $activity->activity_status = 1;
                // $activity->save();
            }
        })->everyMinute();
    }

}

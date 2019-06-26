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
                }
                //info($activity->$activity_date);
                // $activity->activity_status = 1;
                // $activity->save();
            }
        })->daily();
    }

}

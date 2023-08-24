<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\JobModel;
use App\Models\NotificationModel;

class Jobexpirynotification extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:jobexpirynotify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert record to notification table if job expired or is going to expire';

    /**
     * Create a new command instance.
     *
     * @return void
     **/
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $getExpiredJob =  JobModel::select("jobId","jobTitle","createdBy","jobExpiryDate")
                          ->where('jobExpiryDate','<',date("Y-m-d"))
                          ->where('deletedFlag',0)->get();
        
        if($getExpiredJob->isNotEmpty()){
            foreach ($getExpiredJob as $ke => $val) {
                # code...
                $getCount =    NotificationModel::where('notificationTo',$val->createdBy)
                               ->where('notifyCommonId',$val->jobId)
                               ->where('notificationType',4)
                               ->where('deletedFlag',0)
                               ->count();

                //echo $getCount;               
                if($getCount == 0){
                    $msgStr  = 'Your job post '.$val->jobTitle.' is expired';
                    //echo $val->jobId.'======';
                    sendNotification($msgStr,4,0,$val->createdBy,$val->jobId);
                }               
            }
        }       

        $fromDt              =  date('Y-m-d'); 
        $toDt                =  date('Y-m-d', strtotime("+15 day"));
        $getgoingtoexpireJob =  JobModel::select("jobId","jobTitle","createdBy","jobExpiryDate")
                                ->whereBetween('jobExpiryDate', [$fromDt, $toDt])
                                ->where('deletedFlag',0)->get();   

                                //echo '<pre>';           print_r($getgoingtoexpireJob);exit;
        if($getgoingtoexpireJob->isNotEmpty()){
            foreach ($getgoingtoexpireJob as $k => $v) {
                # code...
                $getCountexpiring =    NotificationModel::where('notificationTo',$v->createdBy)
                                       ->where('notifyCommonId',$v->jobId)
                                       ->where('notificationType',5)
                                       ->where('deletedFlag',0)
                                       ->count();

                //echo $getCount;               
                if($getCountexpiring == 0){
                    $startDt      = strtotime(date('Y-m-d'));
                    $endDt        = strtotime($v->jobExpiryDate);
                    $days_between = ceil(abs($endDt - $startDt) / 86400);


                    $msgStr  = 'Your job post '.$v->jobTitle.' is expiring in '.$days_between.' days';
                    //echo $val->jobId.'======';
                    sendNotification($msgStr,5,0,$v->createdBy,$v->jobId);
                }               
            }
        }       
                        
    }
}

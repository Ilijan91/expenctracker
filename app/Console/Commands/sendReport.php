<?php

namespace App\Console\Commands;

use App\Buyer;
use App\Mail\SendReportMail;
use App\Services\UserService;
use App\Services\BuyerService;
use Illuminate\Console\Command;
use App\Services\NotificationService;

class sendReport extends Command
{
    protected $userService;
    protected $buyerService;
    protected $notificationService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email report to users at the end of every day, week, and month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NotificationService $notificationService, BuyerService $buyerService, UserService $userService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
        $this->buyerService = $buyerService;
        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $buyers = $this->buyerService->all();
        foreach ($buyers as $buyer) {
            $report = $this->notificationService->all($buyer);
            $rep = [];
            foreach ($report as $key => $value) {
                $rep[$key] = json_encode($value);
            }
            $this->userService->sendEmail($buyer->email, new SendReportMail($rep, $buyer));
        }
    }
}

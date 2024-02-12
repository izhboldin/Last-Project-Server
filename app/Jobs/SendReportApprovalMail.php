<?php

namespace App\Jobs;

use App\Mail\ReportApprovalMailer;
use App\Models\Ban;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReportApprovalMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $user;
    public $ban;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Ban $ban)
    {
        $this->user = $user;
        $this->ban = $ban;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new ReportApprovalMailer($this->ban));
    }
}

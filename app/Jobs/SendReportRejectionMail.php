<?php

namespace App\Jobs;

use App\Mail\ReportRejectionMailer;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReportRejectionMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $complaint;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Complaint $complaint)
    {
        $this->user = $user;
        $this->complaint = $complaint;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new ReportRejectionMailer($this->complaint));

    }
}

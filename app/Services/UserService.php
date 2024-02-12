<?php

namespace App\Services;

use App\Jobs\SendReportApprovalMail;
use App\Jobs\SendReportRejectionMail;
use App\Mail\ReportApprovalMailer;
use App\Mail\ReportRejectionMailer;
use App\Models\Ban;
use App\Models\Complaint;
use App\Models\Image;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function createReport(Request $request, Complaint $complaint)
    {

        $data['expiry_time'] = $request->get('expiry_time');
        $data['is_permanent_ban'] = $request->get('is_permanent_ban');

        if ($data['expiry_time'] == null && $data['is_permanent_ban'] == null || Carbon::parse($data['expiry_time'])->lessThan(Carbon::now())) {
            return redirect()->back();
        }

        $ban = Ban::where('complaint_id', $complaint->id)->with('user', 'complaint')->first();

        if (!$ban) {
            if ($data['is_permanent_ban'] != null) {
                $ban = Ban::create([
                    'complaint_id' => $complaint->id,
                    'user_id' => $complaint->reported_user_id,
                    'is_permanent_ban' => true,
                ]);
            } else {
                $ban = Ban::create([
                    'complaint_id' => $complaint->id,
                    'user_id' => $complaint->reported_user_id,
                    'expiry_time' => $request->get('expiry_time'),
                    'is_permanent_ban' => false,
                ]);
            }
        }
        $user = User::where('id', $complaint->reported_user_id)->first();

        SendReportApprovalMail::dispatch($user, $ban);

        $complaint->update(['status' =>  'active']);
    }

    public function dismissReport(Complaint $complaint)
    {
        $user = User::where('id', $complaint->complainant_user_id)->first();

        $complaint->update(['status' =>  'reject']);

        SendReportRejectionMail::dispatch($user, $complaint);

        // Mail::to($user->email)->send(new ReportRejectionMailer($complaint));
    }
}

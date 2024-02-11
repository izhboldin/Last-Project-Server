<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\BanRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Mail\ReportApprovalMailer;
use App\Models\Ban;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function createBan(BanRequest $request, Complaint $complaint)
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

        Mail::to($request->user()->email)->send(new ReportApprovalMailer($ban));

        $complaint->update(['status' =>  'active']);

        return $ban;
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validated();
        $user->update($data);

        return redirect()->route('user.index');
    }

    public function search(SearchRequest $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'like', '%' . $search . '%')->get();

        return view('user.index', compact('users'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateReportForUserException;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\BanRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Mail\ReportApprovalMailer;
use App\Mail\ReportRejectionMailer;
use App\Models\Ban;
use App\Models\Complaint;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {

        $users = User::all();
        return view('user.index', compact('users'));
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

    public function createReport(BanRequest $request, Complaint $complaint)
    {
        try {
            $this->userService->createReport($request, $complaint);
        } catch (CreateReportForUserException $e) {
            return new JsonResponse(
                ['message' => $e->getMessage(),],
                400
            );
        }

        return redirect()->route('complaints.index');
    }

    public function dismissReport(Complaint $complaint)
    {
        try {
            $this->userService->dismissReport($complaint);
        } catch (CreateReportForUserException $e) {
            return new JsonResponse(
                ['message' => $e->getMessage(),],
                400
            );
        }
        return redirect()->route('complaints.index');
    }
}

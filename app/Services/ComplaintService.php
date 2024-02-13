<?php

namespace App\Services;

use App\Exceptions\ListCategoryException;
use App\Models\Chat;
use App\Models\Complaint;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ComplaintService
{

    public function ApiIndex(Request $request)
    {
        $complaints = Complaint::query();

        return $complaints->get();
    }

    public function index(Request $request)
    {
        $complaints = Complaint::query()->where('status', 'wait')->with('complainantUser', 'reportedUser');

        return $complaints->get();
    }

    public function get(Request $request, Complaint $complaint)
    {
        if (!$complaint) {
            return [];
        }

        $complaint->load('complainantUser', 'reportedUser');

        if ($complaint['chat_id'] !== null && $complaint['type'] == 'chat') {
            $complaint->load('chat.messages');
        }
        if ($complaint['product_id'] !== null && $complaint['type'] == 'product') {
            $complaint->load('product.options.parameter', 'product.category');
        }

        return $complaint;
    }

    public function create(User $user, $data)
    {
        $data['complainant_user_id'] = $user->id;

        if($data['type'] == 'chat'){
            $complaint = Complaint::where('complainant_user_id', $data['complainant_user_id'])->where('reported_user_id', $data['reported_user_id'])->where('chat_id', $data['chat_id'])->first();
        }
        if($data['type'] == 'product'){
            $complaint = Complaint::where('complainant_user_id', $data['complainant_user_id'])->where('reported_user_id', $data['reported_user_id'])->where('product_id', $data['product_id'])->first();
        }


        if (!$complaint) {
        $complaint =  Complaint::create($data);
        } else {
            $complaint->update($data);
        }

        return $complaint;
    }
}

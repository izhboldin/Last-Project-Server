<?php

namespace App\Http\Controllers;

use App\Exceptions\IndexComplaintException;
use App\Models\Complaint;
use App\Services\ComplaintService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * It's our dependency injection - service of categories
     *
     * @param ComplaintService
     */
    private $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    public function index(Request $request)
    {

        $this->authorize('index', Complaint::class);
        try {
            $complaints = $this->complaintService->index($request);
        } catch (IndexComplaintException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return view('complaints.index', compact('complaints'));
    }

    public function get(Request $request, Complaint $complaint)
    {

        $this->authorize('get', Complaint::class);
        try {
            $complaint = $this->complaintService->get($request, $complaint);
        } catch (IndexComplaintException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }
        return view('complaints.details', compact('complaint'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CreateComplaintException;
use App\Exceptions\IndexComplaintException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateComplaintRequest;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use App\Services\ComplaintService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComplaintApiController extends Controller
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
            $complaints = $this->complaintService->apiIndex($request);
        } catch (IndexComplaintException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }
        return ComplaintResource::collection($complaints)->resolve();
    }

    public function create(CreateComplaintRequest $request)
    {
        $this->authorize('create', Complaint::class);

        $user = $request->user();
        $data = $request->validated();

        try {
            $complaints = $this->complaintService->create($user, $data);
        } catch (CreateComplaintException $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400
            );
        }

        return new ComplaintResource($complaints);
    }
}

<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateParameterException;
use App\Http\Requests\ParameterRequest;
use App\Models\Category;
use App\Models\Option;
use App\Models\Parameter;
use App\Services\ParameterService;
use Illuminate\Http\JsonResponse;

class ParameterController extends Controller
{
    private $parameterService;

    public function __construct(ParameterService $parameterService)
    {
        $this->parameterService = $parameterService;
    }

    public function show(string $id)
    {
        $parameters = Parameter::where('category_id', '=', $id)->with(['options'])->get();

        return view('parameter.index', compact('parameters', 'id'));
    }

    public function edit(Parameter $parameter, string $category_id)
    {
        return view('parameter.edit', compact('parameter', 'category_id'));
    }

    public function back(string $category_id)
    {
        $category = Category::where('id', '=', $category_id)->get();

        if ($category['0']['parent_category_id'] == null) {
            return redirect()->route('categories.index');
        } else {
            return redirect()->route('categories.more', $category['0']['parent_category_id']);
        }
    }

    public function create(ParameterRequest $request, string $id)
    {
        $data = $request->validated();


        try {
            $this->parameterService->create($data);
        } catch (CreateParameterException $e) {
            return new JsonResponse(
                ['message' => $e->getMessage(),],
                400
            );
        }
        return redirect()->route('parameters.show', $id);
    }

    public function update(ParameterRequest $request, Parameter $parameter, string $id)
    {
        $data = $request->validated();

        try {
            $this->parameterService->update($data, $parameter);
        } catch (CreateParameterException $e) {
            return new JsonResponse(
                ['message' => $e->getMessage(),],
                400
            );
        }

        return redirect()->route('parameters.show', $id);
    }

    public function delete(Parameter $parameter, string $id)
    {
        try {
            $this->parameterService->delete($parameter);
        } catch (CreateParameterException $e) {
            return new JsonResponse(
                ['message' => $e->getMessage(),],
                400
            );
        }

        return redirect()->route('parameters.show', $id);
    }
}

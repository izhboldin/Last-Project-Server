<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Option;
use App\Models\Parameter;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(string $id)
    {
        $options = Option::where('parameter_id', '=', $id)->get();

        return view('parameter.option.index', compact('options', 'id'));
    }

    public function edit(Option $option, string $parameter_id)
    {
        return view('parameter.option.edit', compact('option', 'parameter_id'));
    }

    public function back(string $parameter_id){

        $parameter = Parameter::where('id', '=', $parameter_id)->get();

        return redirect()->route('parameters.show', $parameter['0']['category_id']);

        // if($category['0']['parent_category_id'] == null){
        //     return redirect()->route('categories.index');
        // }else{
        //     return redirect()->route('categories.more', $category['0']['parent_category_id']);
        // }
    }

    public function create(OptionRequest $request, string $id)
    {
        $data = $request->validated();
        Option::create($data);

        return redirect()->route('options.create', $id);
    }

    public function update(UpdateOptionRequest $request, Option $option, string $id)
    {
        $data = $request->validated();
        $option->update($data);

        return redirect()->route('options.index', $id);
    }
}

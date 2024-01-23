<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(string $id){
        $options = Option::where('parameter_id', '=', $id)->get();

        return view('parameter.option.index', compact('options', 'id'));
    }

    public function create(OptionRequest $request, string $id){
        $data = $request->validated();
        Option::create($data);

        return redirect()->route('options.create', $id);
    }
}

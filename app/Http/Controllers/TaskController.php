<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {

        $tasks = [
            'Таска 1',
            'Таска 2',
            'Таска 3',
            'Таска 4',
            'Таска 5',
            'Таска 6',
        ];
        return view('test.index', ['name' => 'Alex', 'tasks' => $tasks]);
        //    return $tasks;
    }

    public function store(Request $request)
    {

        $data = $request->except('_token');

        $test = Test::create($data);

        return redirect()->route('test.show', ['test' => $test->id]);
    }

    public function show(string $id)
    {
        $test = Test::findOrFail($id);

        return view('test.show', ['test' => $test]);
    }
}

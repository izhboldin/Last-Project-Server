<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\SearchRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    //

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

}

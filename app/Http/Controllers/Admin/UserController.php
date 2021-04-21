<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUser;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(): View
    {
        $users = User::list()->paginate(5);
        return view('admin.users.index', ['userList' => $users]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(UpdateUser $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $user = $user->fill($request->validated());
        if ($user->save()) {
            return redirect()->route('admin.users.index')->with('success', __('validation-inline.admin.messages.edit.success'));
        }
        return back()->with('error', __('validation-inline.admin.messages.edit.error'));
    }

    public function destroy(User $user)
    {
        //
    }
}

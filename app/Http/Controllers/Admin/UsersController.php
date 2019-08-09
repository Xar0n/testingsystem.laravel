<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Requests\CheckId;
use App\Http\Requests\CheckUser;
use App\User;

class UsersController extends GeneralController
{
    public function showAll()
	{
		$users = User::all();
		$groups = Group::all(); //ДОДЕЛАТЬ
		return view('admin.users', ['users' => $users, 'groups' => $groups]);
	}

	public function showOne(CheckId $request)
	{
		$user = User::findOrFail($request->input('id'));
		$groups = Group::all();
		return view('admin.users', ['user' => $user, 'groups' => $groups]);
	}

	public function showFormAdd()
	{
		return view('admin.add_user');
	}

	public function showFormEdit($user_id)
	{
		$user = User::findOrFail($user_id);
		$group = Group::findOrFail($user->id);
		return view('admin.edit_user', ['user' => $user, 'group' => $group]);
	}

	public function add(CheckUser $request)
	{

	}

	public function edit(CheckUser $request, $user_id)
	{

	}

	public function delete($user_id)
	{
		$user = User::findOrFail($user_id);
		$user->delete();
		return redirect('/admin_panel/users');
	}
}

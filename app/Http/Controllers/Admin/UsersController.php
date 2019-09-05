<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\CheckEditUser;
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
		$groups = Group::all();
		return view('admin.add_user', ['groups' => $groups]);
	}

	public function showFormEdit($user_id)
	{
		$user = User::findOrFail($user_id);
		$groups = Group::all();
		return view('admin.edit_user', ['user' => $user, 'groups' => $groups]);
	}

	public function add(CheckUser $request)
	{
		$register = new RegisterController;
		$register->register($request);
		return redirect('/admin_panel/users/add');
	}

	public function edit(CheckEditUser $request, $user_id)
	{
		$user = User::findOrFail($user_id);
		$user->name = $request->input('name');
		$user->surname = $request->input('surname');
		$user->patronymic = $request->input('patronymic');
		$user->group_id = $request->input('group_id');
		$user->save();
		return redirect()->back();
	}

	public function delete($user_id)
	{
		User::destroy($user_id);
		return redirect()->back();
	}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Requests\CheckId;
use App\Http\Requests\CheckGroup;
class GroupsController extends GeneralController
{
	public function showFormAdd()
	{
		return view('admin.add_group');
	}

	public function showFormEdit($group_id)
	{
		$group = Group::findOrFail($group_id);
		return view('admin.edit_group', ['group' => $group]);
	}

	public function showFormPlannedTests($group_id)
	{

	}

    public function showAll()
	{
		$groups = Group::all();
		return view('admin.groups', ['groups' => $groups]);
	}

	public function showOne(CheckId $request)
	{
		$group = Group::find($request->input('id'));
		return view('admin.groups', ['group' => $group]);
	}

	public function edit(CheckGroup $request, $group_id)
	{
		$group = Group::findOrFail($group_id);
		$group->name = $request->input('name');
		$group->save();
		return redirect('/admin_panel/groups');
	}

	public function add(CheckGroup $request)
	{
		$group = new Group;
		$group->name = $request->input('name');
		$group->save();
		return view('admin.add_group');
	}

	public function addTest()
	{

	}

	public function deleteTest()
	{

	}

	public function delete($group_id) //ДОДЕЛАТЬ
	{
		$group = Group::findOrFail($group_id);
		$group->delete();
		return redirect('/admin_panel/groups');
	}
}

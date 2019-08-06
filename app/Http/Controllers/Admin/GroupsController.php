<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Requests\CheckId;
use App\Http\Requests\CheckGroup;
use App\Scheduled_Test;
use App\Test;

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

	public function showFormScheduledTests($group_id)
	{
		$tests = [];
		$group = Group::findOrFail($group_id);
		$scheduled_tests = Scheduled_Test::where('group_id', '=', $group_id)->get();
		foreach ($scheduled_tests as $scheduled_test)
		{
			$test = Test::findOrFail($scheduled_test->test_id);
			$test->time = $scheduled_test->time;
			$test->date_first = $scheduled_test->date_first;
			$test->date_last = $scheduled_test->date_last;
			$tests[] = $test;
		}
		return view('admin.scheduled_tests', ['group' => $group, 'tests' => $tests]);
	}

	public function showFormAddTest()
	{
		return view('admin.add_test_group');
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

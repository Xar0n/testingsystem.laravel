<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CheckId;
use App\Http\Requests\CheckTest;
use App\Test;

class TestsController extends GeneralController
{
	public function showFormAdd()
	{
		return view('admin.add_test');
	}

	public function showFormEdit($test_id)
	{
		$test = Test::findOrFail($test_id);
		return view('admin.edit_test', ['test' => $test]);
	}

    public function showAll()
	{
		$tests = Test::all();
		return view('admin.tests', ['tests' => $tests]);
	}

	public function showOne(CheckId $request)
	{
		$test = Test::find($request->input('id'));
		return view('admin.tests', ['test' => $test]);
	}

	public function edit(CheckTest $request, $test_id)
	{
		$test = Test::findOrFail($test_id);
		$test->title = $request->input('title');
		$test->description = $request->input('description');
		$test->time = $request->input('time');
		$test->date = $request->input('date').' '.$request->input('time_date').':00';
		$test->save();
		return redirect('/admin_panel/tests');
	}

	public function add(CheckTest $request)
	{
		$test = new Test;
		$test->title = $request->input('title');
		$test->description = $request->input('description');
		$test->time = $request->input('time');
		$test->date = $request->input('date').' '.$request->input('time_date').':00';
		$test->save();
		return view('admin.add_test');

	}

	public function delete($test_id)
	{
		$test = Test::findOrFail($test_id);
		$test->delete();
		return redirect('/admin_panel/tests');
	}
}

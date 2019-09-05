<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Group;
use App\Http\Requests\CheckId;
use App\Http\Requests\CheckScheduledTest;
use App\Scheduled_Test;
use App\Test;

class ScheduledTestController extends Controller
{
	public function showAll($group_id)
	{
		$tests = [];
		$group = Group::findOrFail($group_id);
		$scheduled_tests = Scheduled_Test::where('group_id', '=', $group_id)->get();
		$all_tests = Test::orderBy('id' ,'desc')->get();
		foreach ($scheduled_tests as $scheduled_test)
		{
			$test = Test::findOrFail($scheduled_test->test_id);
			$test->id = $scheduled_test->id;
			$test->time = $scheduled_test->time;
			$test->date_first = $scheduled_test->date_first;
			$test->date_last = $scheduled_test->date_last;
			$tests[] = $test;
		}
		return view('admin.scheduled_tests', ['group' => $group, 'tests' => $tests, 'all_tests' => $all_tests]);
	}

	public function showOne($group_id ,CheckId $request)
	{
		$tests = [];
		$group = Group::findOrFail($group_id);
		$scheduled_tests = Scheduled_Test::where('group_id', '=', $group_id)->get();
		$one_test = Test::find($request->input('id'));
		foreach ($scheduled_tests as $scheduled_test)
		{
			$test = Test::findOrFail($scheduled_test->test_id);
			$test->time = $scheduled_test->time;
			$test->date_first = $scheduled_test->date_first;
			$test->date_last = $scheduled_test->date_last;
			$tests[] = $test;
		}
		return view('admin.scheduled_tests', ['group' => $group, 'tests' => $tests, 'one_test' => $one_test]);
	}

	public function showFormAdd($group_id, $test_id)
	{
		$test = Test::findOrFail($test_id);
		$group = Group::findOrFail($group_id);
		return view('admin.add_test_group', ['test' => $test, 'group' => $group]);
	}

	public function showFormEdit($scheduled_id)
	{
		$test_s = Scheduled_Test::findOrFail($scheduled_id);
		$test = Test::findOrFail($test_s->test_id);
		$group = Group::findOrFail($test_s->group_id);
		return view('admin.edit_test_group', ['test' => $test, 'group' => $group, 'test_s' => $test_s]);
	}

	public function add(CheckScheduledTest $request, $group_id, $test_id)
	{
		$test_s = new Scheduled_Test;
		$test_s->time = $request->input('time').':00';
		$test_s->date_first = $request->input('date_first').' '.$request->input('time_first').':00';
		$test_s->date_last = $request->input('date_last').' '.$request->input('time_last').':00';
		$test_s->group_id = $group_id;
		$test_s->test_id = $test_id;
		$test_s->save();
		return redirect("/admin_panel/groups/scheduled_tests/$group_id");
	}

	public function edit(CheckScheduledTest $request, $scheduled_id)
	{
		$test_s = Scheduled_Test::findOrFail($scheduled_id);
		$test_s->time = $request->input('time').':00';
		$test_s->date_first = $request->input('date_first').' '.$request->input('time_first').':00';
		$test_s->date_last = $request->input('date_last').' '.$request->input('time_last').':00';
		$test_s->save();
		return redirect("/admin_panel/groups/scheduled_tests/$test_s->group_id");
	}

	public function delete($scheduled_id)
	{
		Scheduled_Test::destroy($scheduled_id);
		return redirect()->back();
	}
}
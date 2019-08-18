<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Requests\CheckId;
use App\Result;
use App\Scheduled_Test;
use App\Http\Controllers\Controller;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultsController extends Controller
{
    public function showForm()
	{
		$groups = Group::all();
		return view('admin.index', ['groups' => $groups]);
	}

	public function showFormGroup($group_id)
	{
		$group = Group::findOrFail($group_id);
		$tests_s = Scheduled_Test::where('group_id', $group_id)->get();
		foreach ($tests_s as $test_s)
		{
			$test = Test::findOrFail($test_s->test_id);
			$test_s->name = $test->name;
		}
		return view('admin.results', ['group' => $group, 'tests_s' => $tests_s]);
	}

	public function showResults(CheckId $test_s_id, $group_id)
	{
		$group = Group::findOrFail($group_id);
		$test_s = Scheduled_Test::findOrFail($test_s_id);
		$results = Result::where([['user_id', Auth::user()->id], ['scheduled_test_id', $test_s->id]])->get();
		return view('admin.show_results');
	}

	public function getScheduledTests(Request $request)
	{
		$group_id = $request->input('group_id');
		return $group_id;
	}

	public function getResults()
	{

	}

	public function edit()
	{

	}

	public function delete()
	{

	}
}

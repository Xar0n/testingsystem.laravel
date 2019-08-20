<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Requests\CheckId;
use App\Performed_Test;
use App\Question;
use App\Result;
use App\Result_Question;
use App\Scheduled_Test;
use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ResultsController extends Controller
{
    public function showForm()
	{
		$groups = Group::all();
		return view('admin.index', ['groups' => $groups]);
	}

	public function showResults(CheckId $request)
	{
		$scheduled_test = Scheduled_Test::findOrFail($request->input('id'));
		$results = Result::where('scheduled_test_id', $scheduled_test->id)->orderBy('points', 'desc')->get();
		$test = Test::findOrFail($scheduled_test->test_id);
		$group = Group::findOrFail($scheduled_test->group_id);
		foreach ($results as $result)
		{
			$user = User::findOrFail($result->user_id);
			$result->user_login = $user->login;
		}
		return view('admin.results', ['results' => $results, 'test' => $test, 'group' => $group]);
	}

	public function showResult($result_id)
	{
		$keys = [];
		$values = [];
		$result = Result::findOrFail($result_id);
		$s_test = Scheduled_Test::findOrFail($result->scheduled_test_id);
		$test = Test::findOrFail($s_test->test_id);
		$user =  User::findOrFail($result->user_id);
		$result_questions = Result_Question::where('result_id', $result->id)->get();
		$questions = Question::where('test_id', $test->id)->get();
		foreach ($result_questions as $result_question)
		{
			$keys[] = $result_question->question_id;
			$values[] = $result_question;
		}
		$result_questions = array_combine($keys, $values);
		return view('admin.show_result', ['result' => $result,'result_questions' => $result_questions, 'user' => $user, 'test' => $test, 'questions' => $questions]);
	}

	public function getScheduledTests()
	{
		$group_id = Input::get('group');
		$group = Group::findOrFail($group_id);
		$scheduled_tests = Scheduled_Test::where('group_id', $group->id)->get();
		foreach ($scheduled_tests as $scheduled_test)
		{
			$test = Test::findOrFail($scheduled_test->test_id);
			$scheduled_test->name = $test->name;
		}
		return json_encode($scheduled_tests);
	}

	public function getResults()
	{

	}

	public function edit()
	{

	}

	public function delete($result_id)
	{
		$result = Result::findOrFail($result_id);
		$scheduled_test_id = $result->scheduled_test_id;
		$performed_test = Performed_Test::where([['user_id', $result->user_id], ['scheduled_test_id', $scheduled_test_id]]);
		$result_questions = Result_Question::where('result_id', $result->id)->get();
		foreach ($result_questions as $result_question)
		{
			$result_question->delete();
		}
		$result->delete();
		$performed_test->delete();
		return redirect()->to('/admin_panel/groups');
	}
}

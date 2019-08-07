<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CheckQuestionForm;
use App\Test;
use Illuminate\Http\Request;

class QuestionsController extends GeneralController
{
	public function showForm(CheckQuestionForm $request, $test_id)
	{
		$test = Test::findOrFail($test_id);
		$count = $request->input('count');
		$count_variants = $request->input('count_variants');
		$type = $request->input('type');
		return view('admin.add_questions', ['test' => $test, 'count' => $count, 'type' => $type, 'count_variants' => $count_variants]);
	}
}

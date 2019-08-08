<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckQuestionForm;
use App\Http\Requests\CheckQuestions;
use App\Question;
use App\Test;
use App\Variant_Question;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
	public function showForm(CheckQuestionForm $request, $test_id)
	{
		$test = Test::findOrFail($test_id);
		$count = $request->input('count');
		$count_variants = $request->input('count_variants');
		$type = $request->input('type');
		return view('admin.add_questions', ['test' => $test, 'count' => $count, 'type' => $type, 'count_variants' => $count_variants]);
	}

	public function showAll($test_id)
	{
		$test = Test::findOrFail($test_id);
		$questions = Question::where('test_id', $test_id)->get();
		$variants = [];
		foreach ($questions as $question) {
			if ($question->type == 2) {
				$variants[$question->id] = Variant_Question::where('question_id', $question->id)->get();
			}
		}
		return view('admin.show_questions', ['test' => $test, 'questions' => $questions, 'variants' => $variants]);
	}

	public function add(CheckQuestions $request, $test_id)
	{
		$test = Test::findOrFail($test_id);
		$type = false;
		if($request->input('type') == 2)
		{
			$v = Validator::make($request->all(), [
				"variant.*.*" => "required|min:1|max:1000",
			]);

			if ($v->fails())
			{
				return redirect('/admin_panel/tests')->withErrors($v->errors());
			}
			$type = true;
			$variants = $request->input('variant');
		}
		$questions = $request->input('question');
		$answers = $request->input('answer');
		if (count($questions) != count($answers))
		{
			abort('404');
		}
		//Проверку бы на ключи сделать, да лень. И так сойдет:)
		$count = count($questions);
		for($i = 1; $i <= $count; $i++) {
			$question = new Question;
			$question->description = $questions[$i];
			$question->true_answer = $answers[$i];
			$question->test_id = $test->id;
			if (!$type) {
				$question->type = 1;
			} else{
				$question->type = 2;
			}
			$question->save();
			var_dump($question->id);
			if($type)
			{
				foreach ($variants as $variant) {
					foreach ($variant as $v)
					{
						$var = new Variant_Question;
						$var->question_id = $question->id;
						$var->description = $v;
						$var->save();
					}
				}
			}
		}
		return redirect("/admin_panel/questions/$test->id");
	}

	public function edit($question_id)
	{

	}

	public function delete($question_id)
	{

	}




}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinishTest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "answers.*" => "max:500",
        ];
    }

    public function messages()
	{
		return [
			"answers.*.max" => "Превышено допустимое количество символов в ответе"
		];
	}
}

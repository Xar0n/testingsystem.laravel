<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckQuestions extends FormRequest
{
	protected $redirect = '/admin_panel/tests';
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
			"questions.*" => "required|min:1|max:1000",
			"type" => 'required|min:1|max:2|integer',
			"answer.*" => "required|min:1|max:1000",
        ];
    }
}

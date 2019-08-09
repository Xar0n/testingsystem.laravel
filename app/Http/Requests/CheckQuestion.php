<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckQuestion extends FormRequest
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
			"question" => "required|min:1|max:1000",
			"answer" => "required|min:1|max:1000",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckScheduledTest extends FormRequest
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
            'time' => 'required|date_format:"H:i"',
			'date_first' => 'required|date',
			'time_first' => 'required|date_format:"H:i"',
			'date_last' => 'required|date',
			'time_last' => 'required|date_format:"H:i"'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckEditUser extends FormRequest
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
			'name' => 'required|min:1|max:255',
			'surname' => 'required|min:1|max:255',
			'patronymic' => 'required|min:1|max:255',
			'city' => 'required|min:1|max:255',
			'group_id' => 'required|min:1|integer'
        ];
    }
}

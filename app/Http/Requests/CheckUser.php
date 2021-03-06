<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUser extends FormRequest
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
			'login' => 'required|max:255|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6',
			'name' => 'required|min:1|max:255',
			'surname' => 'required|min:1|max:255',
			'patronymic' => 'required|min:1|max:255',
			'city' => 'required|min:1|max:255',
			'group_id' => 'required|min:1|integer'
        ];
    }
}

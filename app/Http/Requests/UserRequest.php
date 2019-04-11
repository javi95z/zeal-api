<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
	    return Auth::check() ? true : false;
	}

    /**
     * @return array
     */
	public function rules()
	{
		return [
			'email'         	=> 'required|email|unique:users,email,' . $this->id,
			'fullname'			=> 'required|string|min:4|max:255',
			'password'			=> 'nullable|min:6',
			'phone_number'		=> 'nullable|numeric|digits_between:0,50',
			'profile_picture'	=> 'nullable|image',
		];
	}

}

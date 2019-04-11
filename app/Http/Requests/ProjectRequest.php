<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'code'				=> 'required|max:6|unique:projects,code,' . $this->id,
			'description'		=> 'nullable',
			'end_date'			=> 'nullable|date|after:start_date',
			'price'				=> 'nullable|regex:/^\d*(\.\d{2})?$/',
			'start_date'		=> 'nullable|date',
            'title'				=> 'required',
		];
	}
}

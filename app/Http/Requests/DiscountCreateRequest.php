<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class DiscountCreateRequest extends FormRequest
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
		$carbon = (new Carbon())->subtract('days', 1);
        return [
			'title' => 'string|min:3',
			'code' => 'nullable|min:3',
			'description' => 'required',
			'start_at' => 'required|date|after:'.$carbon ,
			'end_at' => 'required|date|after_or_equal:'.$this->start_at,
			'main_image' => 'required|file|mimes:png,jpg',
        ];
    }
}

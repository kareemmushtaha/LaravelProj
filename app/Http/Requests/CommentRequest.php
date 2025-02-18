<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class CommentRequest extends FormRequest
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
            'comment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => __('validation.required'),
            'step_id.required' => __('validation.required'),
            'step_id.exists' => __('validation.exists'),
            'user_id.required' => __('validation.required'),
            'user_id.exists' => __('validation.exists'),
        ];
    }
}

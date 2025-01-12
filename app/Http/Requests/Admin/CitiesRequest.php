<?php

namespace App\Http\Requests\Admin;

 use Illuminate\Foundation\Http\FormRequest;

class CitiesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_ar' => [
                'string',
                'required',
            ],
            'title_en' => [
                'string',
                'required',
            ],
            'status' => [
                'string',
                'required',
            ]
        ];
    }
}

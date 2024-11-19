<?php

namespace App\Http\Requests;

use App\Models\ContactType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:2',
                'max:255',
                'required',
            ],
        ];
    }
}

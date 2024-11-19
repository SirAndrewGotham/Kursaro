<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_edit');
    }

    public function rules()
    {
        return [
            'contact_type_id' => [
                'required',
                'integer',
            ],
            'contact' => [
                'string',
                'min:2',
                'max:255',
                'required',
            ],
            'is_public' => [
                'required',
            ],
            'is_preferable' => [
                'required',
            ],
        ];
    }
}

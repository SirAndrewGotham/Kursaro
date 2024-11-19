<?php

namespace App\Http\Requests;

use App\Models\Prospect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProspectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prospect_edit');
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
            'description' => [
                'required',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'is_active' => [
                'required',
            ],
            'views' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
        ];
    }
}

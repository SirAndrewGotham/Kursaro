<?php

namespace App\Http\Requests;

use App\Models\Home;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHomeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('home_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}

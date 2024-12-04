<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLanguageRequest extends FormRequest
{
    public function authorize()
    {
//        return Gate::allows('language_create');
        return Auth::check();
    }

    public function rules()
    {
        return [
//            'default' => [
//                'required',
//            ],
            'code' => [
                'string',
                'min:2',
                'max:12',
                'required',
            ],
            'regional' => [
                'string',
                'nullable',
            ],
            'script' => [
                'string',
                'nullable',
            ],
            'dir' => [
                'string',
                'nullable',
            ],
            'flag' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'min:2',
                'max:255',
                'nullable',
            ],
            'english' => [
                'string',
                'min:2',
                'max:255',
                'nullable',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePageRequest extends FormRequest
{
    public function authorize()
    {
//        return Gate::allows('page_edit');
        return Auth::check();
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:2',
                'max:255',
                'nullable',
            ],
            'content' => [
                'required',
            ],
            'views' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}

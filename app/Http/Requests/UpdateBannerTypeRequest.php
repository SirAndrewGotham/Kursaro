<?php

namespace App\Http\Requests;

use App\Models\BannerType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBannerTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('banner_type_edit');
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

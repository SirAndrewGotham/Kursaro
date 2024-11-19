<?php

namespace App\Http\Requests;

use App\Models\Banner;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBannerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('banner_create');
    }

    public function rules()
    {
        return [
            'banner_type_id' => [
                'required',
                'integer',
            ],
            'banner_spot_id' => [
                'required',
                'integer',
            ],
            'languages.*' => [
                'integer',
            ],
            'languages' => [
                'array',
            ],
            'is_active' => [
                'required',
            ],
            'title' => [
                'string',
                'nullable',
            ],
            'subtitle' => [
                'string',
                'nullable',
            ],
            'path' => [
                'string',
                'nullable',
            ],
        ];
    }
}

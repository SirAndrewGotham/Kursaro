<?php

namespace App\Http\Requests;

use App\Models\BannerSpot;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBannerSpotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('banner_spot_create');
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
            'size' => [
                'string',
                'min:2',
                'max:255',
                'nullable',
            ],
        ];
    }
}

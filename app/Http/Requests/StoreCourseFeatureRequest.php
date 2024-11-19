<?php

namespace App\Http\Requests;

use App\Models\CourseFeature;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseFeatureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_feature_create');
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

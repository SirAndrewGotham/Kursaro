<?php

namespace App\Http\Requests;

use App\Models\CourseFeature;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourseFeatureRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('course_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:course_features,id',
        ];
    }
}

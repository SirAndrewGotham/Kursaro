<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseFeatureRequest;
use App\Http\Requests\UpdateCourseFeatureRequest;
use App\Http\Resources\Backend\CourseFeatureResource;
use App\Models\CourseFeature;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseFeatureApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_feature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseFeatureResource(CourseFeature::with(['feature'])->get());
    }

    public function store(StoreCourseFeatureRequest $request)
    {
        $courseFeature = CourseFeature::create($request->all());

        return (new CourseFeatureResource($courseFeature))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CourseFeature $courseFeature)
    {
        abort_if(Gate::denies('course_feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseFeatureResource($courseFeature->load(['feature']));
    }

    public function update(UpdateCourseFeatureRequest $request, CourseFeature $courseFeature)
    {
        $courseFeature->update($request->all());

        return (new CourseFeatureResource($courseFeature))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CourseFeature $courseFeature)
    {
        abort_if(Gate::denies('course_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseFeature->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

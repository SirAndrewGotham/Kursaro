<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\Backend\CourseResource;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource(Course::with(['course', 'user', 'language', 'categories', 'course_features'])->get());
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->categories()->sync($request->input('categories', []));
        $course->course_features()->sync($request->input('course_features', []));
        if ($request->input('image', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource($course->load(['course', 'user', 'language', 'categories', 'course_features']));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        $course->categories()->sync($request->input('categories', []));
        $course->course_features()->sync($request->input('course_features', []));
        if ($request->input('image', false)) {
            if (! $course->image || $request->input('image') !== $course->image->file_name) {
                if ($course->image) {
                    $course->image->delete();
                }
                $course->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($course->image) {
            $course->image->delete();
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

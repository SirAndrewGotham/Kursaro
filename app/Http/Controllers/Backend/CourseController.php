<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseFeature;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Course::with(['course', 'user', 'language', 'categories', 'course_features'])->select(sprintf('%s.*', (new Course)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'course_show';
                $editGate      = 'course_edit';
                $deleteGate    = 'course_delete';
                $crudRoutePart = 'courses';

                return view('backend.default.layouts.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('course_name', function ($row) {
                return $row->course ? $row->course->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('language_english', function ($row) {
                return $row->language ? $row->language->english : '';
            });

            $table->editColumn('language.name', function ($row) {
                return $row->language ? (is_string($row->language) ? $row->language : $row->language->name) : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
            });
            $table->editColumn('all_languages', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->all_languages ? 'checked' : null) . '>';
            });
            $table->editColumn('views', function ($row) {
                return $row->views ? $row->views : '';
            });
            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('course_feature', function ($row) {
                $labels = [];
                foreach ($row->course_features as $course_feature) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $course_feature->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'course', 'user', 'language', 'image', 'is_active', 'all_languages', 'category', 'course_feature']);

            return $table->make(true);
        }

        $courses         = Course::get();
        $users           = User::get();
        $languages       = Language::get();
        $categories      = Category::get();
        $course_features = CourseFeature::get();

        return view('backend.default.courses.index', compact('courses', 'users', 'languages', 'categories', 'course_features'));
    }

    public function create()
    {
//        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $course_features = CourseFeature::pluck('name', 'id');

        return view('backend.default.courses.create', compact('categories', 'course_features', 'courses', 'languages', 'users'));
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->categories()->sync($request->input('categories', []));
        $course->course_features()->sync($request->input('course_features', []));
        if ($request->input('image', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $course->id]);
        }

        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
//        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $course_features = CourseFeature::pluck('name', 'id');

        $course->load('course', 'user', 'language', 'categories', 'course_features');

        return view('backend.default.courses.edit', compact('categories', 'course', 'course_features', 'courses', 'languages', 'users'));
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

        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course)
    {
//        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('course', 'user', 'language', 'categories', 'course_features', 'courseCourses', 'courseProspects');

        return view('backend.default.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
//        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseRequest $request)
    {
        $courses = Course::find(request('ids'));

        foreach ($courses as $course) {
            $course->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('course_create') && Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Course();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

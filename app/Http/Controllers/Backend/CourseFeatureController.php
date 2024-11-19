<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Http\Requests\MassDestroyCourseFeatureRequest;
use App\Http\Requests\StoreCourseFeatureRequest;
use App\Http\Requests\UpdateCourseFeatureRequest;
use App\Models\CourseFeature;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CourseFeatureController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('course_feature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CourseFeature::with(['feature'])->select(sprintf('%s.*', (new CourseFeature)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'course_feature_show';
                $editGate      = 'course_feature_edit';
                $deleteGate    = 'course_feature_delete';
                $crudRoutePart = 'course-features';

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
            $table->addColumn('feature_name', function ($row) {
                return $row->feature ? $row->feature->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'feature']);

            return $table->make(true);
        }

        $course_features = CourseFeature::get();

        return view('backend.default.courseFeatures.index', compact('course_features'));
    }

    public function create()
    {
//        abort_if(Gate::denies('course_feature_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $features = CourseFeature::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.default.courseFeatures.create', compact('features'));
    }

    public function store(StoreCourseFeatureRequest $request)
    {
        $courseFeature = CourseFeature::create($request->all());

        return redirect()->route('admin.course-features.index');
    }

    public function edit(CourseFeature $courseFeature)
    {
//        abort_if(Gate::denies('course_feature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $features = CourseFeature::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseFeature->load('feature');

        return view('backend.default.courseFeatures.edit', compact('courseFeature', 'features'));
    }

    public function update(UpdateCourseFeatureRequest $request, CourseFeature $courseFeature)
    {
        $courseFeature->update($request->all());

        return redirect()->route('admin.course-features.index');
    }

    public function show(CourseFeature $courseFeature)
    {
//        abort_if(Gate::denies('course_feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseFeature->load('feature', 'featureCourseFeatures');

        return view('backend.default.courseFeatures.show', compact('courseFeature'));
    }

    public function destroy(CourseFeature $courseFeature)
    {
//        abort_if(Gate::denies('course_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseFeature->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseFeatureRequest $request)
    {
        $courseFeatures = CourseFeature::find(request('ids'));

        foreach ($courseFeatures as $courseFeature) {
            $courseFeature->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

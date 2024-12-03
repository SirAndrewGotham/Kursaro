<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProspectRequest;
use App\Http\Requests\StoreProspectRequest;
use App\Http\Requests\UpdateProspectRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Language;
use App\Models\Prospect;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProspectController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('prospect_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
//            $query = Prospect::with(['course', 'user', 'language', 'categories'])->select(sprintf('%s.*', (new Prospect)->table));
            $query = Prospect::select(sprintf('%s.*', (new Prospect)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'prospect_show';
                $editGate      = 'prospect_edit';
                $deleteGate    = 'prospect_delete';
                $crudRoutePart = 'prospects';

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

            $table->rawColumns(['actions', 'placeholder', 'course', 'user', 'language', 'image', 'is_active', 'all_languages', 'category']);

            return $table->make(true);
        }

        $courses    = Course::get();
        $users      = User::get();
        $languages  = Language::get();
        $categories = Category::get();

        return view('backend.default.prospects.index', compact('courses', 'users', 'languages', 'categories'));
    }

    public function create()
    {
//        abort_if(Gate::denies('prospect_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        return view('backend.default.prospects.create', compact('categories', 'courses', 'languages', 'users'));
    }

    public function store(StoreProspectRequest $request)
    {
        $prospect = Prospect::create($request->all());
        $prospect->categories()->sync($request->input('categories', []));
        if ($request->input('image', false)) {
            $prospect->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $prospect->id]);
        }

        return redirect()->route('admin.prospects.index');
    }

    public function edit(Prospect $prospect)
    {
//        abort_if(Gate::denies('prospect_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $prospect->load('course', 'user', 'language', 'categories');

        return view('backend.default.prospects.edit', compact('categories', 'courses', 'languages', 'prospect', 'users'));
    }

    public function update(UpdateProspectRequest $request, Prospect $prospect)
    {
        $prospect->update($request->all());
        $prospect->categories()->sync($request->input('categories', []));
        if ($request->input('image', false)) {
            if (! $prospect->image || $request->input('image') !== $prospect->image->file_name) {
                if ($prospect->image) {
                    $prospect->image->delete();
                }
                $prospect->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($prospect->image) {
            $prospect->image->delete();
        }

        return redirect()->route('admin.prospects.index');
    }

    public function show(Prospect $prospect)
    {
//        abort_if(Gate::denies('prospect_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prospect->load('course', 'user', 'language', 'categories');

        return view('backend.default.prospects.show', compact('prospect'));
    }

    public function destroy(Prospect $prospect)
    {
//        abort_if(Gate::denies('prospect_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prospect->delete();

        return back();
    }

    public function massDestroy(MassDestroyProspectRequest $request)
    {
        $prospects = Prospect::find(request('ids'));

        foreach ($prospects as $prospect) {
            $prospect->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('prospect_create') && Gate::denies('prospect_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Prospect();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

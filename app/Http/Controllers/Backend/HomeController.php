<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHomeRequest;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Models\Home;
use App\Models\Language;
//use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('home_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Home::with(['language'])->select(sprintf('%s.*', (new Home)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'home_show';
                $editGate      = 'home_edit';
                $deleteGate    = 'home_delete';
                $crudRoutePart = 'homes';

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
            $table->addColumn('language_english', function ($row) {
                return $row->language ? $row->language->english : '';
            });

            $table->editColumn('language.name', function ($row) {
                return $row->language ? (is_string($row->language) ? $row->language : $row->language->name) : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'language']);

            return $table->make(true);
        }

        $languages = Language::get();

        return view('backend.default.homes.index', compact('languages'));
    }

    public function create()
    {
//        abort_if(Gate::denies('home_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.default.homes.create', compact('languages'));
    }

    public function store(StoreHomeRequest $request)
    {
        $home = Home::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $home->id]);
        }

        return redirect()->route('admin.homes.index');
    }

    public function edit(Home $home)
    {
//        abort_if(Gate::denies('home_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $home->load('language');

        return view('backend.default.homes.edit', compact('home', 'languages'));
    }

    public function update(UpdateHomeRequest $request, Home $home)
    {
        $home->update($request->all());

        return redirect()->route('admin.homes.index');
    }

    public function show(Home $home)
    {
//        abort_if(Gate::denies('home_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $home->load('language');

        return view('backend.default.homes.show', compact('home'));
    }

    public function destroy(Home $home)
    {
//        abort_if(Gate::denies('home_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $home->delete();

        return back();
    }

    public function massDestroy(MassDestroyHomeRequest $request)
    {
        $homes = Home::find(request('ids'));

        foreach ($homes as $home) {
            $home->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('home_create') && Gate::denies('home_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Home();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

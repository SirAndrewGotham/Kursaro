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
                $translateGate = 'home_translate';
                $crudRoutePart = 'homes';

                return view('backend.default.layouts.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'translateGate',
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

            $table->addColumn('is_default', function($row){
                if($row->is_default){
                    return __("Default");
                }
            });

            $table->addColumn('is_active', function($row){
                if($row->is_active){
                    return __("Enabled");
                }else{
                    return __("Disabled");
                }
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
        $exists = Home::where('language_id', $request->language_id);
        if($exists)
        {
            return redirect()->route('admin.homes.index')->with('message', 'Such page already exists. You might want to edit it instead of creating anew. If you don\'t see it in the list, it might have been deleted; request your Admin to restore the page before you would be able to edit it.');
        }
        if($request->is_default)
        {
            //just in case if there were errors in code, check multiple
            $olds = Home::where('is_default', true)->get();
            foreach($olds as $old)
            {
                $old->update(['is_default'=>false]);
            }
        }

        $home = Home::create($request->all());

        // just in case, enforce is_active to be true for the default home page
        if($request->is_default) {
            $home->update(['is_active' => true]);
        }

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
        if($request->is_default)
        {
            //just in case if there were errors in code, check multiple
            $olds = Home::where('is_default', true)->get();
            foreach($olds as $old)
            {
                $old->update(['is_default'=>false]);
            }
        }
        $home->update($request->all());

        // just in case, enforce is_active to be true for the default home page
        if($request->is_default) {
            $home->update(['is_active' => true]);
        }

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
        if($home->is_default)
        {
            return redirect()->route('admin.homes.index')->with('message', 'You can not delete default page without making another one default first. Please make another page default, and try again.');
        }

        $home->delete();

        return back();
    }

    public function massDestroy(MassDestroyHomeRequest $request)
    {
        // todo: exclude default id from mass deletion with appropriate notice
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

    public function translate(Home $home)
    {
//        abort_if(Gate::denies('home_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // todo: give only unused languages
        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $home->load('language');

        return view('backend.default.homes.translate', compact('home', 'languages'));
    }
}

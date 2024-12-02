<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPageRequest;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Language;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Page::where('is_default', true)->with(['page'])->select(sprintf('%s.*', (new Page)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'page_show';
                $editGate      = 'page_edit';
                $deleteGate    = 'page_delete';
                $crudRoutePart = 'pages';

                return view('backend.default.layouts.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

//            $table->editColumn('id', function ($row) {
//                return $row->id ? $row->id : '';
//            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('views', function ($row) {
                return $row->views ? $row->views : '';
            });
            $table->addColumn('page_title', function ($row) {
                return $row->page ? $row->page->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'page']);

            return $table->make(true);
        }

        $pages = Page::where('page_id', null)->get();

        return view('backend.default.pages.index', compact('pages'));
    }

    public function create()
    {
//        abort_if(Gate::denies('page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pages = Page::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.default.pages.create', compact('pages'));
    }

    public function store(StorePageRequest $request)
    {
        // todo: create 2 models:
        // first one with id and slug
        // second one with the above id and real page data
        $page = Page::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $page->id]);
        }

        return redirect()->route('admin.pages.index');
    }

    public function edit(Page $page)
    {
//        abort_if(Gate::denies('page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $languages = Language::all();

        $pages = Page::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $page->load('page');

        return view('backend.default.pages.edit', compact('page', 'pages', 'languages'));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        dd($page);
        $page->update($request->all());

        return redirect()->route('admin.pages.index');
    }

    public function show(Page $page)
    {
//        abort_if(Gate::denies('page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $page->load('page', 'pagePages');

        return view('backend.default.pages.show', compact('page'));
    }

    public function destroy(Page $page)
    {
//        abort_if(Gate::denies('page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $page->delete();

        return back();
    }

    public function massDestroy(MassDestroyPageRequest $request)
    {
        $pages = Page::find(request('ids'));

        foreach ($pages as $page) {
            $page->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('page_create') && Gate::denies('page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Page();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

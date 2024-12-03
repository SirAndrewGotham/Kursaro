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
use Illuminate\Support\Str;
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
            $query = Page::where('page_id', null)->with(['page'])->select(sprintf('%s.*', (new Page)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'page_show';
                $editGate      = 'page_edit';
                $deleteGate    = 'page_delete';
                $translateGate = 'page_translate';
                $crudRoutePart = 'pages';

                return view('backend.default.layouts.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'translateGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('views', function ($row) {
                return $row->views ? $row->views : '';
            });

            // todo: get available translations and show language flags for them in the following filed
            $table->addColumn('page_title', function ($row) {
//                return $row->page ? $row->page->title : '';
                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'page']);

            return $table->make(true);
        }

        $pages = Page::where('page_id', null)->orderBy('id', 'DESC')->get();

        return view('backend.default.pages.index', compact('pages'));
    }

    public function create()
    {
//        abort_if(Gate::denies('page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.default.pages.create', compact('languages'));
    }

    public function store(StorePageRequest $request)
    {
        // we create 2 models:
        // first one with id and slug
        // second one with the above id and real page data
        // files, if any, attached to the second one

        $page_id = Page::insertGetId([
            'is_default' => false,
            'is_active' => true,
            'page_id' => null,
            'language_id' => $request->input('language_id'),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->title),
            'content' => $request->input('content'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $page = Page::create([
            'is_default' => true,
            'is_active' => true,
            'page_id' => $page_id,
            'language_id' => $request->input('language_id'),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->title),
            'content' => $request->input('content'),
        ]);

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $page->id]);
        }

        return redirect()->route('admin.pages.index')->with('message', 'New page created successfully');
    }

    public function storeTranslation(StorePageRequest $request, Page $page)
    {
       $request->validate([
            'language_id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $page_id = $page->page_id;

        if(!$page_id)
        {
            $page_id = $page->id;
        }

        // this next case should never happen, as we give user an option to select
        // only from those languages that were not used before for this page
        $check = Page::where('page_id', $page_id)->where('language_id', $request->input('language_id'))->first();

        if($check)
        {
            return redirect()->route('admin.pages.index')->with('message', 'Such page version already exists. Please edit existing one instead of creating new one.');
        }

        $is_default = false;
        $is_active = $request->input('is_active');

        if($request->input('is_default'))
        {
            // reset old default status
            // just in case if there were errors in code, check multiple
//            $olds = Page::where(['page_id' => $page_id, 'is_default', true])->get();
            $olds = Page::where(['page_id' => $page_id])->get();
            foreach($olds as $old)
            {
                $old->update(['is_default'=>false]);
            }
            $is_default = true;
            $is_active = true;
        }

        $page = Page::create([
            'is_default' => $is_default,
            'is_active' => $is_active,
            'page_id' => $page_id,
            'language_id' => $request->input('language_id'),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->title),
            'content' => $request->input('content'),
        ]);

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $page->id]);
        }

        return redirect()->route('admin.pages.index')->with('message', 'New page created successfully');
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
        $message = 'Changes saved successfully';
        $default_status = $request->is_default;
        $active_status = $request->is_active;

        if($page->is_default && !$request->is_default)
        {
            $default_status = true;
            $active_status = true;
            $message = 'Changes saved successfully, but default status. Please edit page version in the desired language making it default, if you want another page to be shown as default one.';
        }

        if($page->is_default && !$request->is_active)
        {
            $default_status = true;
            $active_status = true;
            $message = 'Changes saved successfully, but its availability status. Default page can not be made inactive.';
        }

        $page->update([
            'is_default' => $default_status,
            'is_active' => $active_status,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'page_id' => $page->page_id,
            'language_id' => $page->language_id,
            'slug' => $page->slug,
            'views' => $page->views,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.pages.index')->with('message', $message);
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

    public function translate(Page $page)
    {
//        abort_if(Gate::denies('home_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $page_id = $page->page_id;
        if($page_id == null)
        {
            $page_id = $page->id;
        }

        // remove used languages from the collection
        foreach (Page::where('page_id', $page_id)->get() as $page) {
            $languages->forget($page->language_id);
        }

        $page->load('language');

        return view('backend.default.pages.translate', compact('page', 'languages'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Http\Requests\MassDestroyLanguageRequest;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LanguageController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('language_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Language::query()->select(sprintf('%s.*', (new Language)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'language_show';
                $editGate      = 'language_edit';
                $deleteGate    = 'language_delete';
                $crudRoutePart = 'languages';

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
            $table->editColumn('default', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->default ? 'checked' : null) . '>';
            });
            $table->editColumn('fallback', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->fallback ? 'checked' : null) . '>';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('regional', function ($row) {
                return $row->regional ? $row->regional : '';
            });
            $table->editColumn('script', function ($row) {
                return $row->script ? $row->script : '';
            });
            $table->editColumn('dir', function ($row) {
                return $row->dir ? $row->dir : '';
            });
            $table->editColumn('flag', function ($row) {
                return $row->flag ? $row->flag : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('english', function ($row) {
                return $row->english ? $row->english : '';
            });
            $table->editColumn('available', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->available ? 'checked' : null) . '>';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'default', 'fallback', 'available', 'active']);

            return $table->make(true);
        }

        return view('backend.default.languages.index');
    }

    public function create()
    {
//        abort_if(Gate::denies('language_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.languages.create');
    }

    public function store(StoreLanguageRequest $request)
    {
        $language = Language::create($request->all());

        return redirect()->route('admin.languages.index');
    }

    public function edit(Language $language)
    {
//        abort_if(Gate::denies('language_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.languages.edit', compact('language'));
    }

    public function update(UpdateLanguageRequest $request, Language $language)
    {
        $language->update($request->all());

        return redirect()->route('admin.languages.index');
    }

    public function show(Language $language)
    {
//        abort_if(Gate::denies('language_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->load('languageHomes', 'languageCategories', 'languageCourses', 'languageProspects', 'languageBanners');

        return view('backend.default.languages.show', compact('language'));
    }

    public function destroy(Language $language)
    {
//        abort_if(Gate::denies('language_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->delete();

        return back();
    }

    public function massDestroy(MassDestroyLanguageRequest $request)
    {
        $languages = Language::find(request('ids'));

        foreach ($languages as $language) {
            $language->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

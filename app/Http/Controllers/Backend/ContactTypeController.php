<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContactTypeRequest;
use App\Http\Requests\StoreContactTypeRequest;
use App\Http\Requests\UpdateContactTypeRequest;
use App\Models\ContactType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactTypeController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('contact_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactType::query()->select(sprintf('%s.*', (new ContactType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contact_type_show';
                $editGate      = 'contact_type_edit';
                $deleteGate    = 'contact_type_delete';
                $crudRoutePart = 'contact-types';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('backend.default.contactTypes.index');
    }

    public function create()
    {
//        abort_if(Gate::denies('contact_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.contactTypes.create');
    }

    public function store(StoreContactTypeRequest $request)
    {
        $contactType = ContactType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contactType->id]);
        }

        return redirect()->route('admin.contact-types.index');
    }

    public function edit(ContactType $contactType)
    {
//        abort_if(Gate::denies('contact_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.contactTypes.edit', compact('contactType'));
    }

    public function update(UpdateContactTypeRequest $request, ContactType $contactType)
    {
        $contactType->update($request->all());

        return redirect()->route('admin.contact-types.index');
    }

    public function show(ContactType $contactType)
    {
//        abort_if(Gate::denies('contact_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.contactTypes.show', compact('contactType'));
    }

    public function destroy(ContactType $contactType)
    {
//        abort_if(Gate::denies('contact_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactType->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactTypeRequest $request)
    {
        $contactTypes = ContactType::find(request('ids'));

        foreach ($contactTypes as $contactType) {
            $contactType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('contact_type_create') && Gate::denies('contact_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContactType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Http\Requests\MassDestroyContactRequest;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\ContactType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Contact::with(['contact_type'])->select(sprintf('%s.*', (new Contact)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contact_show';
                $editGate      = 'contact_edit';
                $deleteGate    = 'contact_delete';
                $crudRoutePart = 'contacts';

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
            $table->addColumn('contact_type_name', function ($row) {
                return $row->contact_type ? $row->contact_type->name : '';
            });

            $table->editColumn('contact', function ($row) {
                return $row->contact ? $row->contact : '';
            });
            $table->editColumn('is_public', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_public ? 'checked' : null) . '>';
            });
            $table->editColumn('is_preferable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_preferable ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'contact_type', 'is_public', 'is_preferable']);

            return $table->make(true);
        }

        $contact_types = ContactType::get();

        return view('backend.default.contacts.index', compact('contact_types'));
    }

    public function create()
    {
//        abort_if(Gate::denies('contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_types = ContactType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.default.contacts.create', compact('contact_types'));
    }

    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->all());

        return redirect()->route('admin.contacts.index');
    }

    public function edit(Contact $contact)
    {
//        abort_if(Gate::denies('contact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_types = ContactType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contact->load('contact_type');

        return view('backend.default.contacts.edit', compact('contact', 'contact_types'));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());

        return redirect()->route('admin.contacts.index');
    }

    public function show(Contact $contact)
    {
//        abort_if(Gate::denies('contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact->load('contact_type');

        return view('backend.default.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
//        abort_if(Gate::denies('contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactRequest $request)
    {
        $contacts = Contact::find(request('ids'));

        foreach ($contacts as $contact) {
            $contact->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

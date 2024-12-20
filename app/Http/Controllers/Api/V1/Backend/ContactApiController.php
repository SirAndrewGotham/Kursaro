<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\Backend\ContactResource;
use App\Models\Contact;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactResource(Contact::with(['contact_type'])->get());
    }

    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->all());

        return (new ContactResource($contact))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Contact $contact)
    {
        abort_if(Gate::denies('contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactResource($contact->load(['contact_type']));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());

        return (new ContactResource($contact))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Contact $contact)
    {
        abort_if(Gate::denies('contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

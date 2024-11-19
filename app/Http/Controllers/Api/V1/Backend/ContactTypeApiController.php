<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\StoreContactTypeRequest;
use App\Http\Requests\UpdateContactTypeRequest;
use App\Http\Resources\Backend\ContactTypeResource;
use App\Models\ContactType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactTypeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('contact_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactTypeResource(ContactType::all());
    }

    public function store(StoreContactTypeRequest $request)
    {
        $contactType = ContactType::create($request->all());

        return (new ContactTypeResource($contactType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ContactType $contactType)
    {
        abort_if(Gate::denies('contact_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactTypeResource($contactType);
    }

    public function update(UpdateContactTypeRequest $request, ContactType $contactType)
    {
        $contactType->update($request->all());

        return (new ContactTypeResource($contactType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ContactType $contactType)
    {
        abort_if(Gate::denies('contact_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

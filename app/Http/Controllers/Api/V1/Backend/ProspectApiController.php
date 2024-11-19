<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\StoreProspectRequest;
use App\Http\Requests\UpdateProspectRequest;
use App\Http\Resources\Backend\ProspectResource;
use App\Models\Prospect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProspectApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('prospect_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProspectResource(Prospect::with(['course', 'user', 'language', 'categories'])->get());
    }

    public function store(StoreProspectRequest $request)
    {
        $prospect = Prospect::create($request->all());
        $prospect->categories()->sync($request->input('categories', []));
        if ($request->input('image', false)) {
            $prospect->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new ProspectResource($prospect))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Prospect $prospect)
    {
        abort_if(Gate::denies('prospect_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProspectResource($prospect->load(['course', 'user', 'language', 'categories']));
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

        return (new ProspectResource($prospect))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Prospect $prospect)
    {
        abort_if(Gate::denies('prospect_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prospect->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

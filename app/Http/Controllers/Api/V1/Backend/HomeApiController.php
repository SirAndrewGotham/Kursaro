<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Http\Resources\Backend\HomeResource;
use App\Models\Home;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('home_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HomeResource(Home::with(['language'])->get());
    }

    public function store(StoreHomeRequest $request)
    {
        $home = Home::create($request->all());

        return (new HomeResource($home))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Home $home)
    {
        abort_if(Gate::denies('home_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HomeResource($home->load(['language']));
    }

    public function update(UpdateHomeRequest $request, Home $home)
    {
        $home->update($request->all());

        return (new HomeResource($home))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Home $home)
    {
        abort_if(Gate::denies('home_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $home->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\StoreBannerTypeRequest;
use App\Http\Requests\UpdateBannerTypeRequest;
use App\Http\Resources\Backend\BannerTypeResource;
use App\Models\BannerType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannerTypeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('banner_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BannerTypeResource(BannerType::all());
    }

    public function store(StoreBannerTypeRequest $request)
    {
        $bannerType = BannerType::create($request->all());

        return (new BannerTypeResource($bannerType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BannerType $bannerType)
    {
        abort_if(Gate::denies('banner_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BannerTypeResource($bannerType);
    }

    public function update(UpdateBannerTypeRequest $request, BannerType $bannerType)
    {
        $bannerType->update($request->all());

        return (new BannerTypeResource($bannerType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BannerType $bannerType)
    {
        abort_if(Gate::denies('banner_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

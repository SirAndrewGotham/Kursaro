<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\StoreBannerSpotRequest;
use App\Http\Requests\UpdateBannerSpotRequest;
use App\Http\Resources\Backend\BannerSpotResource;
use App\Models\BannerSpot;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannerSpotApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('banner_spot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BannerSpotResource(BannerSpot::all());
    }

    public function store(StoreBannerSpotRequest $request)
    {
        $bannerSpot = BannerSpot::create($request->all());

        return (new BannerSpotResource($bannerSpot))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BannerSpot $bannerSpot)
    {
        abort_if(Gate::denies('banner_spot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BannerSpotResource($bannerSpot);
    }

    public function update(UpdateBannerSpotRequest $request, BannerSpot $bannerSpot)
    {
        $bannerSpot->update($request->all());

        return (new BannerSpotResource($bannerSpot))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BannerSpot $bannerSpot)
    {
        abort_if(Gate::denies('banner_spot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerSpot->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

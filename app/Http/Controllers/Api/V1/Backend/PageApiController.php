<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Http\Resources\Backend\PageResource;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PageResource(Page::with(['page'])->get());
    }

    public function store(StorePageRequest $request)
    {
        $page = Page::create($request->all());

        return (new PageResource($page))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Page $page)
    {
        abort_if(Gate::denies('page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PageResource($page->load(['page']));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update($request->all());

        return (new PageResource($page))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Page $page)
    {
        abort_if(Gate::denies('page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $page->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

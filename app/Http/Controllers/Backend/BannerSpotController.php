<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBannerSpotRequest;
use App\Http\Requests\StoreBannerSpotRequest;
use App\Http\Requests\UpdateBannerSpotRequest;
use App\Models\BannerSpot;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BannerSpotController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('banner_spot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BannerSpot::query()->select(sprintf('%s.*', (new BannerSpot)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'banner_spot_show';
                $editGate      = 'banner_spot_edit';
                $deleteGate    = 'banner_spot_delete';
                $crudRoutePart = 'banner-spots';

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
            $table->editColumn('size', function ($row) {
                return $row->size ? $row->size : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('backend.default.bannerSpots.index');
    }

    public function create()
    {
//        abort_if(Gate::denies('banner_spot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.bannerSpots.create');
    }

    public function store(StoreBannerSpotRequest $request)
    {
        $bannerSpot = BannerSpot::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bannerSpot->id]);
        }

        return redirect()->route('admin.banner-spots.index');
    }

    public function edit(BannerSpot $bannerSpot)
    {
//        abort_if(Gate::denies('banner_spot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.bannerSpots.edit', compact('bannerSpot'));
    }

    public function update(UpdateBannerSpotRequest $request, BannerSpot $bannerSpot)
    {
        $bannerSpot->update($request->all());

        return redirect()->route('admin.banner-spots.index');
    }

    public function show(BannerSpot $bannerSpot)
    {
//        abort_if(Gate::denies('banner_spot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerSpot->load('bannerSpotBanners');

        return view('backend.default.bannerSpots.show', compact('bannerSpot'));
    }

    public function destroy(BannerSpot $bannerSpot)
    {
//        abort_if(Gate::denies('banner_spot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerSpot->delete();

        return back();
    }

    public function massDestroy(MassDestroyBannerSpotRequest $request)
    {
        $bannerSpots = BannerSpot::find(request('ids'));

        foreach ($bannerSpots as $bannerSpot) {
            $bannerSpot->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('banner_spot_create') && Gate::denies('banner_spot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BannerSpot();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

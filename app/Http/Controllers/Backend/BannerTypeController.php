<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBannerTypeRequest;
use App\Http\Requests\StoreBannerTypeRequest;
use App\Http\Requests\UpdateBannerTypeRequest;
use App\Models\BannerType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BannerTypeController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('banner_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BannerType::query()->select(sprintf('%s.*', (new BannerType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'banner_type_show';
                $editGate      = 'banner_type_edit';
                $deleteGate    = 'banner_type_delete';
                $crudRoutePart = 'banner-types';

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
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'is_active']);

            return $table->make(true);
        }

        return view('backend.default.bannerTypes.index');
    }

    public function create()
    {
//        abort_if(Gate::denies('banner_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.bannerTypes.create');
    }

    public function store(StoreBannerTypeRequest $request)
    {
        $bannerType = BannerType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bannerType->id]);
        }

        return redirect()->route('admin.banner-types.index');
    }

    public function edit(BannerType $bannerType)
    {
//        abort_if(Gate::denies('banner_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.default.bannerTypes.edit', compact('bannerType'));
    }

    public function update(UpdateBannerTypeRequest $request, BannerType $bannerType)
    {
        $bannerType->update($request->all());

        return redirect()->route('admin.banner-types.index');
    }

    public function show(BannerType $bannerType)
    {
//        abort_if(Gate::denies('banner_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerType->load('bannerTypeBanners');

        return view('backend.default.bannerTypes.show', compact('bannerType'));
    }

    public function destroy(BannerType $bannerType)
    {
//        abort_if(Gate::denies('banner_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bannerType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBannerTypeRequest $request)
    {
        $bannerTypes = BannerType::find(request('ids'));

        foreach ($bannerTypes as $bannerType) {
            $bannerType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('banner_type_create') && Gate::denies('banner_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BannerType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

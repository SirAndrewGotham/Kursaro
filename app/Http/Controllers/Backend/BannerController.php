<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Concerns\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBannerRequest;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Models\BannerSpot;
use App\Models\BannerType;
use App\Models\Language;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('banner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Banner::with(['banner_type', 'banner_spot', 'languages'])->select(sprintf('%s.*', (new Banner)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'banner_show';
                $editGate      = 'banner_edit';
                $deleteGate    = 'banner_delete';
                $crudRoutePart = 'banners';

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
            $table->addColumn('banner_type_name', function ($row) {
                return $row->banner_type ? $row->banner_type->name : '';
            });

            $table->editColumn('banner_type.is_active', function ($row) {
                return $row->banner_type ? (is_string($row->banner_type) ? $row->banner_type : $row->banner_type->is_active) : '';
            });
            $table->addColumn('banner_spot_name', function ($row) {
                return $row->banner_spot ? $row->banner_spot->name : '';
            });

            $table->editColumn('banner_spot.size', function ($row) {
                return $row->banner_spot ? (is_string($row->banner_spot) ? $row->banner_spot : $row->banner_spot->size) : '';
            });
            $table->editColumn('all_languages', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->all_languages ? 'checked' : null) . '>';
            });
            $table->editColumn('language', function ($row) {
                $labels = [];
                foreach ($row->languages as $language) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $language->english);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('subtitle', function ($row) {
                return $row->subtitle ? $row->subtitle : '';
            });
            $table->editColumn('path', function ($row) {
                return $row->path ? $row->path : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'banner_type', 'banner_spot', 'all_languages', 'language', 'is_active', 'image']);

            return $table->make(true);
        }

        $banner_types = BannerType::get();
        $banner_spots = BannerSpot::get();
        $languages    = Language::get();

        return view('backend.default.banners.index', compact('banner_types', 'banner_spots', 'languages'));
    }

    public function create()
    {
//        abort_if(Gate::denies('banner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banner_types = BannerType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $banner_spots = BannerSpot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('english', 'id');

        return view('backend.default.banners.create', compact('banner_spots', 'banner_types', 'languages'));
    }

    public function store(StoreBannerRequest $request)
    {
        $banner = Banner::create($request->all());
        $banner->languages()->sync($request->input('languages', []));
        if ($request->input('image', false)) {
            $banner->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $banner->id]);
        }

        return redirect()->route('admin.banners.index');
    }

    public function edit(Banner $banner)
    {
//        abort_if(Gate::denies('banner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banner_types = BannerType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $banner_spots = BannerSpot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('english', 'id');

        $banner->load('banner_type', 'banner_spot', 'languages');

        return view('backend.default.banners.edit', compact('banner', 'banner_spots', 'banner_types', 'languages'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $banner->update($request->all());
        $banner->languages()->sync($request->input('languages', []));
        if ($request->input('image', false)) {
            if (! $banner->image || $request->input('image') !== $banner->image->file_name) {
                if ($banner->image) {
                    $banner->image->delete();
                }
                $banner->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($banner->image) {
            $banner->image->delete();
        }

        return redirect()->route('admin.banners.index');
    }

    public function show(Banner $banner)
    {
//        abort_if(Gate::denies('banner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banner->load('banner_type', 'banner_spot', 'languages');

        return view('backend.default.banners.show', compact('banner'));
    }

    public function destroy(Banner $banner)
    {
//        abort_if(Gate::denies('banner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banner->delete();

        return back();
    }

    public function massDestroy(MassDestroyBannerRequest $request)
    {
        $banners = Banner::find(request('ids'));

        foreach ($banners as $banner) {
            $banner->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('banner_create') && Gate::denies('banner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Banner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

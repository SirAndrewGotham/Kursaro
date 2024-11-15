@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bannerSpot.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banner-spots.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerSpot.fields.id') }}
                        </th>
                        <td>
                            {{ $bannerSpot->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerSpot.fields.name') }}
                        </th>
                        <td>
                            {{ $bannerSpot->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerSpot.fields.description') }}
                        </th>
                        <td>
                            {!! $bannerSpot->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bannerSpot.fields.size') }}
                        </th>
                        <td>
                            {{ $bannerSpot->size }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banner-spots.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#banner_spot_banners" role="tab" data-toggle="tab">
                {{ trans('cruds.banner.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="banner_spot_banners">
            @includeIf('admin.bannerSpots.relationships.bannerSpotBanners', ['banners' => $bannerSpot->bannerSpotBanners])
        </div>
    </div>
</div>

@endsection

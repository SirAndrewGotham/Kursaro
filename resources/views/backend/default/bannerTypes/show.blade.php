@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.bannerType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banner-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.bannerType.fields.id') }}
                        </th>
                        <td>
                            {{ $bannerType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.bannerType.fields.name') }}
                        </th>
                        <td>
                            {{ $bannerType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.bannerType.fields.description') }}
                        </th>
                        <td>
                            {!! $bannerType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.bannerType.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bannerType->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banner-types.index') }}">
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
            <a class="nav-link" href="#banner_type_banners" role="tab" data-toggle="tab">
                {{ trans('back.banner.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="banner_type_banners">
            @includeIf('admin.bannerTypes.relationships.bannerTypeBanners', ['banners' => $bannerType->bannerTypeBanners])
        </div>
    </div>
</div>

@endsection

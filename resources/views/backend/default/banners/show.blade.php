@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.banner.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.id') }}
                        </th>
                        <td>
                            {{ $banner->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.banner_type') }}
                        </th>
                        <td>
                            {{ $banner->banner_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.banner_spot') }}
                        </th>
                        <td>
                            {{ $banner->banner_spot->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.all_languages') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $banner->all_languages ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.language') }}
                        </th>
                        <td>
                            @foreach($banner->languages as $key => $language)
                                <span class="label label-info">{{ $language->english }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $banner->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.title') }}
                        </th>
                        <td>
                            {{ $banner->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.subtitle') }}
                        </th>
                        <td>
                            {{ $banner->subtitle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.teaser') }}
                        </th>
                        <td>
                            {!! $banner->teaser !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.path') }}
                        </th>
                        <td>
                            {{ $banner->path }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.banner.fields.image') }}
                        </th>
                        <td>
                            @if($banner->image)
                                <a href="{{ $banner->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $banner->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

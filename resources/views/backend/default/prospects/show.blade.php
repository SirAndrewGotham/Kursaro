@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.prospect.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prospects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.id') }}
                        </th>
                        <td>
                            {{ $prospect->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.course') }}
                        </th>
                        <td>
                            {{ $prospect->course->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.user') }}
                        </th>
                        <td>
                            {{ $prospect->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.language') }}
                        </th>
                        <td>
                            {{ $prospect->language->english ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.name') }}
                        </th>
                        <td>
                            {{ $prospect->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.image') }}
                        </th>
                        <td>
                            @if($prospect->image)
                                <a href="{{ $prospect->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $prospect->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.description') }}
                        </th>
                        <td>
                            {!! $prospect->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.link') }}
                        </th>
                        <td>
                            {{ $prospect->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $prospect->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.all_languages') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $prospect->all_languages ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.views') }}
                        </th>
                        <td>
                            {{ $prospect->views }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prospect.fields.category') }}
                        </th>
                        <td>
                            @foreach($prospect->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prospects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

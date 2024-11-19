@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.home.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.homes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.home.fields.id') }}
                        </th>
                        <td>
                            {{ $home->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.home.fields.language') }}
                        </th>
                        <td>
                            {{ $home->language->english ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.home.fields.title') }}
                        </th>
                        <td>
                            {{ $home->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.home.fields.content') }}
                        </th>
                        <td>
                            {!! $home->content !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.homes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

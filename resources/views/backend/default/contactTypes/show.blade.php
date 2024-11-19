@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.contactType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.contactType.fields.id') }}
                        </th>
                        <td>
                            {{ $contactType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.contactType.fields.name') }}
                        </th>
                        <td>
                            {{ $contactType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.contactType.fields.description') }}
                        </th>
                        <td>
                            {!! $contactType->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

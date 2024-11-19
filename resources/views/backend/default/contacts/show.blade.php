@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.contact.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contacts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.contact.fields.id') }}
                        </th>
                        <td>
                            {{ $contact->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.contact.fields.contact_type') }}
                        </th>
                        <td>
                            {{ $contact->contact_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.contact.fields.contact') }}
                        </th>
                        <td>
                            {{ $contact->contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.contact.fields.is_public') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $contact->is_public ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.contact.fields.is_preferable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $contact->is_preferable ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contacts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

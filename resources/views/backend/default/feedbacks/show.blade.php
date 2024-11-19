@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.feedback.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.feedbacks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.feedback.fields.id') }}
                        </th>
                        <td>
                            {{ $feedback->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.feedback.fields.user') }}
                        </th>
                        <td>
                            {{ $feedback->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.feedback.fields.name') }}
                        </th>
                        <td>
                            {{ $feedback->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.feedback.fields.email') }}
                        </th>
                        <td>
                            {{ $feedback->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.feedback.fields.message') }}
                        </th>
                        <td>
                            {{ $feedback->message }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.feedbacks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.user.fields.two_factor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.user.fields.language') }}
                        </th>
                        <td>
                            {{ $user->language->english ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#user_courses" role="tab" data-toggle="tab">
                {{ trans('back.course.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_feedbacks" role="tab" data-toggle="tab">
                {{ trans('back.feedback.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_prospects" role="tab" data-toggle="tab">
                {{ trans('back.prospect.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_courses">
            @includeIf('admin.users.relationships.userCourses', ['courses' => $user->userCourses])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_feedbacks">
            @includeIf('admin.users.relationships.userFeedbacks', ['feedbacks' => $user->userFeedbacks])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_prospects">
            @includeIf('admin.users.relationships.userProspects', ['prospects' => $user->userProspects])
        </div>
    </div>
</div>

@endsection

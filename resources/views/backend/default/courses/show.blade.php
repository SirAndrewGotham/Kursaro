@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.course.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.id') }}
                        </th>
                        <td>
                            {{ $course->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.course') }}
                        </th>
                        <td>
                            {{ $course->course->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.user') }}
                        </th>
                        <td>
                            {{ $course->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.language') }}
                        </th>
                        <td>
                            {{ $course->language->english ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.name') }}
                        </th>
                        <td>
                            {{ $course->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.image') }}
                        </th>
                        <td>
                            @if($course->image)
                                <a href="{{ $course->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $course->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.description') }}
                        </th>
                        <td>
                            {!! $course->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.link') }}
                        </th>
                        <td>
                            {{ $course->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $course->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.all_languages') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $course->all_languages ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.views') }}
                        </th>
                        <td>
                            {{ $course->views }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.category') }}
                        </th>
                        <td>
                            @foreach($course->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.course.fields.course_feature') }}
                        </th>
                        <td>
                            @foreach($course->course_features as $key => $course_feature)
                                <span class="label label-info">{{ $course_feature->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
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
            <a class="nav-link" href="#course_courses" role="tab" data-toggle="tab">
                {{ trans('back.course.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#course_prospects" role="tab" data-toggle="tab">
                {{ trans('back.prospect.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="course_courses">
            @includeIf('admin.courses.relationships.courseCourses', ['courses' => $course->courseCourses])
        </div>
        <div class="tab-pane" role="tabpanel" id="course_prospects">
            @includeIf('admin.courses.relationships.courseProspects', ['prospects' => $course->courseProspects])
        </div>
    </div>
</div>

@endsection

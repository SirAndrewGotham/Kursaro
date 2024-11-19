@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.courseFeature.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-features.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.courseFeature.fields.id') }}
                        </th>
                        <td>
                            {{ $courseFeature->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.courseFeature.fields.feature') }}
                        </th>
                        <td>
                            {{ $courseFeature->feature->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.courseFeature.fields.name') }}
                        </th>
                        <td>
                            {{ $courseFeature->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.courseFeature.fields.description') }}
                        </th>
                        <td>
                            {{ $courseFeature->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-features.index') }}">
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
            <a class="nav-link" href="#feature_course_features" role="tab" data-toggle="tab">
                {{ trans('back.courseFeature.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="feature_course_features">
            @includeIf('admin.courseFeatures.relationships.featureCourseFeatures', ['courseFeatures' => $courseFeature->featureCourseFeatures])
        </div>
    </div>
</div>

@endsection

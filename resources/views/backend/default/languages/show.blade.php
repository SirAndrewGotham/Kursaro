@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.language.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.languages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.id') }}
                        </th>
                        <td>
                            {{ $language->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.default') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $language->default ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.fallback') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $language->fallback ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.code') }}
                        </th>
                        <td>
                            {{ $language->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.regional') }}
                        </th>
                        <td>
                            {{ $language->regional }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.script') }}
                        </th>
                        <td>
                            {{ $language->script }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.dir') }}
                        </th>
                        <td>
                            {{ $language->dir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.flag') }}
                        </th>
                        <td>
                            {{ $language->flag }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.name') }}
                        </th>
                        <td>
                            {{ $language->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.english') }}
                        </th>
                        <td>
                            {{ $language->english }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $language->is_available ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.language.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $language->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.languages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        {{ trans('global.relatedData') }}--}}
{{--    </div>--}}
{{--    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#language_homes" role="tab" data-toggle="tab">--}}
{{--                {{ trans('back.home.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#language_categories" role="tab" data-toggle="tab">--}}
{{--                {{ trans('back.category.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#language_courses" role="tab" data-toggle="tab">--}}
{{--                {{ trans('back.course.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#language_prospects" role="tab" data-toggle="tab">--}}
{{--                {{ trans('back.prospect.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#language_banners" role="tab" data-toggle="tab">--}}
{{--                {{ trans('back.banner.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--    <div class="tab-content">--}}
{{--        <div class="tab-pane" role="tabpanel" id="language_homes">--}}
{{--            @includeIf('backend.default.languages.relationships.languageHomes', ['homes' => $language->languageHomes])--}}
{{--        </div>--}}
{{--        <div class="tab-pane" role="tabpanel" id="language_categories">--}}
{{--            @includeIf('backend.default.languages.relationships.languageCategories', ['categories' => $language->languageCategories])--}}
{{--        </div>--}}
{{--        <div class="tab-pane" role="tabpanel" id="language_courses">--}}
{{--            @includeIf('backend.default.languages.relationships.languageCourses', ['courses' => $language->languageCourses])--}}
{{--        </div>--}}
{{--        <div class="tab-pane" role="tabpanel" id="language_prospects">--}}
{{--            @includeIf('backend.default.languages.relationships.languageProspects', ['prospects' => $language->languageProspects])--}}
{{--        </div>--}}
{{--        <div class="tab-pane" role="tabpanel" id="language_banners">--}}
{{--            @includeIf('backend.default.languages.relationships.languageBanners', ['banners' => $language->languageBanners])--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@endsection

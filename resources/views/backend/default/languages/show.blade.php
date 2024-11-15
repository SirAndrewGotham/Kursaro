@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.language.title') }}
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
                            {{ trans('cruds.language.fields.id') }}
                        </th>
                        <td>
                            {{ $language->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.default') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $language->default ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.fallback') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $language->fallback ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.code') }}
                        </th>
                        <td>
                            {{ $language->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.regional') }}
                        </th>
                        <td>
                            {{ $language->regional }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.script') }}
                        </th>
                        <td>
                            {{ $language->script }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.dir') }}
                        </th>
                        <td>
                            {{ $language->dir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.flag') }}
                        </th>
                        <td>
                            {{ $language->flag }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.name') }}
                        </th>
                        <td>
                            {{ $language->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.english') }}
                        </th>
                        <td>
                            {{ $language->english }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $language->available ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.language.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $language->active ? 'checked' : '' }}>
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

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#language_homes" role="tab" data-toggle="tab">
                {{ trans('cruds.home.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#language_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.category.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#language_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#language_prospects" role="tab" data-toggle="tab">
                {{ trans('cruds.prospect.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#language_banners" role="tab" data-toggle="tab">
                {{ trans('cruds.banner.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="language_homes">
            @includeIf('admin.languages.relationships.languageHomes', ['homes' => $language->languageHomes])
        </div>
        <div class="tab-pane" role="tabpanel" id="language_categories">
            @includeIf('admin.languages.relationships.languageCategories', ['categories' => $language->languageCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="language_courses">
            @includeIf('admin.languages.relationships.languageCourses', ['courses' => $language->languageCourses])
        </div>
        <div class="tab-pane" role="tabpanel" id="language_prospects">
            @includeIf('admin.languages.relationships.languageProspects', ['prospects' => $language->languageProspects])
        </div>
        <div class="tab-pane" role="tabpanel" id="language_banners">
            @includeIf('admin.languages.relationships.languageBanners', ['banners' => $language->languageBanners])
        </div>
    </div>
</div>

@endsection

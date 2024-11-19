@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.category.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.category.fields.id') }}
                        </th>
                        <td>
                            {{ $category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.category.fields.name') }}
                        </th>
                        <td>
                            {{ $category->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.category.fields.description') }}
                        </th>
                        <td>
                            {!! $category->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.category.fields.image') }}
                        </th>
                        <td>
                            @if($category->image)
                                <a href="{{ $category->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $category->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.category.fields.language') }}
                        </th>
                        <td>
                            {{ $category->language->english ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.category.fields.category') }}
                        </th>
                        <td>
                            {{ $category->category->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
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
            <a class="nav-link" href="#category_categories" role="tab" data-toggle="tab">
                {{ trans('back.category.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#category_courses" role="tab" data-toggle="tab">
                {{ trans('back.course.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#category_prospects" role="tab" data-toggle="tab">
                {{ trans('back.prospect.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="category_categories">
            @includeIf('admin.categories.relationships.categoryCategories', ['categories' => $category->categoryCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="category_courses">
            @includeIf('admin.categories.relationships.categoryCourses', ['courses' => $category->categoryCourses])
        </div>
        <div class="tab-pane" role="tabpanel" id="category_prospects">
            @includeIf('admin.categories.relationships.categoryProspects', ['prospects' => $category->categoryProspects])
        </div>
    </div>
</div>

@endsection

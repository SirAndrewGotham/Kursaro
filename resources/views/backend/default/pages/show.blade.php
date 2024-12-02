@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.page.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('back.page.fields.id') }}
                        </th>
                        <td>
                            {{ $page->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.page.fields.is_default') }}
                        </th>
                        <td>
                            @if($page->is_default)
                                {{ __('Yes') }}
                            @else
                                {{ __('No') }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.page.fields.is_active') }}
                        </th>
                        <td>
                            @if($page->is_active)
                                {{ __('Yes') }}
                            @else
                                {{ __('No') }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.page.fields.language') }}
                        </th>
                        <td>
                            @php
                                $language = App\Models\Language::where('id', $page->language_id)->first();
                            @endphp
                                {{ $language->english }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.page.fields.title') }}
                        </th>
                        <td>
                            {{ $page->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.page.fields.content') }}
                        </th>
                        <td>
                            {!! $page->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.page.fields.views') }}
                        </th>
                        <td>
                            {{ $page->views }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('back.page.fields.slug') }}
                        </th>
                        <td>
                            {{ $page->parent->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card">
                <div class="card-header">
                    {{ trans('back.page.fields.translations') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#page_pages" role="tab" data-toggle="tab">
                            {{ trans('back.page.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="page_pages">
                        @includeIf('admin.pages.relationships.translations', ['pages' => $page->translations])
                    </div>
                </div>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

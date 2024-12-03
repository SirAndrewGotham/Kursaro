@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('back.page.title_singular') }} <span class="h4 ml-3">{{ $page->title }}</span>
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
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('back.page.fields.id') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            {{ $page->id }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    @if($page->page_id)
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
                    @endif
                    <tr>
                        <th>
                            {{ trans('back.page.fields.slug') }}
                        </th>
                        <td>
                            {{ $page->parent->slug ?? $page->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>

            @if(\App\Models\Page::where('page_id', $page->id)->first())
            <div class="card">
                <div class="card-header mb-2">
                    <h3>{{ trans('back.page.fields.translations') }}
                        <i class="fa-fw fas fa-arrow-alt-circle-down"></i>
                    </h3>
                </div>
                    <div class="tab-pane" role="tabpanel" id="page_pages">
                        @includeIf('backend.default.pages.relationships.translations', ['pages' => $page->translations])
                    </div>
            </div>
            @endif
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

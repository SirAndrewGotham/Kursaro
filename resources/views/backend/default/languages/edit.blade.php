@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('back.language.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.languages.update", [$language->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('default') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="default" id="default" value="1" {{ $language->default || old('default', 0) === 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="default">{{ trans('back.language.fields.default') }}</label>
                </div>
                @if($errors->has('default'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.default_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('fallback') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="fallback" value="0">
                    <input class="form-check-input" type="checkbox" name="fallback" id="fallback" value="1" {{ $language->fallback || old('fallback', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fallback">{{ trans('back.language.fields.fallback') }}</label>
                </div>
                @if($errors->has('fallback'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fallback') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.fallback_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('back.language.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $language->code) }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="regional">{{ trans('back.language.fields.regional') }}</label>
                <input class="form-control {{ $errors->has('regional') ? 'is-invalid' : '' }}" type="text" name="regional" id="regional" value="{{ old('regional', $language->regional) }}">
                @if($errors->has('regional'))
                    <div class="invalid-feedback">
                        {{ $errors->first('regional') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.regional_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="script">{{ trans('back.language.fields.script') }}</label>
                <input class="form-control {{ $errors->has('script') ? 'is-invalid' : '' }}" type="text" name="script" id="script" value="{{ old('script', $language->script) }}">
                @if($errors->has('script'))
                    <div class="invalid-feedback">
                        {{ $errors->first('script') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.script_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dir">{{ trans('back.language.fields.dir') }}</label>
                <input class="form-control {{ $errors->has('dir') ? 'is-invalid' : '' }}" type="text" name="dir" id="dir" value="{{ old('dir', $language->dir) }}">
                @if($errors->has('dir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.dir_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="flag">{{ trans('back.language.fields.flag') }}</label>
                <input class="form-control {{ $errors->has('flag') ? 'is-invalid' : '' }}" type="text" name="flag" id="flag" value="{{ old('flag', $language->flag) }}">
                @if($errors->has('flag'))
                    <div class="invalid-feedback">
                        {{ $errors->first('flag') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.flag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('back.language.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $language->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="english">{{ trans('back.language.fields.english') }}</label>
                <input class="form-control {{ $errors->has('english') ? 'is-invalid' : '' }}" type="text" name="english" id="english" value="{{ old('english', $language->english) }}">
                @if($errors->has('english'))
                    <div class="invalid-feedback">
                        {{ $errors->first('english') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.english_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_available') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_available" value="0">
                    <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ $language->is_available || old('is_available', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_available">{{ trans('back.language.fields.available') }}</label>
                </div>
                @if($errors->has('is_available'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_available') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.available_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $language->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('back.language.fields.active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.language.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

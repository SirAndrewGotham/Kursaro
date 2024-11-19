@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('back.courseFeature.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-features.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="feature_id">{{ trans('back.courseFeature.fields.feature') }}</label>
                <select class="form-control select2 {{ $errors->has('feature') ? 'is-invalid' : '' }}" name="feature_id" id="feature_id">
                    @foreach($features as $id => $entry)
                        <option value="{{ $id }}" {{ old('feature_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('feature'))
                    <div class="invalid-feedback">
                        {{ $errors->first('feature') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.courseFeature.fields.feature_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('back.courseFeature.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.courseFeature.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('back.courseFeature.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.courseFeature.fields.description_helper') }}</span>
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

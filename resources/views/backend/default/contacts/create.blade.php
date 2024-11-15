@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contact.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contacts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="contact_type_id">{{ trans('cruds.contact.fields.contact_type') }}</label>
                <select class="form-control select2 {{ $errors->has('contact_type') ? 'is-invalid' : '' }}" name="contact_type_id" id="contact_type_id" required>
                    @foreach($contact_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('contact_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.contact_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact">{{ trans('cruds.contact.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', '') }}" required>
                @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.contact_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_public') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_public" id="is_public" value="1" required {{ old('is_public', 0) == 1 || old('is_public') === null ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_public">{{ trans('cruds.contact.fields.is_public') }}</label>
                </div>
                @if($errors->has('is_public'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_public') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.is_public_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_preferable') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_preferable" id="is_preferable" value="1" required {{ old('is_preferable', 0) == 1 || old('is_preferable') === null ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_preferable">{{ trans('cruds.contact.fields.is_preferable') }}</label>
                </div>
                @if($errors->has('is_preferable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_preferable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.is_preferable_helper') }}</span>
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

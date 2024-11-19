@extends('backend.default.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('back.contact.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contacts.update", [$contact->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="contact_type_id">{{ trans('back.contact.fields.contact_type') }}</label>
                <select class="form-control select2 {{ $errors->has('contact_type') ? 'is-invalid' : '' }}" name="contact_type_id" id="contact_type_id" required>
                    @foreach($contact_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('contact_type_id') ? old('contact_type_id') : $contact->contact_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.contact.fields.contact_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact">{{ trans('back.contact.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', $contact->contact) }}" required>
                @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.contact.fields.contact_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_public') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_public" id="is_public" value="1" {{ $contact->is_public || old('is_public', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="is_public">{{ trans('back.contact.fields.is_public') }}</label>
                </div>
                @if($errors->has('is_public'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_public') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.contact.fields.is_public_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_preferable') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_preferable" id="is_preferable" value="1" {{ $contact->is_preferable || old('is_preferable', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="is_preferable">{{ trans('back.contact.fields.is_preferable') }}</label>
                </div>
                @if($errors->has('is_preferable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_preferable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('back.contact.fields.is_preferable_helper') }}</span>
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

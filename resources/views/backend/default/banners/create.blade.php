@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.banner.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.banners.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="banner_type_id">{{ trans('cruds.banner.fields.banner_type') }}</label>
                <select class="form-control select2 {{ $errors->has('banner_type') ? 'is-invalid' : '' }}" name="banner_type_id" id="banner_type_id" required>
                    @foreach($banner_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('banner_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('banner_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banner_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.banner_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="banner_spot_id">{{ trans('cruds.banner.fields.banner_spot') }}</label>
                <select class="form-control select2 {{ $errors->has('banner_spot') ? 'is-invalid' : '' }}" name="banner_spot_id" id="banner_spot_id" required>
                    @foreach($banner_spots as $id => $entry)
                        <option value="{{ $id }}" {{ old('banner_spot_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('banner_spot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banner_spot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.banner_spot_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('all_languages') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="all_languages" value="0">
                    <input class="form-check-input" type="checkbox" name="all_languages" id="all_languages" value="1" {{ old('all_languages', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="all_languages">{{ trans('cruds.banner.fields.all_languages') }}</label>
                </div>
                @if($errors->has('all_languages'))
                    <div class="invalid-feedback">
                        {{ $errors->first('all_languages') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.all_languages_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="languages">{{ trans('cruds.banner.fields.language') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('languages') ? 'is-invalid' : '' }}" name="languages[]" id="languages" multiple>
                    @foreach($languages as $id => $language)
                        <option value="{{ $id }}" {{ in_array($id, old('languages', [])) ? 'selected' : '' }}>{{ $language }}</option>
                    @endforeach
                </select>
                @if($errors->has('languages'))
                    <div class="invalid-feedback">
                        {{ $errors->first('languages') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" required {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_active">{{ trans('cruds.banner.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.banner.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subtitle">{{ trans('cruds.banner.fields.subtitle') }}</label>
                <input class="form-control {{ $errors->has('subtitle') ? 'is-invalid' : '' }}" type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', '') }}">
                @if($errors->has('subtitle'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subtitle') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.subtitle_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="teaser">{{ trans('cruds.banner.fields.teaser') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('teaser') ? 'is-invalid' : '' }}" name="teaser" id="teaser">{!! old('teaser') !!}</textarea>
                @if($errors->has('teaser'))
                    <div class="invalid-feedback">
                        {{ $errors->first('teaser') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.teaser_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="path">{{ trans('cruds.banner.fields.path') }}</label>
                <input class="form-control {{ $errors->has('path') ? 'is-invalid' : '' }}" type="text" name="path" id="path" value="{{ old('path', '') }}">
                @if($errors->has('path'))
                    <div class="invalid-feedback">
                        {{ $errors->first('path') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.path_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.banner.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.banner.fields.image_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.banners.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $banner->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.banners.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($banner) && $banner->image)
      var file = {!! json_encode($banner->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection

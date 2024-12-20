{{--@can($viewGate)--}}
    <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
{{--@endcan--}}
@if($crudRoutePart != 'pages')
{{--@can($editGate)--}}
    <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
{{--@endcan--}}
@endif
@if($crudRoutePart != 'pages')
{{--@can($deleteGate)--}}
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
{{--@endcan--}}
@endif
@if($crudRoutePart == 'homes' || $crudRoutePart == 'pages')
{{--@can($translateGate)--}}
<a class="btn btn-xs btn-light" href="{{ route('admin.' . $crudRoutePart . '.translate', $row->id) }}">
    {{ trans('global.translate') }}
</a>
{{--@endcan--}}
@endif

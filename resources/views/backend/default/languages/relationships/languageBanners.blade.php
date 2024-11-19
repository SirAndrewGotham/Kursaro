@can('banner_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banners.create') }}">
                {{ trans('global.add') }} {{ trans('back.banner.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('back.banner.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-languageBanners">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('back.banner.fields.id') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.banner_type') }}
                        </th>
                        <th>
                            {{ trans('back.bannerType.fields.is_active') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.banner_spot') }}
                        </th>
                        <th>
                            {{ trans('back.bannerSpot.fields.size') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.all_languages') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.language') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.is_active') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.title') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.subtitle') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.path') }}
                        </th>
                        <th>
                            {{ trans('back.banner.fields.image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $key => $banner)
                        <tr data-entry-id="{{ $banner->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $banner->id ?? '' }}
                            </td>
                            <td>
                                {{ $banner->banner_type->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $banner->banner_type->is_active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $banner->banner_type->is_active ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $banner->banner_spot->name ?? '' }}
                            </td>
                            <td>
                                {{ $banner->banner_spot->size ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $banner->all_languages ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $banner->all_languages ? 'checked' : '' }}>
                            </td>
                            <td>
                                @foreach($banner->languages as $key => $item)
                                    <span class="badge badge-info">{{ $item->english }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span style="display:none">{{ $banner->is_active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $banner->is_active ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $banner->title ?? '' }}
                            </td>
                            <td>
                                {{ $banner->subtitle ?? '' }}
                            </td>
                            <td>
                                {{ $banner->path ?? '' }}
                            </td>
                            <td>
                                @if($banner->image)
                                    <a href="{{ $banner->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $banner->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('banner_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.banners.show', $banner->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('banner_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.banners.edit', $banner->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('banner_delete')
                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('banner_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.banners.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-languageBanners:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection

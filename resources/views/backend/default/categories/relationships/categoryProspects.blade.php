{{--@can('prospect_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.prospects.create') }}">
                {{ trans('global.add') }} {{ trans('back.prospect.title_singular') }}
            </a>
        </div>
    </div>
{{--@endcan--}}

<div class="card">
    <div class="card-header">
        {{ trans('back.prospect.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-categoryProspects">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('back.prospect.fields.id') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.course') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.user') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.language') }}
                        </th>
                        <th>
                            {{ trans('back.language.fields.name') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.name') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.image') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.link') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.is_active') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.all_languages') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.views') }}
                        </th>
                        <th>
                            {{ trans('back.prospect.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prospects as $key => $prospect)
                        <tr data-entry-id="{{ $prospect->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $prospect->id ?? '' }}
                            </td>
                            <td>
                                {{ $prospect->course->name ?? '' }}
                            </td>
                            <td>
                                {{ $prospect->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $prospect->language->english ?? '' }}
                            </td>
                            <td>
                                {{ $prospect->language->name ?? '' }}
                            </td>
                            <td>
                                {{ $prospect->name ?? '' }}
                            </td>
                            <td>
                                @if($prospect->image)
                                    <a href="{{ $prospect->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $prospect->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $prospect->link ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $prospect->is_active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $prospect->is_active ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $prospect->all_languages ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $prospect->all_languages ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $prospect->views ?? '' }}
                            </td>
                            <td>
                                @foreach($prospect->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
{{--                                @can('prospect_show')--}}
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.prospects.show', $prospect->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
{{--                                @endcan--}}

{{--                                @can('prospect_edit')--}}
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.prospects.edit', $prospect->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
{{--                                @endcan--}}

{{--                                @can('prospect_delete')--}}
                                    <form action="{{ route('admin.prospects.destroy', $prospect->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
{{--                                @endcan--}}

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
@can('prospect_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.prospects.massDestroy') }}",
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
  let table = $('.datatable-categoryProspects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection

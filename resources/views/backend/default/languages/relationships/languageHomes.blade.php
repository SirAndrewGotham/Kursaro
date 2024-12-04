@can('home_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.homes.create') }}">
                {{ trans('global.add') }} {{ trans('back.home.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('back.home.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-languageHomes">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('back.home.fields.id') }}
                        </th>
                        <th>
                            {{ trans('global.language') }}
                        </th>
                        <th>
                            {{ trans('back.language.fields.name') }}
                        </th>
                        <th>
                            {{ trans('back.home.fields.title') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($homes as $key => $home)
                        <tr data-entry-id="{{ $home->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $home->id ?? '' }}
                            </td>
                            <td>
                                {{ $home->language->english ?? '' }}
                            </td>
                            <td>
                                {{ $home->language->name ?? '' }}
                            </td>
                            <td>
                                {{ $home->title ?? '' }}
                            </td>
                            <td>
{{--                                @can('home_show')--}}
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.homes.show', $home->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
{{--                                @endcan--}}

{{--                                @can('home_edit')--}}
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.homes.edit', $home->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
{{--                                @endcan--}}

{{--                                @can('home_delete')--}}
                                    <form action="{{ route('admin.homes.destroy', $home->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
{{--@can('home_delete')--}}
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.homes.massDestroy') }}",
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
{{--@endcan--}}

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-languageHomes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection

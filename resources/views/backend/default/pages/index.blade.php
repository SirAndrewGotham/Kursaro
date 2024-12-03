@extends('backend.default.layouts.app')
@section('content')
{{--@can('page_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pages.create') }}">
                {{ trans('global.add') }} {{ trans('back.page.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('backend.default.csvImport.modal', ['model' => 'Page', 'route' => 'admin.pages.parseCsvImport'])
        </div>
    </div>
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        {{ trans('back.page.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Page">
            <thead>
                <tr>
                    <th width="10">

                    </th>
{{--                    <th>--}}
{{--                        {{ trans('back.page.fields.id') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('back.page.fields.title') }}
                    </th>
                    <th>
                        {{ trans('back.page.fields.views') }}
                    </th>
                    <th>
                        {{ trans('back.page.fields.page') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
{{--                    <td>--}}
{{--                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">--}}
{{--                    </td>--}}
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
{{--                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">--}}
                    </td>
                    <td>
{{--                        <select class="search">--}}
{{--                            <option value>{{ trans('global.all') }}</option>--}}
{{--                            @foreach($pages as $key => $item)--}}
{{--                                <option value="{{ $item->title }}">{{ $item->title }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
{{--@can('page_delete')--}}
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pages.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.pages.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        // { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'views', name: 'views' },
        { data: 'page_title', name: 'page.title' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Page').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection

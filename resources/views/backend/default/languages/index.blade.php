@extends('backend.default.layouts.app')
@section('content')
{{--@can('language_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.languages.create') }}">
                {{ trans('global.add') }} {{ trans('back.language.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('backend.default.csvImport.modal', ['model' => 'Language', 'route' => 'admin.languages.parseCsvImport'])
        </div>
    </div>
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        {{ trans('back.language.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Language">
            <thead>
                <tr>
                    <th width="10">

                    </th>
{{--                    <th>--}}
{{--                        {{ trans('back.language.fields.id') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('back.language.fields.default') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('back.language.fields.fallback') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('back.language.fields.code') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('back.language.fields.regional') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('back.language.fields.script') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('back.language.fields.dir') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('back.language.fields.flag') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('back.language.fields.name') }}
                    </th>
                    <th>
                        {{ trans('back.language.fields.english') }}
                    </th>
                    <th>
                        {{ trans('back.language.fields.available') }}
                    </th>
                    <th>
                        {{ trans('back.language.fields.active') }}
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
                    </td>
{{--                    <td>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">--}}
{{--                    </td>--}}
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
{{--                    <td>--}}
{{--                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">--}}
{{--                    </td>--}}
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
{{--                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">--}}
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
{{--                    <td>--}}
{{--                    </td>--}}
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
{{--@can('language_delete')--}}
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.languages.massDestroy') }}",
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
    ajax: "{{ route('admin.languages.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        // { data: 'id', name: 'id' },
        { data: 'default', name: 'default' },
        // { data: 'fallback', name: 'fallback' },
        { data: 'code', name: 'code' },
        // { data: 'regional', name: 'regional' },
        // { data: 'script', name: 'script' },
        // { data: 'dir', name: 'dir' },
        // { data: 'flag', name: 'flag' },
        { data: 'name', name: 'name' },
        { data: 'english', name: 'english' },
        { data: 'available', name: 'available' },
        { data: 'active', name: 'active' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 7, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Language').DataTable(dtOverrideGlobals);
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

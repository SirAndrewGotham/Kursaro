@extends('backend.default.layouts.app')
@section('content')
{{--@can('prospect_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.prospects.create') }}">
                {{ trans('global.add') }} {{ trans('back.prospect.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Prospect', 'route' => 'admin.prospects.parseCsvImport'])
        </div>
    </div>
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        {{ trans('back.prospect.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Prospect">
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
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($courses as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($languages as $key => $item)
                                <option value="{{ $item->english }}">{{ $item->english }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($categories as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
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
{{--@can('prospect_delete')--}}
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.prospects.massDestroy') }}",
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
    ajax: "{{ route('admin.prospects.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'course_name', name: 'course.name' },
{ data: 'user_name', name: 'user.name' },
{ data: 'language_english', name: 'language.english' },
{ data: 'language.name', name: 'language.name' },
{ data: 'name', name: 'name' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'link', name: 'link' },
{ data: 'is_active', name: 'is_active' },
{ data: 'all_languages', name: 'all_languages' },
{ data: 'views', name: 'views' },
{ data: 'category', name: 'categories.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Prospect').DataTable(dtOverrideGlobals);
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

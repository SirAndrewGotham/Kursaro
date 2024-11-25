@extends('backend.default.layouts.app')
@section('content')
{{--@can('banner_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banners.create') }}">
                {{ trans('global.add') }} {{ trans('back.banner.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Banner', 'route' => 'admin.banners.parseCsvImport'])
        </div>
    </div>
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        {{ trans('back.banner.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Banner">
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
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($banner_types as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($banner_spots as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
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
{{--@can('banner_delete')--}}
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.banners.massDestroy') }}",
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
    ajax: "{{ route('admin.banners.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'banner_type_name', name: 'banner_type.name' },
{ data: 'banner_type.is_active', name: 'banner_type.is_active' },
{ data: 'banner_spot_name', name: 'banner_spot.name' },
{ data: 'banner_spot.size', name: 'banner_spot.size' },
{ data: 'all_languages', name: 'all_languages' },
{ data: 'language', name: 'languages.english' },
{ data: 'is_active', name: 'is_active' },
{ data: 'title', name: 'title' },
{ data: 'subtitle', name: 'subtitle' },
{ data: 'path', name: 'path' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Banner').DataTable(dtOverrideGlobals);
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

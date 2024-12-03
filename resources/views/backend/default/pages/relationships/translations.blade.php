{{--@can('page_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pages.translate', $page->id) }}">
                {{ trans('global.add') }} {{ trans('back.page.fields.translation') }}
            </a>
        </div>
    </div>
{{--@endcan--}}

<div class="card">
    <div class="card-header">
        {{ trans('back.page.fields.translations') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-pagePages">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
{{--                        <th>--}}
{{--                            {{ trans('back.page.fields.id') }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('back.page.fields.title') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('back.page.fields.views') }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('back.page.fields.language') }}
                        </th>
                        <th>
                            {{-- Default statis --}}
                        </th>
                        <th>
                            {{-- Enabled statis --}}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($page->translations as $key => $page)
                        <tr data-entry-id="{{ $page->id }}">
                            <td>

                            </td>
{{--                            <td>--}}
{{--                                {{ $page->id ?? '' }}--}}
{{--                            </td>--}}
                            <td>
                                {{ $page->title ?? '' }}
                            </td>
{{--                            <td>--}}
{{--                                {{ $page->views ?? '' }}--}}
{{--                            </td>--}}
                            <td>
                                @if(file_exists(public_path('assets/flags/'.$page->language->code.'.svg')))
                                    <span class="mr-2">
                                        <svg height="24px" width="24px" style="border-radius: 50%;background: #73AD21;">
                                            {!! file_get_contents(public_path('assets/flags/'.$page->language->code.'.svg')) !!}
                                        </svg>
                                    </span>
                                @endif
                                {{ $page->language->name ?? '' }} ({{ $page->language->code }})
                            </td>
                            <td>
                                @if($page->is_default)
                                    {{ trans('back.page.fields.is_default') }}
                                @endif
                            </td>
                            <td>
                                @if(!$page->is_active)
                                    {{ trans('Disabled') }}
                                @endif
                            </td>
                            <td>
{{--                                @can('page_show')--}}
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pages.show', $page->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
{{--                                @endcan--}}

{{--                                @can('page_edit')--}}
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pages.edit', $page->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
{{--                                @endcan--}}

{{--                                @can('page_delete')--}}
                                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
{{--                                @endcan--}}

                                {{-- @can('page_edit')--}}
                                <a class="btn btn-xs btn-light" href="{{ route('admin.pages.translate', $page->id) }}">
                                    {{ trans('global.translate') }}
                                </a>
                                {{-- @endcan--}}
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
{{--@can('page_delete')--}}
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pages.massDestroy') }}",
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
  let table = $('.datatable-pagePages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection

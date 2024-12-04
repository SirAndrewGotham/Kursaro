@can('course_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.courses.create') }}">
                {{ trans('global.add') }} {{ trans('back.course.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('back.course.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userCourses">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('back.course.fields.id') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.course') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.user') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.language') }}
                        </th>
                        <th>
                            {{ trans('back.language.fields.name') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.name') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.image') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.link') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.is_active') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.all_languages') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.views') }}
                        </th>
                        <th>
                            {{ trans('back.course.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $key => $course)
                        <tr data-entry-id="{{ $course->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $course->id ?? '' }}
                            </td>
                            <td>
                                {{ $course->course->name ?? '' }}
                            </td>
                            <td>
                                {{ $course->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $course->language->english ?? '' }}
                            </td>
                            <td>
                                {{ $course->language->name ?? '' }}
                            </td>
                            <td>
                                {{ $course->name ?? '' }}
                            </td>
                            <td>
                                @if($course->image)
                                    <a href="{{ $course->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $course->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $course->link ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $course->is_active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $course->is_active ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $course->all_languages ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $course->all_languages ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $course->views ?? '' }}
                            </td>
                            <td>
                                @foreach($course->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
{{--                                @can('course_show')--}}
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.courses.show', $course->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
{{--                                @endcan--}}

{{--                                @can('course_edit')--}}
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.courses.edit', $course->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
{{--                                @endcan--}}

{{--                                @can('course_delete')--}}
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
{{--@can('course_delete')--}}
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.courses.massDestroy') }}",
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
  let table = $('.datatable-userCourses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection

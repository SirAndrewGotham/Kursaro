<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>

{{--    @include('backend.default.layouts.styles-cdn')--}}
    @include('backend.default.layouts.styles-local')

    <link href="{{ asset('assets/backend/default/css/custom.css') }}" rel="stylesheet" />
    @stack('styles')
    @yield('styles')
</head>

<body class="c-app">
@include('backend.default.layouts.menu')
<div class="c-wrapper">
    <header class="c-header c-header-fixed px-3">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <i class="fas fa-fw fa-bars"></i>
        </button>
        <a class="c-header-brand d-lg-none" href="#">{{ trans('panel.site_title') }}</a>
        <button class="c-header-toggler mfs-3 d-md-down-none" type="button" responsive="true">
            <i class="fas fa-fw fa-bars"></i>
        </button>
        <div class="c-header-nav ml-auto">
            <a class="c-header-nav-link" href="{{ route('home') }}">
                {{ trans('Site') }}
            </a>
        </div>
        <ul class="c-header-nav ml-auto">
{{--            @include('backend.default.layouts.languageSwitcher')--}}
            @if(count(App\Models\Language::where('is_active', true)->get()) > 1)
                <li class="c-header-nav-item dropdown d-md-down-none">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(App\Models\Language::where('is_active', true)->get() as $locale)
                            <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $locale->code }}">
                                @if(file_exists(public_path('assets/flags/'.$locale->code.'.svg')))
                                    <span class="mr-2">
                                        <svg height="24px" width="24px" style="border-radius: 50%;background: #73AD21;">
                                            {!! file_get_contents(public_path('assets/flags/'.$locale->code.'.svg')) !!}
                                        </svg>
                                    </span>
                                @endif
                                {{ strtoupper($locale->code) }} ({{ $locale->english }})
                            </a>
                        @endforeach
                    </div>
                </li>
            @endif
        </ul>
    </header>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                @endif
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')

            </div>


        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>

{{--@include('backend.default.layouts.scripts-cdn')--}}
@include('backend.default.layouts.scripts-local')

<script src="{{ asset('assets/backend/default/js/main.js') }}"></script>
<script>
    $(function() {
        let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
        let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
        let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
        let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
        let printButtonTrans = '{{ trans('global.datatables.print') }}'
        let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
        let selectAllButtonTrans = '{{ trans('global.select_all') }}'
        let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

{{--        @include('backend.default.layouts.datatables-lang-cdn')--}}
        @include('backend.default.layouts.datatables-lang-local')

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
                style:    'multi+shift',
                selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
                {
                    extend: 'selectAll',
                    className: 'btn-primary',
                    text: selectAllButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    },
                    action: function(e, dt) {
                        e.preventDefault()
                        dt.rows().deselect();
                        dt.rows({ search: 'applied' }).select();
                    }
                },
                {
                    extend: 'selectNone',
                    className: 'btn-primary',
                    text: selectNoneButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'copy',
                    className: 'btn-default',
                    text: copyButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-default',
                    text: csvButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-default',
                    text: excelButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-default',
                    text: pdfButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-default',
                    text: printButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    className: 'btn-default',
                    text: colvisButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
    });

</script>
<script>
    $(document).ready(function() {
        $('.searchable-field').select2({
            minimumInputLength: 3,
            ajax: {
                url: '{{ route("admin.globalSearch") }}',
                dataType: 'json',
                type: 'GET',
                delay: 200,
                data: function (term) {
                    return {
                        search: term
                    };
                },
                results: function (data) {
                    return {
                        data
                    };
                }
            },
            escapeMarkup: function (markup) { return markup; },
            templateResult: formatItem,
            templateSelection: formatItemSelection,
            placeholder : '{{ trans('global.search') }}...',
            language: {
                inputTooShort: function(args) {
                    var remainingChars = args.minimum - args.input.length;
                    var translation = '{{ trans('global.search_input_too_short') }}';

                    return translation.replace(':count', remainingChars);
                },
                errorLoading: function() {
                    return '{{ trans('global.results_could_not_be_loaded') }}';
                },
                searching: function() {
                    return '{{ trans('global.searching') }}';
                },
                noResults: function() {
                    return '{{ trans('global.no_results') }}';
                },
            }

        });
        function formatItem (item) {
            if (item.loading) {
                return '{{ trans('global.searching') }}...';
            }
            var markup = "<div class='searchable-link' href='" + item.url + "'>";
            markup += "<div class='searchable-title'>" + item.model + "</div>";
            $.each(item.fields, function(key, field) {
                markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
            });
            markup += "</div>";

            return markup;
        }

        function formatItemSelection (item) {
            if (!item.model) {
                return '{{ trans('global.search') }}...';
            }
            return item.model;
        }
        $(document).delegate('.searchable-link', 'click', function() {
            var url = $(this).attr('href');
            window.location = url;
        });
    });

</script>
@yield('scripts')
</body>

</html>

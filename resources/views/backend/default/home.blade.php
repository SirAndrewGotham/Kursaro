@extends('backend.default.layouts.app')

@push('styles')
    <link href="{{ asset('assets/backend/default/css/adminlte.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="m-0">{{ trans('Dashboard') }}</h3>
                    </div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            @php
                                                $homes = App\Models\Home::where('is_active', true)->get()->count();
                                            @endphp
                                            <h3>{{ $homes }}</h3>

                                            <p>{{ trans_choice('{0} Home page translations|{1} Home page translation|[2,4] Home page translations|[5,19] Home page translations', $homes) }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="{{ route('admin.homes.index') }}" class="small-box-footer">{{ trans('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            @php
                                                $languages = App\Models\Language::where('is_active', true)->get()->count();
                                            @endphp
                                            <h3>{{ $languages }}</h3>

                                            <p>{{ trans_choice('{0} Languages enabled|{1} Language enabled|[2,4] Languages enabled|[5,19] Languages enabled', $languages) }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="{{ route('admin.languages.index') }}" class="small-box-footer">{{ trans('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            @php
                                                $pages = App\Models\Page::where('page_id', null)->get()->count();
                                            @endphp
                                            <h3>{{ $pages }}</h3>

                                            <p>{{ trans_choice('{0} System pages|{1} System page|[2,4] System pages|[5,19] System pages', $pages) }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="{{ route('admin.pages.index') }}" class="small-box-footer">{{ trans('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            @php
                                                $users = App\Models\User::all()->count();
                                            @endphp
                                            <h3>{{ $users }}</h3>

                                            <p>{{ trans_choice('{0} Users|{1} User|[2,4] Users|[5,19] Users', $users) }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">{{ trans('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                        </div>

                        <h2 class="my-4">Bonevenon al la administra sekcio.</h2>
                        <p>Nun funkciaj estas sekcioj indikitaj supre:</p>
                            <ul>
                                <li>Hejmpaĝaj tradukoj</li>
                                <li>Sistemaj paĝoj kun tradukoj (tiuj atingeblaj per ligiloj en la piedpanelo de la retejo)</li>
                                <li>Lingvoj (ebligi/malebligi en la retejo)</li>
                                <li>Uzantoj (redaktado de la administranta uzanto malebligita en la demonstracia versio)</li>
                            </ul>
                        <p>Laboro estas daŭrigata.</p>
                        <p>Ĉiuj interesiĝantaj estas bonvenaj pridiskuti en la <a href="https://t.me/RetejoEsperanta" target="_blank">Retejo Esperanta</a> Telegrama grupo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

@endsection

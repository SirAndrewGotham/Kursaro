@extends('backend.default.layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>Bonevenon al la administra sekcio.</h2>
                        <p>Nun eblas labori kun la Hejma paĝo (tradukoj)</p>
                        <p>kaj</p>
                        <p>Lingvoj (plibonigota)</p>
                        <br />
                        <p>Laboroj estas daŭrigataj.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

@endsection

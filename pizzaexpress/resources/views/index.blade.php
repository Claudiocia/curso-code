@extends('app')

@section('menu')
    <li><a href="{{ url('/') }}">Home</a></li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        Faça seu cadastro - ou seu Login!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
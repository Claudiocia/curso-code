@extends('app')
@section('menu')
    @if(auth()->user()->role == "admin")
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ url('/admin/categorias') }}">Categorias</a></li>
        <li><a href="{{ url('/admin/produtos') }}">Produtos</a></li>
        <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
        <li><a href="{{ url('/admin/ordens') }}">Pedidos</a></li>
        <li><a href="{{ url('/admin/cupoms') }}">Cupons</a></li>

    @endif
@endsection

@section('content')

    <div class="container">
        <h3>Editando Cupom {{ $cupom->code  }}</h3>

        @include('errors._check')

        {!! Form::model($cupom, ['route' => ['altera.cupom', $cupom->id]]) !!}

        @include('admin.cupoms._form')

        <div class="form-group">
            {!! Form::label('used', 'Status:') !!}
            {!! Form::select('used', $list_used, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Salvar Cupom', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection
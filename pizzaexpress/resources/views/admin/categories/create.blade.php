@extends('app')
@section('menu')
    @if(auth()->user()->role == "admin")
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ url('/admin/categorias') }}">Categorias</a></li>
        <li><a href="{{ url('/admin/produtos') }}">Produtos</a></li>
        <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
        <li><a href="{{ url('/admin/ordens') }}">Pedidos</a></li>
        <li><a href="{{ url('/admin/cupoms') }}">Cupons Novo</a></li>
    @endif
@endsection
@section('content')

    <div class="container">
        <h3>Nova Categoria</h3>

        @include('errors._check')

        {!! Form::open(['route' => 'salva.categoria']) !!}

        @include('admin.categories._form')

        <div class="form-group">
            {!! Form::submit('Salvar Categoria', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection
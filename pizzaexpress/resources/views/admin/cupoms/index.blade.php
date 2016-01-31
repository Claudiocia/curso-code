@extends('app')
@section('menu')
    @if(auth()->user()->role == "admin")
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ url('/admin/categorias') }}">Categorias</a></li>
        <li><a href="{{ url('/admin/produtos') }}">Produtos</a></li>
        <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
        <li><a href="{{ url('/admin/ordens') }}">Pedidos</a></li>
        <li><a href="{{ route('nova.cupom') }}">Cupons Novo</a></li>
    @endif
@endsection

@section('content')

    <div class="container">
        <h3>Cupons</h3>

        <a href="{{ route('nova.cupom') }}" class="btn btn-primary btn-sm">Novo Cupom</a>
        <br><br>
        <table class="table" border="bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cupoms as $cupom)
            <tr>
                <td>{{ $cupom->id }}</td>
                <td>{{ $cupom->code }}</td>
                <td>{{ $cupom->value }}</td>
                <td>{{ $cupom->used }}</td>
                <td><a href="{{route('edita.cupom', ['id'=>$cupom->id])}}" class="btn btn-primary btn-sm">Editar</a>
            </tr>
            @endforeach
            </tbody>
        </table>
        {!! $cupoms->render() !!}
    </div>

@endsection
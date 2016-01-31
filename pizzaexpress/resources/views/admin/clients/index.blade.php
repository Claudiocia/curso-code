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
        <h3>Clientes</h3>

        <a href="{{ route('nova.cliente') }}" class="btn btn-primary btn-sm">Novo Cliente</a>
        <br><br>
        <table class="table" border="bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->user->name }}</td>
                <td><a href="{{route('edita.cliente', ['id'=>$client->id])}}" class="btn btn-primary btn-sm">Editar</a>
            </tr>
            @endforeach
            </tbody>
        </table>
        {!! $clients->render() !!}
    </div>

@endsection
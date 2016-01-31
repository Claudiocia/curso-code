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
        <h3>Categorias</h3>

        <a href="{{ route('nova.categoria') }}" class="btn btn-primary btn-sm">Nova Categoria</a>
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
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td><a href="{{route('edita.categoria', ['id'=>$category->id])}}" class="btn btn-primary btn-sm">Editar</a>
            </tr>
            @endforeach
            </tbody>
        </table>
        {!! $categories->render() !!}
    </div>

@endsection
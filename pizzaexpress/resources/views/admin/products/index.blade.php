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
        <h3>Produtos</h3>

        <a href="{{ route('nova.produto') }}" class="btn btn-primary btn-sm">Novo Produto</a>
        <br><br>
        <table class="table" border="bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td align="right">{{ $product->price }}</td>
                <td>
                    <a href="{{route('edita.produto', ['id'=>$product->id])}}" class="btn btn-primary btn-sm">Editar</a>
                    <a href="{{route('deleta.produto', ['id'=>$product->id])}}" class="btn btn-danger btn-sm">Deletar</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {!! $products->render() !!}
    </div>

@endsection
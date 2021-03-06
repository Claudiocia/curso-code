@extends('app')
@section('menu')
    @if(auth()->user()->role == "admin")
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ url('/admin/categorias') }}">Categorias</a></li>
        <li><a href="{{ url('/admin/produtos') }}">Produtos</a></li>
        <li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
        <li><a href="{{ url('/admin/ordens') }}">Pedidos</a></li>
        <li><a href="{{ url('/admin/cupoms') }}">Cupons</a></li>

    @else
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ route('index.ordem') }}">Listar Pedidos</a></li>
        <li><a href="{{ route('nova.ordem') }}">Novo Pedido</a></li>

    @endif
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					Você está logado!
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
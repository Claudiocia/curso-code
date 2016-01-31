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
        <h3>Pedidos</h3>

        <br><br>
        <table class="table" border="bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Data</th>
                <th>Itens</th>
                <th>Entregador</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>R$ {{ $order->total }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <ul>
                        @foreach($order->items as $item)
                            <li>{{$item->product->name}} - qtd {{$item->qtd}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                   @if($order->deliveryman)
                    {{ $order->deliveryman->name }}
                       @else
                       --
                    @endif
                </td>
                <td>
                    @if($order->status == 0)
                    Pendente
                        @elseif($order->status == 1)
                        Despachado
                        @elseif($order->status == 2)
                        Entregue
                        @else
                        Cancelado
                    @endif

                </td>

                <td><a href="{{route('edita.ordem', ['id'=>$order->id])}}" class="btn btn-primary btn-sm">Editar</a>
            </tr>
            @endforeach
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>

@endsection
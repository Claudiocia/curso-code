@extends('app')

@section('menu')
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li><a href="{{ route('nova.ordem') }}">Novo Pedido</a></li>
@endsection

@section('content')

    <div class="container">
        <h3>Meus Pedidos</h3>

        <a href="{{ route('nova.ordem') }}" class="btn btn-primary">Novo Pedido</a>

        <br><br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->status }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {!! $orders->render() !!}
@endsection


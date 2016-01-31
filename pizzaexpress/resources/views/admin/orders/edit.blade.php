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

        <h3>Pedido # {{ $order->id }} - R$ {{$order->total}}</h3>
        <h4>Cliente: {{ $order->client->user->name }}</h4>
        <h5>Data: {{ $order->created_at }}</h5>
        <p>
            <b>Entregar em:</b> <br>
            {{$order->client->address}}
            <br>
            {{ $order->client->city }} - {{ $order->client->state }}
            <br>
            CEP:{{$order->client->zipcode}}
        </p>
        <br>
        {!! Form::model($order, ['route' => ['altera.ordem', $order->id]]) !!}

        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status', $list_status, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('entregador', 'Entregador:') !!}
            {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>






@endsection
@extends('app')
@section('menu')
    <li><a href="{{ url('/') }}">Home</a></li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/novo/registro') }}">
						{!! csrf_field() !!}

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="senha">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="senha_confirmation">
							</div>
						</div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Telefone:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="client[phone]">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Endereço:</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="5" name="client[address]"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Cidade:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="client[city]">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Estado:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="client[state]">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">CEP:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="client[zipcode]">
                            </div>
                        </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

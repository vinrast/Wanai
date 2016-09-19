@extends('base')

<body class="pace-top login-body">
	
	<!--<div class="login-cover">
	    <div class="login-cover-image"><img src="{{ asset('/thema/assets/img/login-bg/bg-1.jpg') }}" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>-->
	
	<ul class="cb-slideshow ul-login">
        <li class="li-login"><span></span></li>
        <li class="li-login"><span></span></li>
        <li class="li-login"><span></span></li>
        <li class="li-login"><span></span></li>
        <li class="li-login"><span></span></li>
        <li class="li-login"><span></span></li>
    </ul>

	<div ng-controller="LoginController">
		@section('content')
			<!-- begin #page-container -->
			<div id="page-container" class="fade">
			    <!-- begin login -->
		        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
		            <!-- begin brand -->
		            <div class="login-header">
		                <div class="brand">
		                    <img width="50" src="{{ url('img/wanai.png') }}"></span> Wanai Travel
		                    <small style="margin-left: 60px;">Resetear Contraseña</small>
		                </div>
		                <div class="icon">
		                    <i class="fa fa-key"></i>
		                </div>
		            </div>
		            <!-- end brand -->
		            <div class="login-content">
		            	@if (session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif

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

						<form class="margin-bottom-0" role="form" method="POST" action="{{ url('/password/email') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group m-b-20">
								<label class="col-md-4 control-label">Correo@</label>
								<input type="email" class="form-control input-lg" name="email" value="{{ old('email') }}">
							</div>

							<div class="login-buttons">
								<button type="submit" class="btn btn-success btn-block btn-lg">
									Send Password Reset
								</button>
							</div>
						</form>
		            </div>
		        </div>

		@endsection

	</div>

</body>

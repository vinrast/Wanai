@extends('base')


@section('controller')
	<script src="{{ asset('/js/controllers/auth/login.js') }}"></script>
@endsection

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
			<div id="page-container" class="fade">
		        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
		            <div class="login-header">
		                <div class="brand">
		                    <img width="50" src="{{ url('img/wanai.png') }}"></span> Wanai Travel
		                    <small style="margin-left: 60px;">Tu Agencia de Viajes</small>
		                </div>
		                <div class="icon">
		                    <i class="fa fa-sign-in"></i>
		                </div>
		            </div>
		            <div class="login-content">
		                <form class="margin-bottom-0" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" novalidate>
		                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		                    <div class="form-group m-b-20">
		                        <input type="text" class="form-control input-lg" placeholder="Correo Electronico" name="email" ng-model="email" value="{{ old('email') }}" required/>
		                    </div>
		                    <div class="form-group m-b-20">
		                        <input type="password" class="form-control input-lg" placeholder="Contraseña" name="password" ng-model="clave" required/>
		                    </div>
		                    <div class="login-buttons">
		                        <button type="submit" class="btn btn-success btn-block btn-lg">Entrar</button>
		                    </div>
		                    <div class="m-t-20">
		                        <a class="btn btn-link" href="{{ url('/password/email') }}"><p>Olvidaste tu Contraseña?</p></a>
		                    </div>
		                </form>
		            </div>
		        </div>

		
		
	</div>
	@include('modals/validacion_modal')
	@endsection
</body>
@extends('base-cliente')

@section('controller')
    <script src="{{ asset('/js/controllers/cliente/cliente_boletos.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade" ng-controller="BoletosClienteCotizarController">

	@include('layouts/navbar-cliente')

	<!-- begin #contact -->
    <div class="content bg-silver-lighter">
        <!-- begin container -->
        <div class="container">
            <br><br> 
            <div ng-init="data={{$data}}"></div>
            <center><h1 class="page-header"><i class="fa fa-plane"></i> Boletos </h1></center>

            <div class="well">
				<blockquote class="f-s-14" style=" margin: 20px 20px 20px;">
	                <p>File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery.<br>
	                Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
	                Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.</p>
	            </blockquote>
            </div>
			
			<form class="form-horizontal" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" enctype="multipart/form-data" novalidate>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
		        <input type="hidden" name="i_boleto" value="{{ $id }}">
		   
				
				<center><h1 class="page-header"> Información de Cotización </h1></center>

			    <div class="well"><br>

		            <div class="form-group">
		                <label class="col-md-3 control-label">cantidad</label>
		                <div class="col-md-7">
							<input class="form-control error:formulario.i_cantidad.$invalid && (formulario.i_cantidad.$touched || submitted)"
									type="number"
									ng-max= "data.cantidad_boleto"
									ng-min= "0"
									name="i_cantidad"
									placeholder="100" 
									ng-model="cantidad"
									required>
							<div class="error campo-requerido" ng-show="formulario.i_cantidad.$invalid && (formulario.i_cantidad.$touched || submitted) ">
							    <small class="error" ng-show="formulario.i_cantidad.$error.required">
							        * Campo requerido.
							    </small>
							    <small class="error" ng-show="formulario.i_cantidad.$error.max">
							    	Excede la cantidad de boletos disponibles, intente con un número menor.
							    </small>
							    <small class="error" ng-show="formulario.i_cantidad.$error.min">
							    	El campo debe tener un numero positivo.
							    </small>
								<small class="error" ng-show="formulario.i_cantidad.$error.number">
							    	Introduzca solo números.
							    </small>	
							</div>
		                </div> 
		            </div>
	            </div>
				
				<center><h1 class="page-header"> Información de Envío </h1></center>

				<div class="well"><br>
				
					<div class="form-group">
				        <label class="col-md-3 control-label">Nombre</label>
				        <div class="col-md-7">
				            <input class="form-control"
				            			placeholder=""
				            			
				            			name="i_nombre"
				            			ng-model="hotel.nombre"
				            			required></input>
							<div class="error campo-requerido" ng-show="formulario.i_nombre.$invalid && (formulario.i_nombre.$touched || submitted)">
								<small class="error" ng-show="formulario.i_nombre.$error.required">
									* Campo requerido.
							    </small>
							</div>							                    
				        </div>						                
				    </div>

					<div class="form-group">
				        <label class="col-md-3 control-label">Correo electrónico</label>
				        <div class="col-md-7">
				            <input class="form-control"
				            			placeholder=""
				            			type = "email"
				            			name="i_correo"
				            			ng-model="hotel.correo"
				            			required></input>
							<div class="error campo-requerido" ng-show="formulario.i_correo.$invalid && (formulario.i_correo.$touched || submitted)">
								<small class="error" ng-show="formulario.i_correo.$error.required">
									* Campo requerido.
							    </small>
								<small class="error" ng-show="formulario.i_correo.$error.email">
									* Correo electronico invalido
							    </small>				    
							</div>							                    
				        </div>						                
				    </div>

					<div class="form-group">
					    <label class="col-md-3 control-label">Nacionalidad</label>
					    <div class="col-md-7">
					        <select class="form-control m-bot15"
					        		name="s_nacionalidad"
					        		ng-model="hotel.nacionalidad"
					        		required>
				        		<option class="option" value="">Seleccione</option>
								<option class="option" value="1" >Venezolano</option>
								<option class="option" value="2" >Extranjero</option>
							</select>
							<div class="error campo-requerido" ng-show="formulario.s_nacionalidad.$invalid && (formulario.s_nacionalidad.$touched || submitted)">
								<small class="error" ng-show="formulario.s_nacionalidad.$error.required">
									* Campo requerido.
							    </small>
							</div>	
					    </div>
					</div>
				</div>

				<br><br>
				<center>
					<button type="submit" class="btn btn-success m-r-5 m-b-5">
						Enviar cotización <i class="fa fa-chevron-right"></i>
					</button>
				</center>
			</form> 
			@include('modals/validacion_modal')	
			
		</div>
        <!-- end container -->
    </div>
    <!-- end #contact -->
	
	@include('layouts/footer-cliente')

</div>
@endsection
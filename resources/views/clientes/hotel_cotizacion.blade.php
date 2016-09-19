@extends('base-cliente')

@section('controller')
    <script src="{{ asset('/js/controllers/cliente/cliente_hoteles_cotizar.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade" ng-controller="HotelesClienteCotizarController">
    <div ng-init="hotel={{$data}}"></div>
	@include('layouts/navbar-cliente')

	<!-- begin #contact -->
    <div class="content bg-silver-lighter">
        <!-- begin container -->
        <div class="container">
            <br><br> 
				
			<center><h1 class="page-header"><i class="fa fa-bed"></i> Hotel </h1></center>

			<ul class="result-list">
                <li>
                    <div class="result-image">
                        <a href="javascript:;"><img src="{{url('/uploads/hoteles/img_mid')}}/[[hotel.url_imagen_hotel]]" alt=""></a>
                    </div>
                    <div class="result-info">
                        <h4 class="title">[[ hotel.nombre_hotel ]]</h4>
                        <p class="location"><i class="fa fa-phone"></i> [[hotel.telefono_hotel]]</p>
                        <p class="desc">
                            [[ hotel.direccion_hotel ]]
                        </p>
                        <div class="btn-row">
                            <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics" data-original-title="" title=""><i class="fa fa-fw fa-bed"></i></a>
                            <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Tasks" data-original-title="" title=""><i class="fa fa-fw fa-desktop"></i></a>
                            <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Configuration" data-original-title="" title=""><i class="fa fa-fw fa-coffee"></i></a>
                            <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Performance" data-original-title="" title=""><i class="fa fa-fw fa-wifi"></i></a>
                            <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Users" data-original-title="" title=""><i class="fa fa-fw fa-gamepad"></i></a>
                            <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Users" data-original-title="" title=""><i class="fa fa-fw fa-cutlery"></i></a>
                        </div>
                    </div>
                    <div class="result-price">
                        <div class="start-hotel-cliente">
                            <fieldset class="rating" >		    
							    <input type="radio" id="star5" name="i_categoria" value="5" ng-model="hotel.categoria_hotel" required/><label for="star5">5 stars</label>
							    <input type="radio" id="star4" name="i_categoria" value="4" ng-model="hotel.categoria_hotel" required/><label for="star4">4 stars</label>
							    <input type="radio" id="star3" name="i_categoria" value="3" ng-model="hotel.categoria_hotel" required/><label for="star3">3 stars</label>
							    <input type="radio" id="star2" name="i_categoria" value="2" ng-model="hotel.categoria_hotel" required/><label for="star2">2 stars</label>
							    <input type="radio" id="star1" name="i_categoria" value="1" ng-model="hotel.categoria_hotel" required/><label for="star1">1 star</label>											    
							</fieldset>
						</div>
						[[ hotel.nombre_hotel ]] 
                    </div>
                </li>
				<br><br>
			</ul>
			
			<div class="well">
				<blockquote class="f-s-14" style=" margin: 20px 20px 20px;">
	                <p>File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery.<br>
	                Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
	                Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.</p>
	            </blockquote>
            </div>

			<br>
			<form class="form-horizontal" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" enctype="multipart/form-data" novalidate>
				
		        <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="i_hotel" value="{{$id}}" >	

				<center><h1 class="page-header"> Información de Cotización </h1></center>

			    <div class="well"><br>
			    
		            <div class="form-group">
		                <label class="col-md-3 control-label">Habitación</label>
		                <div class="col-md-7">
							<select class="form-control m-bot15" name="i_habitacion" ng-model="id_habitacion" ng-change="change()" required>
		                    	<option class="option" value=''>Seleccione una habitación</option>
								@foreach($habitaciones as $key)
									<option class="option" value="{{ $key->id_habitacion }}">{{ $key->nombre_habitacion }}</option>
								@endforeach						
							</select>

							<div class="error campo-requerido" ng-show="formulario.i_habitacion.$invalid && (formulario.i_habitacion.$touched || submitted)">
								<small class="error" ng-show="formulario.i_habitacion.$error.required">
									* Campo requerido.
							    </small>
							</div>													
						</div>
		            </div>	


		            <div ng-init="regimen = {{$regimenes}} "></div>
		            <div class="form-group" ng-if='id_habitacion'>
		                <label class="col-md-3 control-label">Regimen</label>
		                <div class="col-md-7">
							<select class="form-control m-bot15" name="i_regimen" ng-model="id_regimen" required 
								ng-options="item.nombre for item in regimenes track by item.id">
								
							</select>
							<div class="error campo-requerido" ng-show="formulario.i_regimen.$invalid && (formulario.i_regimen.$touched || submitted)">
								<small class="error" ng-show="formulario.i_regimen.$error.required">
									* Campo requerido.
							    </small>
							</div>													
						</div>
		            </div>	    


		            <div class="form-group">
		                <label class="col-md-3 control-label">Cantidad</label>
		                <div class="col-md-7">
							<input class="form-control error:formulario.i_cantidad.$invalid && (formulario.i_cantidad.$touched || submitted)"
									type="number"
									ng-max= "99"
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
							    	El campo debe tener maximo 2 digitos.
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
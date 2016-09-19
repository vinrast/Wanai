@extends('base')

@section('controller')
	<script src="{{ asset('/js/controllers/hoteles/agregar_hotel.js') }}"></script>
@endsection

@section('content')
	
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed"  ng-controller="AgregarHotelesController">
	
	@include('layouts/navbar')

	@include('layouts/sidebar')
		<div id="content" class="content">
			
			<ol class="breadcrumb pull-right">
				<div class="btn-toolbar">
                    <div class="btn-group">
                        <a href="{{ url ('/hoteles/agr') }}" data-toggle="tooltip" data-title="Agregar" class="btn btn-white btn-sm p-l-20 p-r-20">
                        	<i class="fa fa-plus-square"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="{{ url ('/hoteles/listar') }}" data-toggle="tooltip" data-title="Editar" class="btn btn-white btn-sm p-l-20 p-r-20">
                        	<i class="fa fa-pencil-square-o"></i>
                        </a>
                    </div>
                </div>
			</ol>

			<div>
				<h1 class="page-header"><i class="fa fa-bed"></i> Registro de Hoteles </h1>
				<div class="row">
	                <div class="col-12 ui-sortable">
	                    <div class="panel panel-inverse">
	                        <div class="panel-heading">
	                            <div class="panel-heading-btn">
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
	                            </div>
	                            <h4 class="panel-title">Formulario Registro de Hoteles</h4>
	                        </div>

	                        <div class="panel-body">
								<div id="wizard" class="bwizard clearfix">
									<ol class="bwizard-steps clearfix clickable" role="tablist">
										<li role="tab" aria-selected="true" class="active" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="#step1" class="hidden-phone">
										    Información Básica 
										    </a><a href="#" class="hidden-phone"><small>Ingrese la información básica correspodiente a su hotel.</small></a><a href="#step1" class="hidden-phone">
										</a></li>
										<li role="tab" aria-selected="false" style="z-index: 3;"><span class="label">2</span><a href="#step2" class="hidden-phone">
										    Carga de Imágenes
										    </a><a href="#" class="hidden-phone"><small>Registre todas las imágenes necesarias para su hotel.</small></a><a href="#step2" class="hidden-phone">
										</a></li>
										<li role="tab" aria-selected="false" style="z-index: 2;"><span class="label">3</span><a href="#step3" class="hidden-phone">
                                            Habitaciones
                                            </a><a href="#" class="hidden-phone"><small>Registre todas las habitaciones que posee su hotel.</small></a><a href="#step3" class="hidden-phone">
                                        </a></li>
                                        <li role="tab" aria-selected="false" style="z-index: 1;"><span class="label">4</span><a href="#step4" class="hidden-phone">
                                            Regimen
                                            </a><a href="#" class="hidden-phone"><small>Regitre lo regimenes de su hotel.</small></a><a href="#step4" class="hidden-phone">
                                        </a></li>
                                    </ol>
                                </div>
	                        
	                        <br>
	                        <div class="well">
	                        	<div ng-init="posturl='{{url('/hoteles/posthotel')}}'" ></div>
	                        	@if(Session::has('hotel'))
	                            	<div ng-init="hotel={{$data}}" ></div>
	                            	<div ng-init="img = '{{ url ('/uploads/hoteles/img_low/') }}/'+hotel.url_imagen_hotel" ></div>
	                        		<div ng-init="posturl='{{url('/hoteles/posteditarhotel')}}'" ></div>
	                            @endif
	                            <div ng-init="inicializar( {{ $servicio }} )" ></div>
								<form class="form-horizontal" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" enctype="multipart/form-data" novalidate>

									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									
									<div class="form-group">
						                <label class="col-md-3 control-label">Nombre</label>
						                <div class="col-md-7">
						                    <input class="form-control error:[[ formulario.i_nombre.$invalid && (formulario.i_nombre.$touched || submitted) ]]"
						                    		type="text" 
								                    ng-maxlength="100" 
								                    placeholder="Nombre del Hotel"
								                    name="i_nombre" 
								                    ng-model="hotel.nombre_hotel"
								                    required>

											<div class="error campo-requerido" ng-show="formulario.i_nombre.$invalid && (formulario.i_nombre.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_nombre.$error.required">
											        * Campo requerido.
											    </small>
											    <small class="error" ng-show="formulario.i_nombre.$error.maxlength">
											        El nombre no debe contener mas de 100 caracteres.
											    </small>
											</div>						                    
						                </div>
						            </div>

						            <div class="form-group">
						                <label class="col-md-3 control-label">Telefono</label>
						                <div class="col-md-7">
						                    <input type="text" maxlength="20" class="form-control error:[[ formulario.i_telefono.$invalid && (formulario.i_telefono.$touched || submitted) ]]"
								                    placeholder="0212-1234567"
								                    name="i_telefono"
								                    ng-model="hotel.telefono_hotel"
								                    data-mask="9999-9999999"
						                    		required>
						                    <div class="error campo-requerido" ng-show="formulario.i_telefono.$invalid && (formulario.i_telefono.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_telefono.$error.required">
											        * Campo requerido.
											    </small>
											</div>
						                </div>
						            </div>

						            <div class="form-group">
						                <label class="col-md-3 control-label">Otro Telefono</label>
						                <div class="col-md-7">
						                    <input type="text" maxlength="20" class="form-control error:[[ formulario.i_telefono2.$invalid && (formulario.i_telefono2.$touched || submitted)]]"
								                    placeholder="0212-1234567"
								                    name="i_telefono2"
								                    ng-model="hotel.telefono_hotel_2"
								                    data-mask="9999-9999999">
											<div class="error campo-requerido" ng-show="formulario.i_telefono2.$invalid && (formulario.i_telefono2.$touched || submitted)">
												<small class="error" ng-show="formulario.i_telefono2.$error.required">
													* Campo requerido.
											    </small>
											</div>						                    
						                </div>
						            </div>

						            <div class="form-group">
						                <label class="col-md-3 control-label">Estado</label>
						                <div class="col-md-7">
						                    <select class="form-control m-bot15"
						                    		name="s_estado"
						                    		ng-model="hotel.id_tipo_estado"
						                    		required>
						                    	<option class="option" value="">Seleccione un estado</option>
									            @foreach($estados as $key)
													<option class="option" value="{{ $key->id_tipo }}" >{{ $key->nombre_tipo }} </option>
												@endforeach
											</select>
											<div class="error campo-requerido" ng-show="formulario.s_estado.$invalid && (formulario.s_estado.$touched || submitted)">
												<small class="error" ng-show="formulario.s_estado.$error.required">
													* Campo requerido.
											    </small>
											</div>	
						                </div>
						            </div>
									
									<div class="form-group">
						                <label class="col-md-3 control-label">Dirección</label>
						                <div class="col-md-7">
						                    <textarea class="form-control"
						                    			placeholder="Dirección del Hotel"
						                    			rows="5"
						                    			name="i_direccion"
						                    			ng-model="hotel.direccion_hotel"
						                    			required></textarea>
											<div class="error campo-requerido" ng-show="formulario.i_direccion.$invalid && (formulario.i_direccion.$touched || submitted)">
												<small class="error" ng-show="formulario.i_direccion.$error.required">
													* Campo requerido.
											    </small>
											</div>							                    
						                </div>						                
						            </div>
						            <div class="form-group">
								        <label class="col-md-3 control-label">Servicios que ofrece el Hotel</label>
								        <div class="col-md-7">
											<ui-select class="form-control" multiple ng-model="hotel.id_tipo_servicio" ng-disabled="disabled" close-on-select="false" >
											    <ui-select-match placeholder="Seleccione los servicios"> [[$item]]</ui-select-match>
											    <ui-select-choices repeat="eleccion in data_select_multiple | filter:$select.search">
											    	[[eleccion]]
											    </ui-select-choices>
											</ui-select>
											<div class="error campo-requerido" ng-show="(!hotel.id_tipo_servicio || hotel.id_tipo_servicio.length===0 ) && submitted">
												<small class="error" ng-show="(!hotel.id_tipo_servicio || hotel.id_tipo_servicio.length===0 )">
													* Campo requerido.
											    </small>
											</div>										      	
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label">Indique La Categoria del hotel a registrar</label>
										<div class="col-md-7">
										<fieldset class="rating" >		    
										    <input type="radio" id="star5" name="i_categoria" value="5" ng-model="hotel.categoria_hotel" required/><label for="star5">5 stars</label>
										    <input type="radio" id="star4" name="i_categoria" value="4" ng-model="hotel.categoria_hotel" required/><label for="star4">4 stars</label>
										    <input type="radio" id="star3" name="i_categoria" value="3" ng-model="hotel.categoria_hotel" required/><label for="star3">3 stars</label>
										    <input type="radio" id="star2" name="i_categoria" value="2" ng-model="hotel.categoria_hotel" required/><label for="star2">2 stars</label>
										    <input type="radio" id="star1" name="i_categoria" value="1" ng-model="hotel.categoria_hotel" required/><label for="star1">1 star</label>	
											<div class="error" ng-show="formulario.i_categoria.$invalid && (formulario.i_categoria.$touched || submitted)">
												<small class="error" ng-show="formulario.i_categoria.$error.required">
													* Campo requerido.
											    </small>
											</div>											    
										</fieldset>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Imagen de perfil</label>
										<div class="col-md-9 iconic-input right">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<input type="hidden" name="namefile" id="namefile" ng-model="hotel.url_imagen_hotel" ng-update-hidden required>
												<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
													<img class="img-responsive img-responsive-custon" ng-src="[[img]]" alt="" style="width: 200px; height: 200px;">
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
												<div>
													<button type="button" class="btn btn-success" style="width: 200px;" data-toggle="modal" data-target="#myModal">
														<span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
														Seleccionar imagen
													</button>
												</div>	
												<div class="error campo-requerido" ng-show="formulario.namefile.$invalid && (formulario.namefile.$touched || submitted)">
												<small class="error" ng-show="formulario.namefile.$error.required">
													* Campo requerido.
											    </small>
											</div>	
											</div>											
										</div>
									</div>

									<br><br>
									<center>
										<button type="submit" class="btn btn-success m-r-5 m-b-5">
											Siguiente <i class="fa fa-chevron-right"></i>
										</button>
									</center>
								</form> 
		                        </div>
		                    </div>
		                </div>
		            </div>
				</div>
			</div>
		</div>
	@include('modals/validacion_modal')
	@include('modals/upload_image')
	</div>
	
@endsection
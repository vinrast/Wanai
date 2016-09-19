@extends('base')

@section('controller')
	<script src="{{ asset('/js/controllers/paquetes/agregar_paquete.js') }}"></script>
@endsection


@section('content')
	
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

	@include('layouts/navbar')

	@include('layouts/sidebar')

		<div id="content" class="content" ng-controller="PaquetesController">
			<ol class="breadcrumb pull-right">
				<div class="btn-toolbar">
	                <div class="btn-group">
	                    <a href="{{ url ('/paquetes/agr') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
	                    	<i class="fa fa-plus-square"></i>
	                    </a>
	                </div>
	                <div class="btn-group">
	                    <a href="{{ url ('/paquetes/listar') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
	                    	<i class="fa fa-pencil-square-o"></i>
	                    </a>
	                </div>
	            </div>
			</ol>
			<h1 class="page-header"><i class="fa fa-plane"></i> Registro de Paquetes</h1>
			<div class="row">
                <div class="col-12 ui-sortable">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">Formulario Registro de Paquetes</h4>
                        </div>

                        <div class="panel-body">
							<div id="wizard" class="bwizard clearfix">
								<ol class="bwizard-steps clearfix clickable" role="tablist">
									<li role="tab" aria-selected="true" class="active" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="#step1" class="hidden-phone">
									    Información Básica de Paquetes
									    </a><a href="#" class="hidden-phone"><small>Ingrese la información básica correspodiente al Paquete.</small></a><a href="#step1" class="hidden-phone">
									</a></li>
									<li role="tab" aria-selected="false" style="z-index: 3;"><span class="label">2</span><a href="#step2" class="hidden-phone">
									    Carga de Imágenes
									    </a><a href="#" class="hidden-phone"><small>Registre todas las imágenes necesarias para el Paquete.</small></a><a href="#step2" class="hidden-phone">
									</a></li>
								</ol>
                        	</div>
                       		<br>
	                        <div class="well">

	                        	<div ng-init="posturl='{{url('/paquetes/postpaquete')}}'" ></div>
	                        	@if(Session::has('paquete'))
	                            	<div ng-init="inicializador( {{$data}} )" ></div>
	                        		<div ng-init="posturl='{{url('/paquetes/posteditarpaquete')}}'" ></div>
	                            @endif

								<form class="form-horizontal" id="formulario" name="formulario" ng-submit="submit(formulario.$valid)" novalidate>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
									<div class="form-group">
						                <label class="col-md-3 control-label">Nombre</label>
						                <div class="col-md-7">
						                    <input class="form-control error:[[ formulario.i_nombre.$invalid && (formulario.i_nombre.$touched || submitted) ]]"
						                    		type="text" 
								                    ng-maxlength="20" 
								                    placeholder="Nombre del paquete"
								                    name="i_nombre" 
								                    ng-model="paquete.nombre_paquete"
								                    required/>

											<div class="error campo-requerido" ng-show="formulario.i_nombre.$invalid && (formulario.i_nombre.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_nombre.$error.required">
											        * Campo requerido.
											    </small>
											    <small class="error" ng-show="formulario.i_nombre.$error.maxlength">
											        El nombre no debe contener mas de 20 caracteres.
											    </small>
											</div>						                    
						                </div>
						            </div>
									<div class="form-group">
										<label class="col-md-3 control-label">Descripción Paquete</label>
										<div class="col-md-7">
											<textarea class="form-control error:formulario.i_descripcion.$invalid && (formulario.i_descripcion.$touched || submitted) " 
														name="i_descripcion" 
														placeholder="Descipción" 
														ng-model="paquete.descripcion_paquete"
														required>
											</textarea>
											<div class="error campo-requerido" ng-show="formulario.i_descripcion.$invalid && (formulario.i_descripcion.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_descripcion.$error.required">
											        * Campo requerido.
											    </small>
											</div>
										</div>														
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Fecha de Salida</label>
							            <div class="col-md-7">
	                                        <div class="input-group date" id="datepicker-disabled-past" data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
	                                            <input type="text" class="form-control" name="i_salida" placeholder="yyyy-mm-dd" ng-model="paquete.fecha_inicio_paquete" required>
	                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>	                                            
	                                        </div>
											<div class="error campo-requerido" ng-show="formulario.i_salida.$invalid && (formulario.i_salida.$touched || submitted)">
												<small class="error" ng-show="formulario.i_salida.$error.required">
													* Campo requerido.
											    </small>
											</div>		                                        
                                    	</div>
                                    </div>

									<div class="form-group">
										<label class="col-md-3 control-label">Fecha de Retorno</label>
							            <div class="col-md-7">
	                                        <div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
	                                            <input type="text" class="form-control" name="i_retorno" placeholder="yyyy-mm-dd" ng-model="paquete.fecha_final_paquete" required>
	                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>	                                            
	                                        </div>
											<div class="error campo-requerido" ng-show="formulario.i_retorno.$invalid && (formulario.i_retorno.$touched || submitted)">
												<small class="error" ng-show="formulario.i_retorno.$error.required">
													* Campo requerido.
											    </small>
											</div>		                                        
                                    	</div>
                                    </div>                                    


						            <div class="form-group">
						                <label class="col-md-3 control-label">Opciones de Paquetes</label>
						                <div class="col-md-7">
						                    <select class="form-control m-bot15 error:formulario.s_paquete.$invalid && (formulario.s_paquete.$touched || submitted)" 
						                    		name="s_paquete" 
						                    		ng-model="paquete.id_tipo_paquete" 
						                    		required>
												<option class="option" value="">Seleccione una opción</option>
												@foreach($paquetes as $key)
													<option class="option" value="{{ $key->id_tipo }}">
														{{ $key->nombre_tipo }}
													</option>
												@endforeach
											</select>
											<div class="error campo-requerido" ng-show="formulario.s_paquete.$invalid && (formulario.s_paquete.$touched || submitted)">
												<small class="error" ng-show="formulario.s_paquete.$error.required">
													* Campo requerido.
											    </small>
											</div>													
						                </div>
						            </div>

						            <div class="form-group">
	                                    <label class="col-md-3 control-label">Traslado</label>
	                                    <div class="col-md-7" >
	                                        <label class="radio-inline">
	                                            <input type="radio" name="i_traslado" value="1" ng-model="paquete.con_boleto_paquete" required/>
	                                            Si
	                                        </label>
	                                        <label class="radio-inline">
	                                            <input type="radio" name="i_traslado" value="0" ng-model="paquete.con_boleto_paquete" required/>
	                                            no
	                                        </label>
											<div class="error campo-requerido" ng-show="formulario.i_traslado.$invalid && (formulario.i_traslado.$touched || submitted)">
												<small class="error" ng-show="formulario.i_traslado.$error.required">
													* Campo requerido.
											    </small>
											</div>	
	                                    </div>
	                                </div>

									<div class="form-group">
										<label class="col-md-3 control-label">Costo</label>
										<div class="col-md-7">
											<input class="form-control error:formulario.i_costo.$invalid && (formulario.i_costo.$touched || submitted)" 
													type="number" 
													max= "999999" 
													name="i_costo" 
													placeholder="100" 
													ng-model="paquete.costo_paquete"
													required/>
											<div class="error campo-requerido" ng-show="formulario.i_costo.$invalid && (formulario.i_costo.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_costo.$error.required">
											        * Campo requerido.
											    </small>
											    <small class="error" ng-show="formulario.i_costo.$error.max">
											    	El campo debe tener maximo 6 digitos.
											    </small>	
												<small class="error" ng-show="formulario.i_costo.$error.number">
											    	Introduzca solo números.
											    </small>	
											</div>
										</div>
									</div>

									<center>
										<button type="submit" class="btn btn-success m-r-5 m-b-5">Siguiente <i class="fa fa-angle-right"></i></button>
									</center>
							
								</form>

							</div>
                		</div>
            		</div>			
				</div>
			</div>
		@include('modals/validacion_modal')	
		</div>
		
	</div>

@endsection
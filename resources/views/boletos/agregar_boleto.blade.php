@extends('base')

@section('controller')
	<script src="{{ asset('/js/controllers/boletos/agregar_boleto.js') }}"></script>
@endsection

@section('content')
	
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="AgregarBoletosController">

	@include('layouts/navbar')

	@include('layouts/sidebar')
		<div id="content" class="content">
				<ol class="breadcrumb pull-right">
					<div class="btn-toolbar">
	                    <div class="btn-group">
	                        <a href="{{ url ('/boletos/agr') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
	                        	<i class="fa fa-plus-square"></i>
	                        </a>
	                    </div>
	                    <div class="btn-group">
	                        <a href="{{ url ('/boletos/listar') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
	                        	<i class="fa fa-pencil-square-o"></i>
	                        </a>
	                    </div>
	                </div>
				</ol>

				<h1 class="page-header"><i class="fa fa-ticket"></i> Registro de Boletos </h1>
				<div class="row">
	                <div class="col-12 ui-sortable">
	                    <div class="panel panel-inverse">
	                        <div class="panel-heading">
	                            <div class="panel-heading-btn">
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
	                            </div>
	                            <h4 class="panel-title">Formulario Registro de Boletos</h4>
	                        </div>

	                        <div class="panel-body">
								<div id="wizard" class="bwizard clearfix">
									<ol class="bwizard-steps clearfix clickable" role="tablist">
										<li role="tab" aria-selected="true" class="active" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="#step1" class="hidden-phone">
										    Información del Boleto 
										    </a><a href="#" class="hidden-phone"><small>Ingrese la información correspodiente al Boleto.</small></a><a href="#step1" class="hidden-phone">
										</a></li>
									</ol>
	                        </div>
	                        <br>
	                        <div class="well">
								<form class="form-horizontal" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" novalidate>
									<div ng-init="posturl='{{url('/boletos/postboleto')}}'" ></div>
		                        	@if(Session::has('boleto'))
		                            	<div ng-init="inicializador( {{$data}} )" ></div>
		                            	<div ng-init="posturl='{{url('/boletos/posteditarboleto')}}'" ></div>
		                            @endif
									<input type="hidden" name="_token" value="{{ csrf_token() }}">									
									<div class="form-group">
						                <label class="col-md-3 control-label">Aerolinea</label>
						                <div class="col-md-7">
						                    <select class="form-control m-bot15" name="s_aerolinea" ng-model = "boleto.id_aerolinea" required>
						                    	<option class="option" value="">Seleccione una aerolinea</option>
									            @foreach($aerolinea as $key)
													<option class="option" value="{{ $key->id_aerolinea }}">
														{{ $key->nombre_aerolinea }} 
													</option>;
												@endforeach
											</select>
											<div class="error campo-requerido" ng-show="formulario.s_aerolinea.$invalid && (formulario.s_aerolinea.$touched || submitted)">
												<small class="error" ng-show="formulario.s_aerolinea.$error.required">
													* Campo requerido.
											    </small>
											</div>
						                </div>
						            </div>

						            <div class="form-group">
						                <label for="s_origen" class="col-md-3 control-label">Origen</label>
						                <div class="col-md-7">
						                    <select class="form-control m-bot15" name="s_origen" id="s_origen" ng-model="boleto.id_tipo_origen" required>
						                    	<option class="option" value="">Seleccione el lugar de origen</option>
									           	@foreach($estados as $key)
													<option class="option" value="{{$key->id_tipo}}">
														{{ $key->nombre_tipo }}
													</option>;
												@endforeach
											</select>
											<div class="error campo-requerido" ng-show="formulario.s_origen.$invalid && (formulario.s_origen.$touched || submitted)">
												<small class="error" ng-show="formulario.s_origen.$error.required">
													* Campo requerido.
											    </small>
											</div>											
						                </div>
						            </div>

						            <div class="form-group">
						                <label for="s_destino" class="col-md-3 control-label">Destino</label>
						                <div class="col-md-7">
						                    <select class="form-control m-bot15" name="s_destino" id="s_destino" ng-model = "boleto.id_tipo_destino" required>
						                    	<option class="option" value="">Seleccione el lugar de destino</option>
									           	@foreach($estados as $key)
													<option class="option" value="{{ $key->id_tipo}}">
														{{ $key->nombre_tipo }}
													</option>;
												@endforeach
											</select>
											<div class="error campo-requerido" ng-show="formulario.s_destino.$invalid && (formulario.s_destino.$touched || submitted)">
												<small class="error" ng-show="formulario.s_destino.$error.required">
													* Campo requerido.
											    </small>
											</div>												
						                </div>
						            </div>
									
									<div class="form-group">
										<label class="col-md-3 control-label">Fecha de Salida</label>
							            <div class="col-md-7">
	                                        <div class="input-group date" id="datepicker-disabled-past" data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
	                                            <input type="text" class="form-control" name="i_salida" placeholder="yyyy-mm-dd" ng-model="boleto.fecha_salida_boleto" required>	                                            
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
						                <label class="col-md-3 control-label">Cantidad de boletos disponibles</label>
						                <div class="col-md-7">
											<input class="form-control error:formulario.i_cantidad.$invalid && (formulario.i_cantidad.$touched || submitted)"
													type="number"
													ng-max= "999999"
													name="i_cantidad"
													placeholder="50" 
													ng-model="boleto.cantidad_boleto"
													required>
											<div class="error campo-requerido" ng-show="formulario.i_cantidad.$invalid && (formulario.i_cantidad.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_cantidad.$error.required">
											        * Campo requerido.
											    </small>
											    <small class="error" ng-show="formulario.i_cantidad.$error.max">
											    	El campo debe tener maximo 6 digitos.
											    </small>	
												<small class="error" ng-show="formulario.i_cantidad.$error.number">
											    	Introduzca solo números.
											    </small>	
											</div>						                    
						                </div>
						            </div>
						            <br>
						            <div class="row">
						            	<label class="col-md-3 control-label">Costo del boleto</label>
						            </div>
						            <br>
						            <div class="form-group">
						                <label class="col-md-3 control-label">Adulto</label>
						                <div class="col-md-7">
											<input class="form-control error:formulario.i_costo_adulto.$invalid && (formulario.i_costo_adulto.$touched || submitted)"
													type="number"
													ng-max= "999999"
													name="i_costo_adulto"
													placeholder="100" 
													ng-model="boleto.costo_boleto_adulto"
													required>
											<div class="error campo-requerido" ng-show="formulario.i_costo_adulto.$invalid && (formulario.i_costo_adulto.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_costo_adulto.$error.required">
											        * Campo requerido.
											    </small>
											    <small class="error" ng-show="formulario.i_costo_adulto.$error.max">
											    	El campo debe tener maximo 6 digitos.
											    </small>	
												<small class="error" ng-show="formulario.i_costo_adulto.$error.number">
											    	Introduzca solo números.
											    </small>	
											</div>
						                </div> 
						            </div>
									
						            <div class="form-group">
						                <label class="col-md-3 control-label">Infante</label>
						                <div class="col-md-7">
											<input class="form-control error:formulario.i_costo_infante.$invalid && (formulario.i_costo_infante.$touched || submitted)"
													type="number"
													ng-max= "999999"
													name="i_costo_infante"
													placeholder="100" 
													ng-model="boleto.costo_boleto_infante"
													required>
											<div class="error campo-requerido" ng-show="formulario.i_costo_infante.$invalid && (formulario.i_costo_infante.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_costo_infante.$error.required">
											       	* Campo requerido.
											    </small>
											    <small class="error" ng-show="formulario.i_costo_infante.$error.max">
											    	El campo debe tener maximo 6 digitos.
											    </small>	
												<small class="error" ng-show="formulario.i_costo_infante.$error.number">
											    	Introduzca solo números.
											    </small>	
											</div>
						                </div> 
						            </div>		

						            <div class="form-group">
						                <label class="col-md-3 control-label">bebe</label>
						                <div class="col-md-7">

											<input class="form-control error:formulario.i_costo_bebe.$invalid && (formulario.i_costo_bebe.$touched || submitted)"
													type="number"
													ng-max= "999999"
													name="i_costo_bebe"
													placeholder="100" 
													ng-model="boleto.costo_boleto_bebe"
													required>
											<div class="error campo-requerido" ng-show="formulario.i_costo_bebe.$invalid && (formulario.i_costo_bebe.$touched || submitted) ">
											    <small class="error" ng-show="formulario.i_costo_bebe.$error.required">
											        * Campo requerido.
											    </small>
											    <small class="error" ng-show="formulario.i_costo_bebe.$error.max">
											    	El campo debe tener maximo 6 digitos.
											    </small>	
												<small class="error" ng-show="formulario.i_costo_bebe.$error.number">
											    	Introduzca solo números.
											    </small>	
											</div>						                	
						                </div> 
						            </div>
			
									<center>
										<button type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-pencil-square-o"></i> Registrar</button>
									</center>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@include('modals/validacion_modal')
	</div>

@endsection
@extends('base')

@section('controller')
	<script src="{{ asset('/js/controllers/hoteles/agregar_habitacion.js') }}"></script>
@endsection

@section('content')
	
	<!-- begin #content -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
    @include('layouts/navbar')

    @include('layouts/sidebar')
    
		<div id="content" class="content" ng-controller="AgregarHabitacionesController">

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

			<h1 class="page-header"><i class="fa fa-bed"></i> Registrar Habitaciones </h1>
			<div class="row">
				<div class="col-12 ui-sortable">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
							</div>
							<h4 class="panel-title">Formulario Registro de habitaciones</h4>
						</div>

						<div class="panel-body">
							<div id="wizard" class="bwizard clearfix">
								<ol class="bwizard-steps clearfix clickable" role="tablist">
									<li role="tab" aria-selected="false" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="#step1" class="hidden-phone">
										Información Básica
										</a><a href="#" class="hidden-phone"><small>Ingrese la información básica correspodiente a su hotel.</small></a><a href="#step1" class="hidden-phone">
									</a></li>
									<li role="tab" aria-selected="false" style="z-index: 3;"><span class="label">2</span><a href="#step2" class="hidden-phone">
										Carga de Imágenes
										</a><a href="#" class="hidden-phone"><small>Registre todas las imágenes necesarias para su hotel.</small></a><a href="#step2" class="hidden-phone">
									</a></li>
									<li role="tab" aria-selected="true" class="active" style="z-index: 2;"><span class="label">3</span><a href="#step3" class="hidden-phone">
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
							<form name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" novalidate>
								<div class="bwizard-activated">
									<fieldset>
										<div class="row">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="col-md-3">
												<div class="form-group">
													<label><i class="fa fa-bed"></i>Nombre</label>
													<input class="form-control error:formulario.i_nombre.$invalid && (formulario.i_nombre.$touched || submitted) " 
															type="text"
															name="i_nombre" 
															ng-maxlength="100" 
															placeholder="Habitación doble"
															ng-model="nombre" 
															required>
													<div class="error" ng-show="formulario.i_nombre.$invalid && (formulario.i_nombre.$touched || submitted) ">
													    <small class="error" ng-show="formulario.i_nombre.$error.required">
													        * Campo requerido.
													    </small>
													    <small class="error" ng-show="formulario.i_nombre.$error.maxlength">
													        El nombre no debe contener mas de 20 caracteres.
													    </small>
													</div>														
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label><i class="fa fa-money"></i> Costo</label>
													<input class="form-control error:formulario.i_costo.$invalid && (formulario.i_costo.$touched || submitted)"
															type="number"
															ng-max= "999999"
															name="i_costo"
															placeholder="100" 
															ng-model="costo"
															required>
													<div class="error" ng-show="formulario.i_costo.$invalid && (formulario.i_costo.$touched || submitted) ">
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
											<div class="col-md-6">
												<div class="form-group">
													<label><i class="fa fa-list"></i> Descipción de Habitación</label>
													<input class="form-control error:formulario.i_descripcion.$invalid && (formulario.i_descripcion.$touched || submitted) " 
															type="text"
															name="i_descripcion" 
															placeholder="Descipción" 
															ng-model="descripcion"
															required>
													<div class="error" ng-show="formulario.i_descripcion.$invalid && (formulario.i_descripcion.$touched || submitted) ">
													    <small class="error" ng-show="formulario.i_descripcion.$error.required">
													        * Campo requerido.
													    </small>
													</div>														
												</div>
											</div>
											<div class="col-md-1">
												<div class="form-group">
													<label>Agregar</label>
													<button type="submit" class="btn btn-info">
														<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
							<div ng-init="habitaciones={{ $data }}"></div>
							<div class="col-md-12">
								<div class="panel-group" id="accordion">

									<div class="panel panel-inverse overflow-hidden" ng-repeat='habitacion in habitaciones'>
										<div class="panel-heading">
											<h3 class="panel-title">
												<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#nombre_habitacion[[$index]]" aria-expanded="false">
													<i class="fa fa-plus-circle pull-right"></i>
													[[ habitacion.nombre_habitacion ]]
												</a>
											</h3>
										</div>
										<div id="nombre_habitacion[[$index]]" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
											<div class="panel-body">
												<label><i class="fa fa-list"></i> Descipción:</label>
												[[ habitacion.descripcion_habitacion ]]
											</div>
											<div class="row">
												<center>
												<div class="col-md-2">
												</div>
												<div class="col-md-4">
													<label><i class="fa fa-money"></i> Costo: </label>
													[[habitacion.costo_habitacion]]
												</div>
												</center>
											</div>
											<div class="row">
												<div class="col-md-11"></div>
												<div class="col-md-1">
													<button class="btn btn-danger m-r-5 m-b-5" ng-click="eliminar($index,habitacion.id_habitacion)">
														<i class="fa fa-trash"></i>
													</button>
												</div>
											</div>
										</div>
									</div>


								</div>
							</div>

							<div class="row">
								<center>
									<button type="button" class="btn btn-success m-r-5" ng-click="enviar()">
										Siguiente
										<i class="fa fa-angle-right"></i>
									</button>
								</center>
							</div>
							<br>
					</form>

						</div>
					</div>
				</div>
			</div>
		@include('modals/validacion_modal')
		</div><!-- content-->
    </div>

@endsection

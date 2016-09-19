@extends('base')

@section('controller')
	<script src="{{ asset('/js/controllers/paquetes/registrado.js') }}"></script>
@endsection

@section('content')
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

	@include('layouts/navbar')

	@include('layouts/sidebar')
	<div id="content" class="content" ng-controller="PaqueteRegistradoController">
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
				<h1 class="page-header"><i class="fa fa-plane"></i> Registro de Paquetes Final</h1>
				<div class="row">
	                <div class="col-12 ui-sortable">
	                    <div class="panel panel-inverse">
	                        <div class="panel-heading">
	                            <div class="panel-heading-btn">
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
	                            </div>
	                            <h4 class="panel-title">Formulario Registro de Paquetes Final</h4>
	                        </div>

	                        <div class="panel-body">
								<div id="wizard" class="bwizard clearfix">
									<ol class="bwizard-steps clearfix clickable" role="tablist">
										<li role="tab" aria-selected="true" class="active" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="#step1" class="hidden-phone">
										    Información Básica de Paquetes
										    </a><a href="#" class="hidden-phone"><small>Ingrese la información básica correspodiente al Paquete.</small></a><a href="#step1" class="hidden-phone">
										</a></li>
										<li role="tab" aria-selected="true" class="active"  style="z-index: 3;"><span class="label">2</span><a href="#step2" class="hidden-phone">
										    Carga de Imágenes
										    </a><a href="#" class="hidden-phone"><small>Registre todas las imágenes necesarias para el Paquete.</small></a><a href="#step2" class="hidden-phone">
										</a></li>
									</ol>
	                        </div>
	                        <br>

	                        <div class="well-info-boleto">
	                        	
		                        	<ul class="result-list">
			                            <li ng-init="dato={{$datos}}[0]">
			                            	
			                                <div class="result-image">
			                                    <a href="#"><img src="{{ url('/uploads/paquetes/img_high/'.$imagenes->first()->url_imagen )}}" alt=""></a>
			                                </div>
			                                
			                                <div class="result-info">
			                                    <h4 class="title"><a href="javascript:;">[[dato.nombre_paquete]]</a></h4>
			                                    <p class="location"><i class="fa fa-calendar"></i> Salida  [[dato.fecha_inicio_paquete]]</p>
			                                    <p class="location"><i class="fa fa-calendar"></i> Retorno [[dato.fecha_final_paquete]]</p>
			                                    <p class="desc">
			                                        [[dato.descripcion_paquete]]
			                                    </p>
			                                    <div class="btn-row">
			                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics" data-original-title="" title=""><i class="fa fa-fw fa-bar-chart-o"></i></a>
			                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Tasks" data-original-title="" title=""><i class="fa fa-fw fa-tasks"></i></a>
			                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Configuration" data-original-title="" title=""><i class="fa fa-fw fa-cog"></i></a>
			                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Performance" data-original-title="" title=""><i class="fa fa-fw fa-tachometer"></i></a>
			                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Users" data-original-title="" title=""><i class="fa fa-fw fa-user"></i></a>
			                                    </div>
			                                </div>
			                                <div class="result-price">
			                                    $[[dato.costo_paquete]] <small>COSTO</small>
			                                    <a href="javascript:;" class="btn btn-inverse btn-block">Paquete</a>
			                                </div>
			                            </li>
			                        </ul>
	                        
	                        </div>
							<div class="well">
								<center>
									<a href="{{ url ('/paquetes/agr') }}" class="btn btn-success">
										<i class="fa fa-plus-square"></i> Agregar Nuevo Paquete
									</a>
								</center>
	                    	</div>

						</div>
		                <!-- end col-6 -->
		            </div>			
				</div>
			</div>
		</div>
	</div>

@endsection
@extends('base')

@section('controller')
	<script src="{{ asset('/js/controllers/hoteles/registrado.js') }}"></script>
@endsection


@section('content')
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="HotelRegistradoController">
	
	@include('layouts/navbar')

	@include('layouts/sidebar')
		
		<!-- begin #content -->
		<div id="content" class="content">
			
			<ol class="breadcrumb pull-right">
				<div class="btn-toolbar">
                    <div class="btn-group">
                        <a href="{{ url ('/hoteles/agr') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
                        	<i class="fa fa-plus-square"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="{{ url ('/hoteles/listar') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
                        	<i class="fa fa-pencil-square-o"></i>
                        </a>
                    </div>
                </div>
			</ol>

			<h1 class="page-header"><i class="fa fa-bed"></i> Registro de Hotel Finalizado</h1>

			<div class="row">
                <!-- begin col-12 -->
                <div class="col-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">Formulario Registro de Hotel Finalizado</h4>
                        </div>
                    	
                    	<div class="panel-body">
							<div id="wizard" class="bwizard clearfix">
								<ol class="bwizard-steps clearfix clickable" role="tablist">
									<li role="tab" aria-selected="true" class="active" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="#step1" class="hidden-phone">
									    Información Básica 
									    </a><a href="#" class="hidden-phone"><small>Ingrese la información básica correspodiente a su hotel.</small></a><a href="#step1" class="hidden-phone">
									</a></li>
									<li role="tab" aria-selected="true" class="active" style="z-index: 3;"><span class="label">2</span><a href="#step2" class="hidden-phone">
									    Carga de Imágenes
									    </a><a href="#" class="hidden-phone"><small>Registre todas las imágenes necesarias para su hotel.</small></a><a href="#step2" class="hidden-phone">
									</a></li>
									<li role="tab" aria-selected="true" class="active" style="z-index: 2;"><span class="label">3</span><a href="#step3" class="hidden-phone">
									    Habitaciones
									    </a><a href="#" class="hidden-phone"><small>Agregue habitaciones disponibles en el hotel.</small></a><a href="#step3" class="hidden-phone">
									</a></li>
									<li role="tab" aria-selected="true" class="active" style="z-index: 1;"><span class="label">4</span><a href="#step4" class="hidden-phone">
									    Regimen
									    </a><a href="#" class="hidden-phone"><small>Asocie tipos de planes al hotel ingresado.</small></a><a href="#step4" class="hidden-phone">
									</a></li>
								</ol>
								<!-- begin wizard step-1 -->
								
								<!-- end wizard step-1 -->
								<!-- begin wizard step-2 -->
								
								<!-- end wizard step-2 -->
								<!-- begin wizard step-3 -->
								
								<!-- end wizard step-3 -->
								<!-- begin wizard step-4 -->
								
								<!-- end wizard step-4 -->
                        </div>
                        <br>

						<div class="profile-container">
							<div ng-init="inicializar({{$datos}})"></div>
			                <!-- begin profile-section -->
			                <div class="profile-section">
			                    <!-- begin profile-left -->
			                    <div class="profile-left">
			                        <!-- begin profile-image -->
			                        <div class="profile-image">
			                            <img ng-src="{{ url('/uploads/hoteles/img_high/')}}/[[dato.url_imagen_hotel]]" ng-cloak>
			                            <i class="fa fa-user hide"></i>
			                        </div>
			                        
			                    </div>
			                    <!-- end profile-left -->
			                    <!-- begin profile-right -->
			                    <div class="profile-right">
			                        <!-- begin profile-info -->
			                        <div class="profile-info">
			                            <!-- begin table -->
			                            
			                            <div class="table-responsive">
			                                <table class="table table-profile">

			                                    <tbody>
			                                        <tr class="highlight">
			                                            <td class="field">Nombre Hotel</td>
			                                            <td>[[dato.nombre_hotel]]</td>
			                                        </tr>
			                                        <tr class="divider">
			                                            <td colspan="2"></td>
			                                        </tr>
			                                        <tr>
			                                            <td class="field">Telefono 1</td>
			                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> <a href="tel:[[dato.telefono_hotel]] ">[[dato.telefono_hotel]] <a></td>
			                                        </tr>
			                                        <tr>
			                                            <td class="field">Telefono 2</td>
			                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> <a href="tel:[[dato.telefono_hotel_2]] "> [[dato.telefono_hotel_2]]  <a></td>
			                                        </tr>
			                                        <tr class="highlight">
			                                            <td class="field">Estado</td>
			                                            <td>[[dato.estado]] </td>
			                                        </tr>
			                                        <tr class="highlight">
			                                            <td class="field">Direccion</td>
			                                            <td>[[dato.direccion_hotel]] </td>
			                                        </tr>
			                                        <tr class="highlight">
			                                            <td class="field" >Servicios</td>	
			                                            <td>
			                                            	<div class="services" ng-repeat="servicio in dato.id_tipo_servicio">
			                                            		<h4><span class="label label-default">[[servicio]]</span></h4>
			                                            	</div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td class="field">Categoria</td>
			                                            <td>
		                                                	<small>
		                                                		<fieldset class="rating">		    
																    <input type="radio" id="star5" name="i_categoria" value="5" ng-model="dato.categoria_hotel" disabled/><label for="star5" title="Rocks!">5 stars</label>
																    <input type="radio" id="star4" name="i_categoria" value="4" ng-model="dato.categoria_hotel" disabled/><label for="star4" title="Pretty good">4 stars</label>
																    <input type="radio" id="star3" name="i_categoria" value="3" ng-model="dato.categoria_hotel" disabled/><label for="star3" title="Meh">3 stars</label>
																    <input type="radio" id="star2" name="i_categoria" value="2" ng-model="dato.categoria_hotel" disabled/><label for="star2" title="Kinda bad">2 stars</label>
																    <input type="radio" id="star1" name="i_categoria" value="1" ng-model="dato.categoria_hotel" disabled/><label for="star1" title="Sucks big time">1 star</label>	
																</fieldset>
			                                                </small>
			                                            </td>

			                                        </tr>
			                                        <tr class="divider">
			                                            <td colspan="2"></td>
			                                        </tr>
			                                    </tbody>
			                                </table>
			                            </div>
			                            <!-- end table -->
			                        </div>
			                        <!-- end profile-info -->
			                    </div>
			                    <!-- end profile-right -->
			                </div>
			                <!-- end profile-section -->
			            </div>

                    	<div class="well">
							<center>
								<a href="{{ url ('/hoteles/agr') }}" class="btn btn-success">
									<i class="fa fa-plus-square"></i> Agregar Nuevo Hotel
								</a>
							</center>
                    	</div>

                    </div>
               
                </div>

            </div>

		</div>

	</div>
	
@endsection
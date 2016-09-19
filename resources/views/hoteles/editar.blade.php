@extends('base')

@section('controller')
	<script src="{{ asset('/js/controllers/hoteles/agregar_hotel.js') }}"></script>
@endsection

@section('content')
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed"  ng-controller="AgregarHotelesController">
	
	@include('layouts/navbar')

	@include('layouts/sidebar')
		
		<!-- begin #content -->
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
										    </a><a href="#" class="hidden-phone"><small>Agregue habitaciones disponibles en el hotel.</small></a><a href="#step3" class="hidden-phone">
										</a></li>
										<li role="tab" aria-selected="false" style="z-index: 1;"><span class="label">4</span><a href="#step4" class="hidden-phone">
										    Regimen
										    </a><a href="#" class="hidden-phone"><small>Asocie tipos de planes al hotel ingresado.</small></a><a href="#step4" class="hidden-phone">
										</a></li>
									</ol>
	                        </div>
	                        <br>
	                        <div class="well">
	                            
								<form class="form-horizontal" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" enctype="multipart/form-data" novalidate>

									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									
									<div class="form-group">
						                <label class="col-md-3 control-label">Nombre</label>
						                <div class="col-md-7">
						                    <input type="text" maxlength="100" class="form-control" placeholder="Nombre del Hotel" name="i_nombre" value="{{$dato->nombre_hotel}}" required>
						                </div>
						            </div>

						            <div class="form-group">
						                <label class="col-md-3 control-label">Telefono</label>
						                <div class="col-md-7">
						                    <input type="text" maxlength="20" class="form-control" placeholder="0212-1234567" name="i_telefono" required>
						                </div>
						            </div>

						            <div class="form-group">
						                <label class="col-md-3 control-label">Otro Telefono</label>
						                <div class="col-md-7">
						                    <input type="text" maxlength="20" class="form-control" placeholder="0212-1234567" name="i_telefono2" required>
						                </div>
						            </div>

						            <div class="form-group">
						                <label class="col-md-3 control-label">Estado</label>
						                <div class="col-md-7">
						                    <select class="form-control m-bot15" name="s_estado">
									            @foreach($estados as $key)
													<option class="option" value="{{ $key->id_tipo }}">{{ $key->nombre_tipo }} </option>;
												@endforeach
											</select>
						                </div>
						            </div>
									
									<div class="form-group">
						                <label class="col-md-3 control-label">Dirección</label>
						                <div class="col-md-7">
						                    <textarea class="form-control" placeholder="Dirección del Hotel" rows="5" name="i_direccion"  required></textarea>
						                </div>
						            </div>

						            <div class="form-group">
								        <label class="col-md-3 control-label">Servicios que ofrece el Hotel</label>
								        <div class="col-md-7">
											<select name="s_servicios" size="2" class="js-example-placeholder-multiple js-states form-control" multiple="multiple"></select>
									      	<select class="js-source-states">
									        	@foreach($servicio as $key)
													<option class="option" value="{{ $key->id_tipo }}" >{{ $key->nombre_tipo }} </option>;
												@endforeach
									      	</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label">Indique La Categoria del hotel a registrar</label>
										<div class="col-md-7">
										<fieldset class="rating">		    
										    <input type="radio" id="star5" name="i_categoria" value="5" /><label for="star5" title="Rocks!">5 stars</label>
										    <input type="radio" id="star4" name="i_categoria" value="4" /><label for="star4" title="Pretty good">4 stars</label>
										    <input type="radio" id="star3" name="i_categoria" value="3" /><label for="star3" title="Meh">3 stars</label>
										    <input type="radio" id="star2" name="i_categoria" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
										    <input type="radio" id="star1" name="i_categoria" value="1" /><label for="star1" title="Sucks big time">1 star</label>	
										</fieldset>
										</div>
									</div>

									<div class="form-group last">
	                                    <label class="control-label col-md-3">Imagen de Principal</label>
	                                    <div class="col-md-9">
	                                        
	                                        <div class="fileinput fileinput-new" data-provides="fileinput">
											  	<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
											    	<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="...">
											  	</div>
											  	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
										  		<div>
										    		<span class="btn btn-success btn-file">
										    			<span class="fileinput-new"><i class="fa fa-picture-o"></i> Select image</span>
										    			<span class="fileinput-exists"><i class="fa fa-undo"></i> Change</span>
										    			<input type="file" name="i_imagen">
										    		</span>
										    		<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash"></i>Remove</a>
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
		                    <!-- end panel -->
		                </div>
		                <!-- end col-6 -->
		            </div>
				</div>
			</div>
		</div>
	@include('modals/validacion_modal')
	</div>
	
@endsection
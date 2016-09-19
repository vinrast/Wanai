@extends('base')

@section('content')
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

	@include('layouts/navbar')

	@include('layouts/sidebar')

	<!-- begin #content -->
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

		<!-- begin breadcrumb -->
				
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><i class="fa fa-ticket"></i> Registro de Boletos Finalizado</h1>
		<!-- end page-header -->
		<!-- begin row -->

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
                        <h4 class="panel-title">Formulario Registro de Boletos Finalizado</h4>
                    </div>

                    <div class="panel-body">
						<div id="wizard" class="bwizard clearfix">
							<ol class="bwizard-steps clearfix clickable" role="tablist">
								<li role="tab" aria-selected="true" class="active" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="#step1" class="hidden-phone">
								    Información del Boleto 
								    </a><a href="#" class="hidden-phone"><small>Ingrese la información correspodiente al Boleto.</small></a><a href="#step1" class="hidden-phone">
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

                        <blockquote class="f-s-14">
                        	<p>File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery.<br>
                            Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
                            Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.</p>
                    	</blockquote>
						
						<div class="well">
							@foreach($datos as $dato)
								<section id="pricing-table">
						            <div class="">
						                <div class="row">
						                    <div class="pricing">
						                    	<div class="col-md-3 col-sm-12 col-xs-12"></div>
						                        <div class="col-md-6 col-sm-12 col-xs-12">
						                            <div class="pricing-table">
						                                <div class="pricing-header">
						                                    <p class="pricing-title"><i class="fa fa-plane"></i> {{$dato->nombre_aerolinea}}</p>
						                                    <h3 class="pricing-rate-name">Adulto</h3>
						                                    <p class="pricing-rate"><sup>$</sup> {{$dato->costo_boleto_adulto}} <span>/Bs.</span></p>
						                                    <h3 class="pricing-rate-name">Infane</h3>
						                                    <p class="pricing-rate"><sup>$</sup> {{$dato->costo_boleto_infante}} <span>/Bs.</span></p>
						                                    <h3 class="pricing-rate-name">Bebe</h3>
						                                    <p class="pricing-rate"><sup>$</sup> {{$dato->costo_boleto_bebe}} <span>/Bs.</span></p>
						                                    <a href="#" class="btn btn-custom">BOLETO</a>
						                                </div>

						                                <div class="pricing-list">
						                                    <ul>
						                                        <li><i class="fa fa-globe"></i> Origen <span>{{$dato->origen}}</span></li>
						                                        <li><i class="fa fa-globe"></i> Destino <span>{{$dato->destino}}</span></li>
						                                        <li><i class="fa fa-calendar"></i> Fecha de Salida <span>{{$dato->fecha_salida_boleto}}</span></li>
						                                        <li><i class="fa fa-ticket"></i> Cantidad de Boletos <span>{{$dato->cantidad_boleto}}</span></li>
						                                    </ul>
						                                </div>
						                            </div>
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </section>
							@endforeach
						</div>
						
                    	<div class="well">
							<center>
								<a href="{{ url ('/boletos/agr') }}" class="btn btn-success">
									<i class="fa fa-plus-square"></i> Agregar Nuevo boleto
								</a>
							</center>
                    	</div>

	                </div>
	            </div>
			</div>
		</div>
	</div>

@endsection

@extends('base')

@section('content')
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="BoletosController">

	@include('layouts/navbar')

	@include('layouts/sidebar')

		<!-- begin #content -->
		<div id="content" class="content">
				
			<ol class="breadcrumb pull-right">
				<li><a href="{{ url ('/paquetes/agr') }}">Agregar</a></li>
				<li><a href="{{ url ('/paquetes/listar') }}">Gestionar</a></li>
			</ol>

			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><i class="fa fa-plane"></i> Paquetes </h1>
			<!-- end page-header -->
			<!-- begin row -->

			<div class="row">
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6 button-index">
			        <a href="{{ url ('/paquetes/agr') }}" style="text-decoration:none;">
				        <div class="widget widget-stats bg-green">
				            <div class="stats-icon stats-icon-lg"><i class="fa fa-plus-square fa-fw"></i></div>
				            <div class="stats-title">Paquetes</div>
				            <div class="stats-number">Agregar</div>
				            <div class="stats-progress progress">
	                            <div class="progress-bar" style="width: 100%;"></div>
	                        </div>
	                        <div class="stats-desc"></div>
	                        <div class="stats-desc">Clicke para agregar los Paquetes.</div>
				        </div>
			        </a>
			    </div>
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
				    <a href="{{ url ('/paquetes/listar') }}" style="text-decoration:none;">
				        <div class="widget widget-stats bg-blue">
				            <div class="stats-icon stats-icon-lg"><i class="fa fa-pencil-square-o fa-fw"></i></div>
				            <div class="stats-title">Paquetes</div>
				            <div class="stats-number">Gestionar</div>
				            <div class="stats-progress progress">
	                            <div class="progress-bar" style="width: 100%;"></div>
	                        </div>
	                        <div class="stats-desc"></div>
	                        <div class="stats-desc">Clicke para editar los Paquetes.</div>
				        </div>
				    </a>
			    </div>
			    <!-- end col-3 -->
			</div>

<!--@foreach($paquetes as $paquete)
{{$paquete->cantidad_reservados}}
{{$paquete->nombre_paquete}}<br>
@endforeach
-->
	
		</div>
	</div>

@endsection
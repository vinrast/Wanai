@extends('base')

@section('content')
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		
	@include('layouts/navbar')

	@include('layouts/sidebar')

		<!-- begin #content -->
		<div id="content" class="content">

			<ol class="breadcrumb pull-right">
				<li><a href="{{ url ('/hoteles/agr') }}">Agregar</a></li>
				<li><a href="{{ url ('/hoteles/listar') }}">Gestionar </a></li>
			</ol>
			
			<h1 class="page-header"><i class="fa fa-bed"></i> Hoteles </h1>

			<div class="row">
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6 button-index">
			        <a href="{{ url ('/hoteles/agr') }}" style="text-decoration:none;">
				        <div class="widget widget-stats bg-green">
				            <div class="stats-icon stats-icon-lg"><i class="fa fa-plus-square fa-fw"></i></div>
				            <div class="stats-title">Hoteles</div>
				            <div class="stats-number">Agregar</div>
				            <div class="stats-progress progress">
	                            <div class="progress-bar" style="width: 100%;"></div>
	                        </div>
	                        <div class="stats-desc"></div>
	                        <div class="stats-desc">Clicke para agregar los hoteles.</div>
				        </div>
			        </a>
			    </div>

			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
				    <a href="{{ url ('/hoteles/listar') }}" style="text-decoration:none;">
				        <div class="widget widget-stats bg-blue">
				            <div class="stats-icon stats-icon-lg"><i class="fa fa-pencil-square-o fa-fw"></i></div>
				            <div class="stats-title">Hoteles</div>
				            <div class="stats-number">Gestionar</div>
				            <div class="stats-progress progress">
	                            <div class="progress-bar" style="width: 100%;"></div>
	                        </div>
	                        <div class="stats-desc"></div>
	                        <div class="stats-desc">Clicke para editar los hoteles.</div>
				        </div>
				    </a>
			    </div>
			    <!-- end col-3 -->
			</div>
		
			<!--
				@Foreach ($habitacion as $valor)
					cantidad de habitaciones:{{$valor->cantidad_habitaciones}}<br>
					Id del hotel:{{$valor->id_hotel}}<br>
					Nombre del hotel:{{$valor->nombre_hotel}}<br>
				@endforeach
			    
			    @Foreach ($hotel as $valor)
					Fecha del registro:{{$valor->fecha_registro_hotel}}<br>
					cantidad de hoteles:{{$valor->cantidad_hotel}}<br>
				@endforeach 
			-->
			
		</div>

	</div>
	
@endsection
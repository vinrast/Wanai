@extends('base-cliente')

@section('controller')
    <script src="{{ asset('/js/controllers/cliente/cliente_hoteles.js') }}"></script>
@endsection

@section('content')
	
	<div id="page-container" class="fade" ng-controller="HotelesClienteController">
    	<div ng-init="hotel={{$data}}"></div>
    	<div ng-init="tipo_servicios=hotel.id_tipo_servicio.split(',');"></div>
    	<div ng-init="url_root='{{ url('') }}'"></div>
    	<div ng-init="habitaciones={{$habitaciones}}"></div>
		@include('layouts/navbar-cliente')
		
		<!-- begin #contact -->
	    <div class="content bg-silver-lighter">
	        <!-- begin container -->
	        <div class="container">
	            <br><br>
				<section id="photostack-1" class="photostack">
					@if($galeria)
					<div>
						@foreach($galeria as $gallery)	
						<figure ng-click='ampliar_imagen("{{$gallery->url_imagen}}")'>
							<a  class="photostack-img" ><img src="{{ url('/uploads/hoteles/img_high/'.$gallery->url_imagen)}}" alt="img01"/></a>
							<figcaption>
								<h2 class="photostack-title limite-text-img">[[ hotel.nombre_hotel ]]</h2>
							</figcaption>
						</figure>
						@endforeach
						@if($video->first())
						<figure ng-click='ampliar_video("{{$video->first()->url_imagen}}")'>
							<a  class="photostack-img" ><img src="{{url('/img/youtube.png') }}" alt="img01"/></a>
							<figcaption>
								<h2 class="photostack-title">Video</h2>
							</figcaption>
						</figure>
						@endif						
						<figure data-dummy>
						<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img1"/></a>
						<figcaption>
							<h2 class="photostack-title">WanaiTravel</h2>
						</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img2"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img3"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img4"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img5"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img6"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img7"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img8"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img9"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
						<figure data-dummy>
							<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img10"/></a>
							<figcaption>
								<h2 class="photostack-title">WanaiTravel</h2>
							</figcaption>
						</figure>
					</div>
					@endif
				</section>
				
				<br></br>

				<ul class="result-list">
                    <li>
                        <div class="result-image" ng-click='ampliar_imagen(hotel.url_imagen_hotel)'>
                            <a href="javascript:;" ><img src="{{url('/uploads/hoteles/img_mid')}}/[[hotel.url_imagen_hotel]]" alt=""></a>
                        </div>
                        <div class="result-info">
                            <h4 class="title">[[ hotel.nombre_hotel ]]</h4>
                            <p class="location"><i class="fa fa-phone"></i> [[hotel.telefono_hotel]]</p>
                            <p class="desc">
                                [[ hotel.direccion_hotel ]]
                            </p>
                            <div class="btn-row">
	                            <div class="services" ng-repeat="servicio in tipo_servicios">
	                                <h4><span class="label label-default ng-binding">[[servicio]]</span></h4>
	                            </div>
	                        </div>
                            <div class="btn-row">
                                <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics" data-original-title="" title=""><i class="fa fa-fw fa-bed"></i></a>
                                <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Tasks" data-original-title="" title=""><i class="fa fa-fw fa-desktop"></i></a>
                                <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Configuration" data-original-title="" title=""><i class="fa fa-fw fa-coffee"></i></a>
                                <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Performance" data-original-title="" title=""><i class="fa fa-fw fa-wifi"></i></a>
                                <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Users" data-original-title="" title=""><i class="fa fa-fw fa-gamepad"></i></a>
                                <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Users" data-original-title="" title=""><i class="fa fa-fw fa-cutlery"></i></a>
                            </div>
                        </div>
                        <div class="result-price">
                            <div class="start-hotel-cliente">
	                            <fieldset class="rating" >		    
								    <input type="radio" id="star5" name="i_categoria" value="5" ng-model="hotel.categoria_hotel" disabled/><label for="star5">5 stars</label>
								    <input type="radio" id="star4" name="i_categoria" value="4" ng-model="hotel.categoria_hotel" disabled/><label for="star4">4 stars</label>
								    <input type="radio" id="star3" name="i_categoria" value="3" ng-model="hotel.categoria_hotel" disabled/><label for="star3">3 stars</label>
								    <input type="radio" id="star2" name="i_categoria" value="2" ng-model="hotel.categoria_hotel" disabled/><label for="star2">2 stars</label>
								    <input type="radio" id="star1" name="i_categoria" value="1" ng-model="hotel.categoria_hotel" disabled/><label for="star1">1 star</label>											    
								</fieldset>
							</div>
							[[ hotel.nombre_hotel ]] 
                        </div>
                    </li>
					<br><br>
                    <li>
                    	<br>
                        <center>
                        	<h4 class="title"><a href="javascript:;">Habitaciones</a></h4>
                        </center>
                        <br>
                        <ul class="timeline">
						    <li ng-repeat="habitacion in habitaciones">
						        <!-- begin timeline-time -->
						        <div class="timeline-time">
						            <span class="date">[[habitacion.nombre_habitacion]]</span>
						        </div>
						        <!-- end timeline-time -->
						        <!-- begin timeline-icon -->
						        <div class="timeline-icon">
						            <a href="javascript:;"><i class="fa fa-bed"></i></a>
						        </div>
						        <!-- end timeline-icon -->
						        <!-- begin timeline-body -->
						        <div class="timeline-body timeline-body-custon">
						            <div class="timeline-header">
						                <span class="username">[[habitacion.nombre_habitacion]]</span>
						                <span class="pull-right text-muted">[[habitacion.costo_habitacion]] <i class="fa fa-usd"></i></span>
						            </div>
						            <div class="timeline-content">
			                            <p class="lead">
			                                <i class="fa fa-quote-left fa-fw pull-left"></i>
			                                [[habitacion.descripcion_habitacion]]
			                                <i class="fa fa-quote-right fa-fw pull-right"></i>
			                            </p>
			                        </div>
						        </div>
						        <!-- end timeline-body -->
						    </li>
							<br>
						</ul>
                        
                    </li>
                </ul>
				<br><br>

				<center>
					<a type="button" href="{{ url('/hoteles/cotizar/'.$id) }}" class="btn btn-success m-r-5 m-b-5">COTIZAR</a>
				</center>

			</div>
			@include('modals/modal_imagen')
			@include('modals/modal_video')
		</div>
		@include('layouts/footer-cliente')
	</div>

@endsection
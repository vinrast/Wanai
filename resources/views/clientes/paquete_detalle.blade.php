@extends('base-cliente')

@section('controller')
    <script src="{{ asset('/js/controllers/cliente/cliente_paquetes.js') }}"></script>
@endsection

@section('content')
	
<div id="page-container" class="fade" ng-controller="PaquetesClienteController">
    <div ng-init="paquete={{$data}}"></div>
    <div ng-init="url_root='{{ url('') }}'"></div>
	@include('layouts/navbar-cliente')
	<!-- begin #contact -->
    <div class="content bg-silver-lighter">
        <!-- begin container -->
        <div class="container">
            <br><br>

            <section id="photostack-1" class="photostack">
				<div>
					@foreach($galeria as $gallery)	
					<figure ng-click='ampliar_imagen("{{$gallery->url_imagen}}")'>
						<a href="#" class="photostack-img"><img src="{{ url('/uploads/paquetes/img_high/'.$gallery->url_imagen)}}" alt="img01"/></a>
						<figcaption>
							<h2 class="photostack-title limite-text-img">[[ paquete.nombre_paquete ]]</h2>
						</figcaption>
					</figure>
					@endforeach
					@if($video->first())
					<figure ng-click='ampliar_video("{{$video->first()->url_imagen}}")'>
						<a  class="photostack-img" ><img src="{{url('/img/youtube.png') }}" alt="youtube01"/></a>
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
					<figure data-dummy>wanai-dummy.jpg
						<a href="#" class="photostack-img"><img src="{{url('/img/wanai-dummy.jpg') }}" alt="img10"/></a>
						<figcaption>
							<h2 class="photostack-title">WanaiTravel</h2>
						</figcaption>
					</figure>
				</div>
			</section>
			
			<br></br>

			<div class="well-info-boleto">
                        	
            	<ul class="result-list">
                    <li>
                        <div class="result-info">
                            <h4 class="title"><a href="javascript:;" class="ng-binding">[[ paquete.nombre_paquete ]]</a></h4>
                            <p class="location ng-binding"><i class="fa fa-calendar"></i> Salida  [[ paquete.fecha_inicio_paquete ]]</p>
                            <p class="location ng-binding"><i class="fa fa-calendar"></i> Retorno [[ paquete.fecha_final_paquete ]]</p>
                            <p class="desc ng-binding">
                            	[[ paquete.descripcion_paquete ]]
                            </p>
                            <div class="btn-row">
                                <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics" data-original-title="" title=""><i class="fa fa-car"></i></a>
                            	<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics" data-original-title="" title=""><i class="fa fa-cutlery"></i></a>
                            </div>
                        </div>
                        <div class="result-price ng-binding">
                            [[ paquete.costo_paquete ]] Bs <small>COSTO</small>
                        </div>
                    </li>
                </ul>
        
        	</div>
            
            <br><br>

			<center>
				<a type="button" href="{{ url('/paquetes/cotizar/'.$id) }}" class="btn btn-success m-r-5 m-b-5">COTIZAR</a>
			</center>
			@include('modals/modal_imagen')
			@include('modals/modal_video')
        </div>
        <!-- end container -->
    </div>
    <!-- end #contact -->
	
	@include('layouts/footer-cliente')

</div>

@endsection

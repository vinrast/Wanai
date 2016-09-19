@extends('base-cliente')

@section('controller')
    <script src="{{ asset('/js/controllers/cliente/cliente_hoteles.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade" ng-controller="HotelesClienteListarController">
    
	@include('layouts/navbar-cliente')
	
	<!-- begin #contact -->
    <div class="content bg-silver-lighter">
        <!-- begin container -->
        <div class="container">
            <br>
            <div id="gallery" class="gallery isotope" style="position: relative; overflow: hidden; height: 1047px;">
                @foreach($data as $hotel)
                <div class="image gallery-group-1 isotope-item" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1); opacity: 1;">
                    <div class="image-inner">
                        <a href="{{ url('hoteles/detalle/'.$hotel->id_hotel)}}">
                            <img src="{{ url('/uploads/hoteles/img_mid/'.$hotel->url_imagen_hotel)}}" alt="">
                        </a>
                        <p class="image-caption">
                            <i class="fa fa-bed"></i> {{ $hotel->nombre_hotel }}
                        </p>
                    </div>
                    <div class="image-info">
                        <a href="{{ url('hoteles/detalle/'.$hotel->id_hotel)}}">
                            <h5 class="title">{{ $hotel->nombre_hotel }}</h5>
                        </a>
                        <div class="pull-right">
                            <small><i class="fa fa-phone"></i></small> <a href="javascript:;">{{ $hotel->telefono_hotel }}</a>
                        </div>
                        <div class="rating">
                            <span class="star active" ng-repeat="n in [] | range:{{ $hotel->categoria_hotel }}"></span>
                            <span class="star" ng-repeat="n in [] | range:5-{{ $hotel->categoria_hotel }}"></span>
                        </div>
                        <br>
                        <br>
                        <div class="desc">
                            {{ $hotel->direccion_hotel }}
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <center>
                <?php echo $data->render(); ?>
            </center>
        </div>
        <!-- end container -->
    </div>
    <!-- end #contact -->
	
	@include('layouts/footer-cliente')

</div>
@endsection
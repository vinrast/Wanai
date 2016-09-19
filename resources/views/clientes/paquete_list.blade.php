@extends('base-cliente')

@section('controller')
    <script src="{{ asset('/js/controllers/cliente/cliente_paquete.js') }}"></script>
@endsection

@section('content')
	
<div id="page-container" class="fade">
    
	@include('layouts/navbar-cliente')
	
	<!-- begin #contact -->
    <div class="content bg-silver-lighter">
        <!-- begin container -->
        <div class="container">
            <br><br>
            <ul class="result-list">
                @foreach($data as $paquetes)
                <li >
                    <div class="result-image">
                        <a href="javascript:;"><img src="{{ url('/uploads/paquetes/img_high/'.$paquetes->getImagen())}}" alt=""></a>
                    </div>
                    <div class="result-info">
                        <h4 class="title"><a href="javascript:;">{{$paquetes->nombre_paquete}}</a></h4>
                        <p class="location"> Fecha Inicio {{$paquetes->fecha_inicio_paquete}}</p>
                        <p class="desc">
                            {{$paquetes->descripcion_paquete}} 
                        </p>
                        <div class="btn-row">
                            <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics" data-original-title="" title=""><i class="fa fa-car"></i></a>
                            <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics" data-original-title="" title=""><i class="fa fa-cutlery"></i></a>
                        </div>
                    </div>
                    <div class="result-price">
                        {{$paquetes->costo_paquete}} Bs <small>COSTO</small>
                        <a href="{{url ('paquetes/detalle/'.$paquetes->id_paquete)}}" class="btn btn-inverse btn-block">Ver Detalle</a>
                    </div>
                </li>
                @endforeach
            </ul>

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
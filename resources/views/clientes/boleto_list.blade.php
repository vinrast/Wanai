@extends('base-cliente')

@section('controller')
    <script src="{{ asset('/js/controllers/cliente/cliente_boletos.js') }}"></script>
@endsection

@section('content')
	
<div id="page-container" class="fade" ng-controller="BoletosClienteController">
    
	@include('layouts/navbar-cliente')

	<!-- begin #contact -->
    <div class="content bg-silver-lighter">
        <!-- begin container -->
        <div class="container">
            <br><br> 
            <div class="row">
                @foreach($data as $boleto)
                <div class="col-lg-6">
                    <ul class="list-group list-group-lg no-radius list-email col">
                        <li class="list-group-item inverse">
                            <a href="{{url ('boletos/detalle/'.$boleto->id_boleto)}}" class="email-user">
                                <i class="fa fa-plane"></i>
                            </a>
                            <div class="email-info">
                                <span class="email-time">{{ $boleto->fecha_salida_boleto }}</span>
                                <h5 class="email-title">
                                    <a href="{{url ('boletos/detalle/'.$boleto->id_boleto)}}">
                                        {{ $boleto->getAerolinea() }}
                                    </a>
                                    <span class="label label-inverse f-s-10">{{ $boleto->costo_boleto_adulto }}  <i class="fa fa-usd"></i></span>
                                </h5>
                                <p class="email-desc">
                                    Origen: {{ $boleto->getOrigen() }} , Destino: {{ $boleto->getDestino() }}
                                </p>
                            </div>
                        </li>
                    </ul>
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
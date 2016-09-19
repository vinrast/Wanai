@extends('base-cliente')

@section('controller')
    <script src="{{ asset('/js/controllers/cliente/cliente_boletos.js') }}"></script>
@endsection

@section('content')
	
<div id="page-container" class="fade" ng-controller="BoletosClienteController">
    <div ng-init="boleto={{$data}}"></div>
	@include('layouts/navbar-cliente')

	<!-- begin #contact -->
    <div class="content bg-silver-lighter">
        <!-- begin container -->
        <div class="container">
            <br> 
			<div class="well">
				<section id="pricing-table">
		            <div class="">
		                <div class="row">
		                    <div class="pricing">
		                    	<div class="col-md-3 col-sm-12 col-xs-12"></div>
		                        <div class="col-md-6 col-sm-12 col-xs-12">
		                            <div class="pricing-table">
		                                <div class="pricing-header">
		                                    <p class="pricing-title"><i class="fa fa-plane"></i> [[boleto[0].nombre_aerolinea]]</p>
		                                    <h3 class="pricing-rate-name">Adulto</h3>
		                                    <p class="pricing-rate"><sup>$</sup> [[boleto[0].costo_boleto_adulto]] <span>/Bs.</span></p>
		                                    <h3 class="pricing-rate-name">Infane</h3>
		                                    <p class="pricing-rate"><sup>$</sup> [[boleto[0].costo_boleto_infante]] <span>/Bs.</span></p>
		                                    <h3 class="pricing-rate-name">Bebe</h3>
		                                    <p class="pricing-rate"><sup>$</sup> [[boleto[0].costo_boleto_bebe]]<span>/Bs.</span></p>
		                                    <br>
		                                    <label class=" btn-custom">BOLETO</label>
		                                </div>

		                                <div class="pricing-list">
		                                    <ul>
		                                        <li><i class="fa fa-globe"></i> Origen <span>[[boleto[0].estado_origen]]</span></li>
		                                        <li><i class="fa fa-globe"></i> Destino <span>[[boleto[0].estado_destino]]</span></li>
		                                        <li><i class="fa fa-calendar"></i> Fecha de Salida <span>[[boleto[0].fecha_salida_boleto]]</span></li>
		                                        <li><i class="fa fa-ticket"></i> Cantidad de Boletos <span>[[boleto[0].cantidad_boleto]]</span></li>
		                                    </ul>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </section>
			</div>
			<br><br>
			<center>
				<a type="button" href="{{ url('/boletos/cotizar/'.$id) }}" class="btn btn-success m-r-5 m-b-5">COTIZAR</a>
			</center>

        </div>
        <!-- end container -->
    </div>
    <!-- end #contact -->
	
	@include('layouts/footer-cliente')

</div>

@endsection


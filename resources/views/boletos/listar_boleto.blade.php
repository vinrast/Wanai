@extends('base')

@section('controller')
    <script src="{{ asset('/js/controllers/boletos/listar.js') }}"></script>
@endsection


@section('content')
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed" >

    @include('layouts/navbar')

    @include('layouts/sidebar')

        <!-- begin #content -->
        <div id="content" class="content" ng-controller = "ListarBoletosController">

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

                <h1 class="page-header"><i class="fa fa-ticket"></i> Registro de Boletos </h1>

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
                            <h4 class="panel-title">Gestionar</h4>
                        </div>

                        <div class="panel-body">
                            
                            <table class="table">                              
                                <thead>
                                    <tr>
                                        <th class="col-xs-4"><i class="fa fa-calendar"></i> Fecha de Salida</th>
                                        <th class="col-xs-6"><i class="fa fa-cubes"></i> Cantidad </th>
                                        <th class="col-xs-2"><i class="fa fa-money"></i> Costo</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                @foreach($boletos as $boleto)
                                <tbody>
                                    <tr>
                                        <td>{{ $boleto->fecha_salida_boleto }}</td>
                                        <td>{{ $boleto->cantidad_boleto }}</td>
                                        <td>{{ $boleto->costo_boleto }} $</td>
                                        <td><a href="{{url('/boletos/editar/'.$boleto->id_boleto)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil-square-o"></i></i></a></td>
                                        <td><button class="btn btn-sm btn-danger" ng-click="confirmar_del( {{$boleto->id_boleto}} )"><i class="fa fa-trash-o"/></button></td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
        
                            <center>
                                <?php echo $boletos->render(); ?>
                            </center>

                        </div>
                    </div>
                </div>
            </div>
    
            @include('modals/validacion_modal')
            @include('modals/confirmacion_modal') 
        </div>

    </div>
@endsection
            
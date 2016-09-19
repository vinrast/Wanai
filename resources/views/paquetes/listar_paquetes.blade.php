@extends('base')

@section('controller')
    <script src="{{ asset('/js/controllers/paquetes/listar.js') }}"></script>
@endsection


@section('content')

    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

    @include('layouts/navbar')

    @include('layouts/sidebar')

        <div id="content" class="content" ng-controller="ListarPaquetesController">
            <ol class="breadcrumb pull-right">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a href="{{ url ('/paquetes/agr') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
                            <i class="fa fa-plus-square"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="{{ url ('/paquetes/listar') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                    </div>
                </div>
            </ol>
            <h1 class="page-header"><i class="fa fa-ticket"></i> Paquetes </h1>
            <div class="row">
                <div class="col-12 ui-sortable">
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
                                        <th class="col-xs-10"><i class="fa fa-ticket"></i> Nombre</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                @foreach($paquetes as $paquete)
                                    <tbody>
                                        <tr>
                                            <td>{{ $paquete->nombre_paquete}}</td>
                                            <td><a href="{{url('/paquetes/editar/'.$paquete->id_paquete)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil-square-o"></i></i></a></td>
                                            <td><button class="btn btn-sm btn-danger" ng-click="confirmar_del( {{$paquete->id_paquete}} )"><i class="fa fa-trash-o"/></button></td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <center>
                                <?php echo $paquetes->render(); ?>
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
            
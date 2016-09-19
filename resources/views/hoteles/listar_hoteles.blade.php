@extends('base')


@section('controller')
    <script src="{{ asset('/js/controllers/hoteles/listar.js') }}"></script>
@endsection


@section('content')
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    
    @include('layouts/navbar')

    @include('layouts/sidebar')

        <!-- begin #content -->
        <div id="content" class="content" ng-controller= "ListarHotelesController">

            <ol class="breadcrumb pull-right">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a href="{{ url ('/hoteles/agr') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
                            <i class="fa fa-plus-square"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="{{ url ('/hoteles/listar') }}" class="btn btn-white btn-sm p-l-20 p-r-20">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                    </div>
                </div>
            </ol>

            <h1 class="page-header"><i class="fa fa-bed"></i> Gestiona Hoteles </h1>

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
                            <h4 class="panel-title">Hoteles</h4>
                        </div>

                        <div class="panel-body">
                            
                            <table class="table">                              
                                <thead>
                                    <tr>
                                        <th class="col-xs-4"><i class="fa fa-bed"></i> Nombre</th>
                                        <th class="col-xs-6"><i class="fa fa-map-marker"></i> Dirección</th>
                                        <th class="col-xs-2"><i class="fa fa-phone"></i> Telefono</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                @foreach($hoteles as $hotel)
                                <tbody>
                                    <tr>
                                        <td>{{ $hotel->nombre_hotel }}</td>
                                        <td>{{ $hotel->direccion_hotel }}</td>
                                        <td>{{ $hotel->telefono_hotel }}</td>
                                        <td><a href="{{url('/hoteles/editar/'.$hotel->id_hotel)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil-square-o"></i></i></a></td>
                                        <td><button class="btn btn-sm btn-danger" ng-click="confirmar_del( {{$hotel->id_hotel}} )"><i class="fa fa-trash-o"/></button></td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
        
                            <center>
                                <?php echo $hoteles->render(); ?>
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
            
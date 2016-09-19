@extends('base')

@section('controller')
    <script src="{{ asset('/js/controllers/paquetes/agregar_imagen.js') }}"></script>
@endsection

@section('content')
    

<div ng-controller="uploadManyFiles">
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="CtrlImg">

    @include('layouts/navbar')

    @include('layouts/sidebar')
        <div id="content" class="content">
            
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

            <h1 class="page-header"><i class="fa fa-bed"></i> Registrar Imágenes del Paquete </h1>
            <div>
                <div class="row" >
                        <div class="col-12 ui-sortable">
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
                                    </div>
                                    <h4 class="panel-title">Formulario Registro de Imágenes</h4>
                                </div>

                                <div class="panel-body">
                                    <div id="wizard" class="bwizard clearfix">
                                        <ol class="bwizard-steps clearfix clickable" role="tablist">
                                            <li role="tab" aria-selected="false" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="#step1" class="hidden-phone">
                                                Información Básica
                                                </a><a href="#" class="hidden-phone"><small>Ingrese la información básica correspodiente a su hotel.</small></a><a href="#step1" class="hidden-phone">
                                            </a></li>
                                            <li role="tab" aria-selected="true" class="active" style="z-index: 3;"><span class="label">2</span><a href="#step2" class="hidden-phone">
                                                Carga de Imágenes
                                                </a><a href="#" class="hidden-phone"><small>Registre todas las imágenes necesarias para su hotel.</small></a><a href="#step2" class="hidden-phone">
                                            </a></li>
                                        </ol>
                                    </div>
                                    <br>

                                    <div ng-init="inicializar_objetos( {{ $data }}, '{{url('/uploads/paquetes/img_mid/')}}' )"></div>
                                    <div class="well-custon">
                                        <center>
                                            <button type="button" class="btn btn-success" ng-click="agregar()">
                                                <i class="fa fa-plus"></i>
                                                <span>Agregar imagen adicional</span>
                                            </button>
                                            <button type="button" class="btn btn-success" ng-click="agregar_video()">
                                                <i class="fa fa-plus"></i>
                                                <span>Agregar video</span>
                                            </button>                                            
                                        </center>
                                        <br>
                                        <div class="row">
                                            <form action="agregar-habitacion" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value = "{{csrf_token()}}"/>
                                                <div class="col-lg-3 col-md-4 col-xs-6 thumb" ng-show="video_agregado">
                                                    <div class="thumbnail" href="#">
                                                        <iframe class="youtube-player video-youtube" type="text/html" width="385" height="164" ng-src="[[processvideo]]" allowfullscreen frameborder="0"></iframe>
                                                        <div class="btn-group-sm">
                                                            <button type="button" class="btn btn-danger" ng-click="confirmacion_eliminar_video()">
                                                                <i class="fa fa-trash"></i> Borrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-xs-6 thumb" ng-repeat="objeto in objetos">
                                                    <div class="thumbnail" href="#">
                                                        <img class="img-responsive img-responsive-custon" ng-src="[[objeto.img]]" alt="">
                                                        <br>
                                                        <div class="btn-group-sm">
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" ng-click="actualizar($index)" ng-disabled="objeto.cargando">
                                                                <span ng-show="objeto.cargando" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
                                                                <i class="fa fa-picture-o"></i>
                                                                Seleccionar
                                                            </button>
                                                            <button type="button" class="btn btn-danger" ng-click="confirmacion_eliminar($index)">
                                                                <i class="fa fa-trash"></i> Borrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="cantidad" value="[[cantidad]]"/>
                                            </form>
                                        </div>

                                       <div class="row">
                                            <center>
                                                <button type="button" class="btn btn-success m-r-5" ng-click="send()">
                                                    Siguiente <i class="fa fa-chevron-right"></i>
                                                </button>
                                            </center>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @include('modals/upload_image')
            @include('modals/upload_video')
            @include('modals/validacion_modal')
            @include('modals/confirmacion_modal')
            </div>
        </div>
</div>
@endsection
            
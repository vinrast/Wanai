'use stric'

coreApp.controller('CtrlImg', function ($scope, $window, ajax, $log, $rootScope, registro_service, $sce) {

    $scope.file                 = null;
    $scope.myImage              = '';
    $rootScope.myCroppedImage   = '';

    var handleFileSelect = function (evt) {
        var file        = evt.currentTarget.files[0];
        var reader      = new FileReader();
        reader.onload   = function (evt) {
            $scope.$apply(function ($scope) {
                $scope.myImage = evt.target.result;
            });
        };
        reader.readAsDataURL(file);
    };
    angular.element(document.querySelector('#fileInput')).on('change', handleFileSelect);

    $rootScope.return_img = function(id){

        $rootScope.objetos[id].cargando   = true;
        registro_service.Post({img : $scope.srcimg}).$promise.then(
            function(data) {
                if (data.status === "success"){
                    $rootScope.objetos[id].cargando      = false;
                    $rootScope.objetos[id].img          = $scope.srcimg;
                    $rootScope.objetos[id].url_imagen   = data.name;
                    angular.element("#myModal").modal("hide");

                    var input = angular.element("#fileInput");
                    angular.element("#fileInput").replaceWith(input.val('').clone(true));
                    console.log($scope.myImage);
                    $scope.myImage = '';

                }else{
                    $scope.titulo = "Error (5001)";
                    $scope.mensaje = "Disculpe, intente seleccionar su imagen nuevamente. Si el error continua contacte a soporte técnico.";
                    $scope.redirecto = function() {
                        $window.location.href = "#";
                    }                    
                    angular.element("#validacion_modal").modal("show");
                }
            },
            //error (400,500)
            function(data) {
                $scope.titulo = "Error (7778)";
                $scope.mensaje = "Disculpe, Intentelo nuevamente. Si el error continua contacte a soporte técnico.";
                $scope.redirecto = function() {
                    $window.location.reload();
                };
                angular.element("#validacion_modal").modal("show");
            }
        );
    };   
});

coreApp.controller('uploadManyFiles', function ($scope, $window, $rootScope, HotelImgService, ajax, $sce) {

    $rootScope.srcimg     = "";
    $rootScope.file       = null;
    $rootScope.img_select = null;
    $scope.cantidad       = 1;
    $scope.video_agregado = false;
    $scope.video_url      = "";
    $rootScope.objetos    = [];

    $scope.inicializar_objetos = function(data, ruta) {
        $rootScope.objetos = data;
        for (i in $rootScope.objetos){
            if ($rootScope.objetos[i]['tipo_archivo_imagen'] == "1"){
                $rootScope.objetos[i]['img'] = ruta + "/" + $rootScope.objetos[i].url_imagen;
                $rootScope.objetos[i]['nuevo'] = false;
                $rootScope.objetos[i]['cargando'] = false;
            }else{
                $scope.video_agregado = true;
                $scope.video_src      = $rootScope.objetos[i].url_imagen
                $scope.processvideo   = $sce.trustAsResourceUrl($rootScope.objetos[i].url_imagen);
                $rootScope.objetos.splice(i, 1);
            }
        };
        console.log($rootScope.objetos);
    }

    $scope.validar_video = function(url) {
        console.log("prueba " + url);
        $scope.video_agregado = true;
        $scope.video_src = url.replace("watch?v=", "v/");
        $scope.processvideo = $sce.trustAsResourceUrl($scope.video_src);
        angular.element("#myModal_video").modal("hide");
    }

    $scope.agregar_video = function() {
        if (!$scope.video_agregado){
            angular.element("#myModal_video").modal("show");
        }else{
            $scope.mensaje = "Solo se permite agregar un video.";
            $scope.titulo = "Disculpe!";
            angular.element("#validacion_modal").modal("show");
            $scope.redirecto    = function(){
                angular.element("#validacion_modal").modal("hide");
            }
        }
    }


    $scope.agregar = function () {
        if ($scope.cantidad <= 5){
            $scope.cantidad += 1;
            $rootScope.objetos.push({
                                     img        :'/img/no-imagen.jpg',
                                     url_imagen : null,
                                     nuevo      : true,
                                     cargando   : false,
                                     
                            });
        }else{
            $scope.mensaje = "Solo se permite agregar 5 imagenes.";
            $scope.titulo = "Disculpe!";
            angular.element("#validacion_modal").modal("show");
            $scope.redirecto    = function(){
                angular.element("#validacion_modal").modal("hide");
            }

        }
    };

    $scope.confirmacion_eliminar_video = function() {
        $scope.mensaje_m_confirmacion = "¿Realmente desea eliminar el video?";
        $scope.titulo_m_confirmacion = "Confirmación";
        $scope.ejecutar = $scope.eliminar_video;
        angular.element("#ModalConfimacion").modal("show");           
    }

    $scope.eliminar_video = function() {
        json = { nombre : $scope.video_src }
        ajax.Post("/paquetes/posteliminarimagen", json ).$promise.then(
            function(data) {
                console.log(data);
                if (data.success){
                    console.log("correcto");
                    $scope.video_agregado = false;
                }else{
                    console.log("incorrecto");
                    $scope.titulo       = data.titulo;
                    $scope.mensaje      = data.mensaje;
                    $scope.redirecto    = function(){
                        //$route.reload();
                        $window.location.href = data.redirecto;
                    }
                    angular.element("#validacion_modal").modal("show");
                }
                angular.element("#ModalConfimacion").modal("hide");                
            },
            //error (400,500)
            function(data) {
                $scope.titulo = "Error (7776)";
                $scope.mensaje = "Disculpe, Intentelo nuevamente. Si el error continua contacte a soporte técnico.";
                $scope.redirecto = function() {
                    $window.location.reload();
                } 
                angular.element("#validacion_modal").modal("show");
            }
        );
    }

    $scope.confirmacion_eliminar = function(id) {
        console.log($rootScope.objetos[id]);
        if ($rootScope.objetos[id]['url_imagen']){
            $scope.id_por_eliminar = id;
            $scope.mensaje_m_confirmacion = "¿Realmente desea eliminar la imagen?";
            $scope.titulo_m_confirmacion = "Confirmación";
            $scope.ejecutar = $scope.eliminar;
            angular.element("#ModalConfimacion").modal("show");
        }else{
            $scope.cantidad -= 1;
            $rootScope.objetos.splice(id, 1);
        }            
    }

    $scope.eliminar = function() {
        json = { nombre : $rootScope.objetos[$scope.id_por_eliminar].url_imagen }
        ajax.Post("/paquetes/posteliminarimagen", json ).$promise.then(
            function(data) {
                console.log(data);
                if (data.success){
                    console.log("correcto");
                    $scope.cantidad -= 1;
                    $rootScope.objetos.splice($scope.id_por_eliminar, 1);
                }else{
                    console.log("incorrecto");
                    $scope.titulo       = data.titulo;
                    $scope.mensaje      = data.mensaje;
                    $scope.redirecto    = function(){
                        //$route.reload();
                        $window.location.href = data.redirecto;
                    }
                    angular.element("#validacion_modal").modal("show");
                }
                angular.element("#ModalConfimacion").modal("hide");                
            },
            //error (400,500)
            function(data) {
                $scope.titulo = "Error (7776)";
                $scope.mensaje = "Disculpe, Intentelo nuevamente. Si el error continua contacte a soporte técnico.";
                $scope.redirecto = function() {
                    $window.location.reload();
                } 
                angular.element("#validacion_modal").modal("show");
            }
        );
    };

    $rootScope.actualizar = function (id) {
        $rootScope.img_select = id;
    };

    $scope.send = function(){
        var json = {};
        console.log($scope.video_src);
        if ($rootScope.objetos.length != 0){
            var cantidad = 0;
            for ( var i in $rootScope.objetos){
                if ($rootScope.objetos[i].url_imagen){
                    cantidad += 1;
                    json['imagen'+i] = $rootScope.objetos[i].url_imagen;
                }
                if ($rootScope.objetos[i].cargando){
                    $scope.titulo  = "Cargando...";
                    $scope.mensaje = "Hay archivos que aún estan siendo enviandos, por favor espere.";
                    $scope.redirecto = function() {
                        angular.element("#validacion_modal").modal("hide");
                    } 
                    angular.element("#validacion_modal").modal("show");                    
                    return
                }
            }

            if (cantidad == 0){
                $scope.titulo = "Disculpe!";
                $scope.mensaje = "Debe introducir por lo menos una imagen";
                angular.element("#validacion_modal").modal("show");
                return
            }

            if ($scope.video_agregado){
                console.log("agregando video");
                json['video'] = $scope.video_src;
            }

            json['cantidad'] = cantidad;

            ajax.Post("/paquetes/postagregarimagen", json ).$promise.then(
                function(data) {
                    console.log(data);
                    if (data.success){
                        console.log("correcto");
                        $window.location    = data.redirecto;
                    }else{
                        console.log("incorrecto");
                        $scope.titulo       = data.titulo;
                        $scope.mensaje      = data.mensaje;
                        $scope.redirecto    = function(){
                            //$route.reload();
                            $window.location.href = data.redirecto;
                        }
                        angular.element("#validacion_modal").modal("show");
                    }
                },
                //error (400,500)
                function(data) {
                    $scope.titulo = "Error (7776)";
                    $scope.mensaje = "Disculpe, Intentelo nuevamente. Si el error continua contacte a soporte técnico.";
                    $scope.redirecto = function() {
                        $window.location.href = "#"; 
                    } 
                    angular.element("#validacion_modal").modal("show");
                }
            );
        }else{
            $scope.titulo = "Disculpe!";
            $scope.mensaje = "Debe introducir por lo menos una imagen";
            angular.element("#validacion_modal").modal("show");
        };
    };
});


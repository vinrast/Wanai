'use stric'
coreApp.controller('PaquetesClienteCotizarController', function ($scope, $http, $window, ajax) {
    $scope.formulario = {};

    $scope.submit = function(isValid) {
        if (isValid){          
            datos = {};
            angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
            ajax.Post("/paquetes/cotizacion/post", datos ).$promise.then(
                function(data) {
                    $scope.titulo       = data.titulo;
                    $scope.mensaje      = data.mensaje;
                    $scope.redirecto    = function() {
                        $window.location.href = data.redirecto; 
                    };

                    angular.element("#validacion_modal").modal("show");
                },
                //error (400,500)
                function(data) {
                    $scope.titulo = "Error (7776)";
                    $scope.mensaje = "Disculpe, Intentelo nuevamente. Si el error continua contacte a soporte técnico.";
                    $scope.redirecto = function() {
                        $window.location.reload();
                    } 
                    angular.element("#validacion_modal").modal("show");
                });
        }else{
            $scope.submitted = true;
            $window.location.href = "#"; 
        }
    }
});

coreApp.controller('PaquetesClienteController', function ($scope, $http, $window, ajax, $sce) {
     
    new Photostack( document.getElementById( 'photostack-1' ), {
                callback : function( item ) {
                    //console.log(item)
                }
            } );

    $scope.ampliar_imagen = function(nombre_img) {
        $scope.img_ampliada = $scope.url_root +"/uploads/paquetes/img_full/"+nombre_img; 
        $scope.titulo       = "Imagen";
        angular.element("#modal_imagen").modal("show");
    }

    $scope.ampliar_video = function(nombre_img) {
        $scope.titulo       = "Video";
        $scope.processvideo = $sce.trustAsResourceUrl(nombre_img);
        angular.element("#modal_video").modal("show");
    }
});
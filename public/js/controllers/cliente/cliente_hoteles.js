'use stric'
coreApp.controller('HotelesClienteController', function ($scope, $http, $window, ajax, $sce) {
    $scope.formulario = {};
    $scope.habitacion = "";
    $scope.data = "";
    $scope.regimenes = [];

    $scope.data_selects = [];
 /*   $scope.init_habitaciones = function(hab, regimen) {
        for (i in hab){
            var datos = {};
            for (r in regimen){

                if (){
                    datos =  {
                            id_habitacion : hab[i].id_habitacion,
                            nombre_habitacion : hab[i].nombre_habitacion,
                            regimenes : [],
                        }
                    
                }
                
            }
                
            $scope.data_selects.push(datos);
            console.log($scope.data_selects);
        }
        
    }
*/

    $scope.ampliar_imagen = function(nombre_img) {
        $scope.img_ampliada = $scope.url_root +"/uploads/hoteles/img_full/"+nombre_img; 
        $scope.titulo       = "Imagen";
        angular.element("#modal_imagen").modal("show");
    }

    $scope.ampliar_video = function(nombre_img) {
        $scope.titulo       = "Video";
        $scope.processvideo = $sce.trustAsResourceUrl(nombre_img);
        angular.element("#modal_video").modal("show");
    }

    $scope.submit = function(isValid) {
        if (isValid){          
            datos = {};
            angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
            ajax.Post("/hoteles/cotizacion/post", datos ).$promise.then(
                function(data) {
                    if (data.success){
                        
                    }else{
                        $scope.titulo       = data.titulo;
                        $scope.mensaje      = data.mensaje;
                        $scope.redirecto    = function() {
                            $window.location.href = data.redirecto; 
                        };
                        angular.element("#validacion_modal").modal("show");
                    }
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

    $scope.enviar = function(){
        $window.location = "/hoteles/agregar-regimen"
    };

    new Photostack( document.getElementById( 'photostack-1' ), {
                callback : function( item ) {
                    //console.log(item)
                }
            } );

});

coreApp.controller('HotelesClienteListarController', function ($scope, $http, $window, ajax, $sce) {

    });
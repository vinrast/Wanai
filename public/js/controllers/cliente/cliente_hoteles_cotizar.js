'use stric'
coreApp.controller('HotelesClienteCotizarController', function ($scope, $http, $window, ajax) {
    $scope.formulario = {};
    $scope.id_habitacion = "";
    $scope.id_regimen = {id:0};
    $scope.data = "";
    $scope.regimenes = [];
    $scope.regimen = [];

    $scope.change = function() {
            $scope.id_regimen = {id:0};  
            $scope.regimenes = [{id:0,
                            nombre: "Solo habitación",}];

        for (r in $scope.regimen){
            if ($scope.id_habitacion == $scope.regimen[r].id_habitacion){
                var info = {
                            id:$scope.regimen[r].id_detalle_regimen,
                            nombre:$scope.regimen[r].nombre_tipo,
                            }
                $scope.regimenes.push(info);
            }
        }
    }

    $scope.submit = function(isValid) {
        if (isValid){          
            datos = {};
            angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
            ajax.Post("/hoteles/cotizacion/post", datos ).$promise.then(
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

    $scope.enviar = function(){
        $window.location = "/hoteles/agregar-regimen"
    };
});
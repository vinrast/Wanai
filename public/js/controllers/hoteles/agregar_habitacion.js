'use stric'
coreApp.controller('AgregarHabitacionesController', function ($scope, $http, $window, ajax) {
    $scope.nombre="";
    $scope.descripcion ="";
    $scope.cantidad="";
    $scope.costo="";
    $scope.submitted = false;
    $scope.habitaciones = [];

    $scope.submit = function(isValid) {
        if (isValid){          
            datos = {};
            angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
            ajax.Post("/habitacion/create", datos ).$promise.then(
                function(data) {
                    if (data.success){
                        var habitacion = {
                            id_habitacion :            data.data.id,
                            nombre_habitacion :        $scope.nombre,
                            descripcion_habitacion :   $scope.descripcion,
                            costo_habitacion :         $scope.costo
                        }; 
                        $scope.titulo       = data.titulo;
                        $scope.mensaje      = data.mensaje;
                        $scope.habitaciones.push(habitacion);
                        angular.element("#validacion_modal").modal("show");
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
            //AQUI VAN LAS VALIDACIONES POR FORMULARIO
            $scope.submitted = true;
            $window.location.href = "#"; 
        }
    }


    $scope.eliminar = function(index, id) {
        ajax.Post('/habitacion/'+id, {}).$promise.then(
            function(data) {
                if (data.success){
                    $scope.titulo       = data.titulo;
                    $scope.mensaje      = data.mensaje;
                    $scope.habitaciones.splice(index, 1);
                    angular.element("#validacion_modal").modal("show");
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
            }
        );
    }


    $scope.enviar = function(){
        $window.location = "/hoteles/agregar-regimen"
    };
});
'use stric'
coreApp.controller('AgregarRegimenController', function ($scope, $http, $window, ajax) {
    $scope.nombre="";
    $scope.descripcion ="";
    $scope.costo="";
    $scope.submitted = false;
    $scope.regimenes = [];

    $scope.submit = function(isValid) {
        if (isValid){          
            datos = {};
            angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
            ajax.Post("/regimen/create", datos ).$promise.then(
                function(data) {
                    if (data.success){
                        var regimen = {
                            id_detalle_regimen :    data.data.id,
                            nombre_tipo :           data.data.nombre_tipo,
                            nombre_habitacion :     data.data.nombre_habitacion,
                            costo_detalle_regimen : data.data.costo_habitacion
                        }; 
                        $scope.titulo       = data.titulo;
                        $scope.mensaje      = data.mensaje;
                        $scope.regimenes.push(regimen);
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
            $scope.submitted = true;
            $window.location.href = "#"; 
        }
    }


    $scope.eliminar = function(index, id) {
        ajax.Post('/regimen/'+id, {}).$promise.then(
            function(data) {
                if (data.success){
                    $scope.titulo       = data.titulo;
                    $scope.mensaje      = data.mensaje;
                    $scope.regimenes.splice(index, 1);
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
        $window.location = "/hoteles/registrado";
    };
});
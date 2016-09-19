'use stric'

coreApp.controller('BoletosClienteController', function ($scope, $http, $window, ajax) {

});

coreApp.controller('BoletosClienteCotizarController', function ($scope, $http, $window, ajax) {
    $scope.formulario = {};



    $scope.submit = function(isValid) {
        if (isValid){          
            datos = {};
            angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
            ajax.Post("/boletos/cotizacion/post", datos ).$promise.then(
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
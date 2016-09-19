'use stric'
coreApp.controller('AgregarBoletosController', function ($scope, $http, $window, ajax) {

    console.log('AgregarBoletosController');

    $("#datepicker-disabled-past").datepicker({todayHighlight:!0})

    $scope.enviar = function(){
    	var data = {};
        console.log($scope.formulario);
    };

    $scope.inicializador = function(data) {
        $scope.boleto = data;
        $scope.boleto.costo_boleto_infante = parseInt($scope.boleto.costo_boleto_infante);
        $scope.boleto.costo_boleto_bebe = parseInt($scope.boleto.costo_boleto_bebe);
        $scope.boleto.costo_boleto_adulto = parseInt($scope.boleto.costo_boleto_adulto);
        $scope.boleto.cantidad_boleto = parseInt($scope.boleto.cantidad_boleto);
        $scope.boleto.id_aerolinea = $scope.boleto.cantidad_boleto.toString();
        $scope.boleto.id_tipo_origen = $scope.boleto.cantidad_boleto.toString();
        $scope.boleto.id_tipo_destino = $scope.boleto.cantidad_boleto.toString();

   }

    $scope.submitted = false;


    $scope.submit = function(isValid) {
    console.log(isValid);
    if (isValid){
        datos = {};
        angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
        console.log(datos);
        ajax.Post($scope.posturl, datos ).$promise.then(
            function(data) {
                if (data.success){
                    $window.location.href = data.redirecto; 
                }else{
                    $scope.titulo        = data.titulo;
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

});
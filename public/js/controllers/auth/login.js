// Declare use of strict javascript
'use strict';


coreApp.controller('LoginController', function($scope, $log, ajax, $window) {
    $log.log('LoginController');

    $(document).ready(function() {
        LoginV2.init();
    });

	$scope.submit = function(isValid){
    	var data = {};
        console.log("prueba");
        if (isValid){
    	// TRANSFORMANDO UN FORM A UN JSON
        	angular.element('#formulario').serializeArray().map(function(x){data[x.name] = x.value;});
    	    ajax.Post("/auth/login", data ).$promise.then(
                function(data) {
                    if (data.success){
                    	$window.location.href = data.redirecto;            
                    }else{
                        $scope.titulo = data.titulo;    
                    	$scope.mensaje = data.mensaje;
                        $scope.redirecto = function() {
                            $window.location.href = data.redirecto;
                        }
                        angular.element("#validacion_modal").modal("show");
                    }
    	        },
                //error (400,500)
                function(data) {
                    $scope.titulo = "Error (7773)";
                    $scope.mensaje = "Disculpe, Intentelo nuevamente. Si el error continua contacte a soporte técnico.";
                    $scope.redirecto = function() {
                        $window.location.href = "/auth/login"; 
                    } 
                    angular.element("#validacion_modal").modal("show");
                }
            );
        }else{
            console.log("formulario invalido");
        }
	};
});
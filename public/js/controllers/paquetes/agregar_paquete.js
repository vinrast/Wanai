'use stric'

coreApp.controller('PaquetesController', function($scope, $log, $window, ajax) {
    $log.log('PaquetesController');

    $("#datepicker-disabled-past").datepicker({todayHighlight:!0})

    $("#datepicker-disabled-past2").datepicker({todayHighlight:!0})

   // $("#default-daterange").daterangepicker({
   //      opens:"right",
   //      format:"MM/DD/YYYY",
   //      separator:" to ",
   //      startDate:moment().subtract(29,"days"),
   //      endDate:moment(),
   //      minDate:"01/01/2012",
   //      maxDate:"12/31/2018"},
   //          function(a,t){
   //              $("#default-daterange input").val(a.format("MMMM D, YYYY")+" - "+t.format("MMMM D, YYYY"))
   //              $("#i_salida").val(a.format("YYYY-MM-DD"))
   //              $("#i_retorno").val(t.format("YYYY-MM-DD"))
   //          });

   $scope.inicializador = function(data) {
        $scope.paquete = data;
        $scope.paquete.costo_paquete = parseInt($scope.paquete.costo_paquete);
        $scope.paquete.id_tipo_paquete = $scope.paquete.id_tipo_paquete.toString();
   }
   $scope.submitted = false;

   $scope.submit = function(isValid) {
        if (isValid){
            datos = {};
            angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
            console.log(datos);
            ajax.Post($scope.posturl, datos ).$promise.then(
                function(data) {
                    if (data.success){
                        $window.location.href = data.redirecto; 
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
                        $window.location.href = "/paquetes/agregar"; 
                    } 
                    angular.element("#validacion_modal").modal("show");
                });
        }else{
            $scope.submitted = true;
            $window.location.href = "#"; 
            console.log("formulario invalido");
        }
   }

})
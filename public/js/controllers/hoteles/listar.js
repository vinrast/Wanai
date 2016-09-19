'use stric'
coreApp.controller('ListarHotelesController', function ($scope, $window, ajax) {

    console.log("ListarHotelesController");

    $scope.confirmar_del = function(id) {
        $scope.id_hotel_a_borrar = id;
        $scope.mensaje_m_confirmacion = "¿Realmente desea eliminar el hotel?";
        $scope.titulo_m_confirmacion = "Confirmación";
        $scope.ejecutar = $scope.del;       
        angular.element("#ModalConfimacion").modal("show");
    }

    $scope.del = function(){
        ajax.Post("/hoteles/delhotel/", {id:$scope.id_hotel_a_borrar} ).$promise.then(
            function(data) {
                if (data.success){
                    $window.location.reload();

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

    };
});
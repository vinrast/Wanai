'use stric'
coreApp.controller('HotelRegistradoController', function ($scope, $window, ajax) {

    console.log("HotelRegistradoController");

    $scope.dato = {};
    $scope.inicializar = function(data) {
        console.log(data[0]);
         $scope.dato = data[0];
         $scope.dato.id_tipo_servicio = $scope.dato.id_tipo_servicio.split(",");
    }

});
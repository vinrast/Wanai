'use stric'


coreApp.controller('AgregarHotelesController', function($scope, $log, ajax, $window, registro_service) {
    console.log('AgregarHotelesController');

    $scope.hotel  = {};
    $scope.submitted = false;
    $scope.opciones_servicio = [];
    $scope.data_select_multiple =[];
    //Select Multiple
    $(".js-example-placeholder-multiple").select2({
        placeholder: "Seleccion Multiple"
    });

    var $states = $(".js-source-states");
    var statesOptions = $states.html();
    $states.remove();

    $(".js-states").append(statesOptions);

    //$scope.formData = {};

    $scope.inicializar = function(servicio) {

        servicio.forEach(function (i) {
            $scope.data_select_multiple.push(i.nombre_tipo);
        }); 
        if ($scope.hotel.id_tipo_servicio){
            $scope.hotel.id_tipo_servicio = $scope.hotel.id_tipo_servicio.split(",");
            $scope.hotel.id_tipo_estado   = $scope.hotel.id_tipo_estado.toString();
        }
    }

    $scope.submit = function(isValid) {

    if (!$scope.hotel.id_tipo_servicio || $scope.hotel.id_tipo_servicio.length ===0){
        isValid = false;
    }
    if (isValid){
        datos = {};
        angular.element('#formulario').serializeArray().map(function(x){datos[x.name] = x.value;});
        console.log(datos);
        datos["namefile"] = $scope.hotel.url_imagen_hotel;
        datos['sm_servicios'] = $scope.hotel.id_tipo_servicio.toString();
        ajax.Post($scope.posturl , datos ).$promise.then(
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
        //AQUI VAN LAS VALIDACIONES POR FORMULARIO
        $scope.submitted = true;
        $window.location.href = "#"; 
        }
    }

    $scope.file            = null;
    $scope.myImage         = '';
    $scope.myCroppedImage  = '';
    $scope.srcimg          = null;
    $scope.img             = '/img/no-imagen.jpg';


    var handleFileSelect = function (evt) {
        var file        = evt.currentTarget.files[0];
        var reader      = new FileReader();
        reader.onload   = function (evt) {
            $scope.$apply(function ($scope) {
                $scope.myImage = evt.target.result;
            });
        };
        reader.readAsDataURL(file);
    };
    angular.element(document.querySelector('#fileInput')).on('change', handleFileSelect);

    $scope.snipper                  = false;
    $scope.disable                  = false;
    $scope.return_img = function(id){
        $scope.snipper = true;
        $scope.disable = true;
        $scope.img = $scope.srcimg;
        var url = "/upload/img";
        var datos = {img : $scope.img};
        registro_service.Post( datos).$promise.then(
            function(data) {
                if (data.status === "success"){
                    $scope.snipper = false;
                    $scope.disable = false;
                    $scope.hotel.url_imagen_hotel = data.name;
                }else{
                    $scope.titulo = "Error (5001)";
                    $scope.mensaje = "Disculpe, intente seleccionar su imagen nuevamente. Si el error continua contacte a soporte técnico.";
                    $scope.redirecto = function() {
                        $window.location.href = "#";
                    }                    
                    angular.element("#validacion_modal").modal("show");
                }
            },
            //error (400,500)
            function(data) {
                $scope.titulo = "Error (7778)";
                $scope.mensaje = "Disculpe, Intentelo nuevamente. Si el error continua contacte a soporte técnico.";
                $scope.redirecto = function() {
                    $window.location.reload();
                };
                angular.element("#validacion_modal").modal("show");
            });
        angular.element("#myModal").modal("hide");
    };    

});
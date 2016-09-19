// Declare use of strict javascript
'use strict';

coreApp.controller('Wanaitraveltroller', function ($scope, $log) {
})


coreApp.controller('PaquetesController', function($scope, $log) {
    $log.log('PaquetesController');

   $("#default-daterange").daterangepicker({
        opens:"right",
        format:"MM/DD/YYYY",
        separator:" to ",
        startDate:moment().subtract(29,"days"),
        endDate:moment(),
        minDate:"01/01/2012",
        maxDate:"12/31/2018"},
            function(a,t){
                $("#default-daterange input").val(a.format("MMMM D, YYYY")+" - "+t.format("MMMM D, YYYY"))
                $("#i_salida").val(a.format("YYYY-MM-DD"))
                $("#i_retorno").val(t.format("YYYY-MM-DD"))
            })
})

coreApp.controller('WelcomeController', function($scope, $log) {
        $log.log('WelcomeController');
        $(document).ready(function() {
            App.init();
        });
    })

coreApp.controller('HotelesClienteController', function($scope, $log) {
        $log.log('HotelesClienteController');

    })


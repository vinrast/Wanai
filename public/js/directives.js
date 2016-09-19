coreApp.directive('fileSelect', function() {
        var template = '<input type="file" name="files" id="fileInput"/>';
        return function( scope, elem, attrs ) {
            var selector = $( template );

            selector.bind('change', function( event ) {
                scope.$apply(function() {
                    var html = '<input type="file" name="i_image" file-model="myFile" id="fileInput"/>'
                    var e =$compile(html)(scope);
                    elem.replaceWith(e);
                });
            });
        };
    });

coreApp.filter('propsFilter', function() {
  return function(items, props) {
    var out = [];

    if (angular.isArray(items)) {
      items.forEach(function(item) {
        var itemMatches = false;

        var keys = Object.keys(props);
        for (var i = 0; i < keys.length; i++) {
          var prop = keys[i];
          var text = props[prop].toLowerCase();
          if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
            itemMatches = true;
            break;
          }
        }

        if (itemMatches) {
          out.push(item);
        }
      });
    } else {
      // Let the output be the input untouched
      out = items;
    }

    return out;
  };
});

coreApp.filter('range', function() {
 return function(input, total) {
   total = parseInt(total);
   for (var i=0; i<total; i++)
     input.push(i);
   return input;
 };
});
//$('#map_canvas').gmap();
document.onload(
    function() {
        // Also works with: var yourStartLatLng = '59.3426606750, 18.0736160278';
        var yourStartLatLng = new google.maps.LatLng(59.3426606750, 18.0736160278);
        $('#map_canvas').gmap({'center': yourStartLatLng});
    }
);

/*$('#map_canvas').gmap().bind('init', function(ev, map) {
    $('#map_canvas').gmap('addMarker', {'position': '57.7973333,12.0502107', 'bounds': true}).click(function() {
        $('#map_canvas').gmap('openInfoWindow', {'content': 'Hello World!'}, this);
    });
});


// In the callback you can use "this" to call a function (e.g. this.get('map') instead of $('#map_canvas').gmap('get', 'map'))
$('#map_canvas').gmap({'callback': function() {
    var self = this; // we can't use "this" inside the click function (that refers to the marker object in this example)
    self.addMarker({'position': '57.7973333,12.0502107', 'bounds': true}).click(function() {
        self.openInfoWindow({'content': 'Hello World!'}, this);
    });
}});

$('#map_canvas').gmap({'some_option':'some_value'}); // Add the contructor
// addMarker returns a jQuery wrapped google.maps.Marker object
var $marker = $('#map_canvas').gmap('addMarker', {'position': '57.7973333,12.0502107', 'bounds': true});
$marker.click(function() {
    $('#map_canvas').gmap('openInfoWindow', {'content': 'Hello World!'}, this);
});

// If you dont add a constructor ($('#map_canvas').gmap({'some_option':'some_value'});) the plugin will auto initialize
$('#map_canvas').gmap('addMarker', {'position': '57.7973333,12.0502107', 'bounds': true}).click(function() {
    $('#map_canvas').gmap('openInfoWindow', {'content': 'Hello World!'}, this);
});*/

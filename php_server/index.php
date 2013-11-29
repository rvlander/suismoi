<!DOCTYPE HTML>
<html>
    <head>
        <title>OpenLayers Basic Example</title>

        <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
        <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script>

            function displayMap(lat,lon) {
                map = new OpenLayers.Map("mapdiv");
                var mapnik = new OpenLayers.Layer.OSM();
                map.addLayer(mapnik);



                var lonlat = new OpenLayers.LonLat(lon, lat).transform(
                        new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                        new OpenLayers.Projection("EPSG:900913") // to Spherical Mercator
                        );

                var zoom = 13;

                var markers = new OpenLayers.Layer.Markers("Markers");
                map.addLayer(markers);
                markers.addMarker(new OpenLayers.Marker(lonlat));

                map.setCenter(lonlat, zoom);
            }

            function init() {
                $.getJSON('getGPSPosition.php', function(data){
                    displayMap(data[0].latitude,data[0].longitude);
                });
            }


            /*function updateMarker() {
             x+=1;
             var lonlat = new OpenLayers.LonLat(-1.788+x, 53.571).transform(
             new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
             new OpenLayers.Projection("EPSG:900913") // to Spherical Mercator
             );
             
             var zoom = 13;
             
             var markers = new OpenLayers.Layer.Markers("Markers");
             map.addLayer(markers);
             markers.addMarker(new OpenLayers.Marker(lonlat));
             
             map.setCenter(lonlat, zoom);
             }*/

            //window.setInterval(updateMarker(), 30000);


        </script>

        <style>
            #mapdiv { width:640px; height:480px; }
            div.olControlAttribution { bottom:3px; }
        </style>

    </head>

    <body onload="init();">
        <p>My HTML page with an embedded map</p>
        <div id="mapdiv"></div>
    </body>
</html>

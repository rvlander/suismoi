<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">

        <title>OpenLayers Basic Example</title>
        <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="http://www.openlayers.org/api/OpenLayers.js"></script>

        <script>

            function displayMap(lat, lon) {
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

            function submit() {
                var identifiant;
                id = $("#id").val();
                $.getJSON('getGPSPosition.php?id=' + id, function(data) {
                    displayMap(data.latitude, data.longitude);
                });
            }

            function init() {
                $("#id").keypress(function(e) {
                    if (e.which == 13) {
                        submit();
                    }
                });

                $("#button").click(function() {
                        submit();
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
        <input id="id"/><div id="button">Submit</div>
        <div id="mapdiv"></div>
    </body>
</html>

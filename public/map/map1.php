

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>TromKe</title>
    <link href="css/StyleSheet.css" rel="stylesheet" type="text/css" />
    <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css"
        rel="stylesheet" type="text/css" />
    <!--Google API Javascript Reference-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&sensor=false">

        //    function initialize() { }
    

    </script>
    <script type="text/javascript" src="scripts/Markerwithlabel.js"></script>
    <!--Literal Control for runtime javascript-->
    <script type='text/javascript'>

var directionsDisplay;

    var directionsService = new google.maps.DirectionsService();
    var map;
          
    function  initialize() {

       
directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});


        var chicago = new google.maps.LatLng('12.93707','77.626605');
        var myOptions = {
            center: chicago,
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP,                      
        }

 

        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);

        
       directionsDisplay.setMap(map);
      calcRoute();


    }

function addMarker(location,name) {
var n=0;


alert(name);
        marker = new google.maps.Marker({
            position: location,
            map: map
            
        });

var iw = new google.maps.InfoWindow({
       content: name
     });
     google.maps.event.addListener(marker, 'click', function (e) { iw.open(map, marker); });

    }





var info_window = new google.maps.InfoWindow({content: ''});


var markIcon = new google.maps.MarkerImage(
    'images/yellow-google-map-pin-hi.png',
    null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(20, 25)
); 

function add_marker(point, note) {
    var marker = new google.maps.Marker({map: map, position: point, clickable: true,icon:markIcon});
    marker.note = note;
    google.maps.event.addListener(marker, 'mouseover', function() {
        info_window.content = marker.note;
        info_window.open(map, marker);
    });

    google.maps.event.addListener(marker, 'mouseout', function() {
        info_window.close();
 });
    return marker;
}










    function calcRoute() {

 var arr_from_jsonlon = JSON.parse(document.getElementById('Hiddenwaypoint').value);

 var strngnames = JSON.parse(document.getElementById('Hiddenjuncnames').value);

var popup = JSON.parse(document.getElementById('Hiddeninfo_windowstring').value);



var popupwindow =[];

for(var i=0;i<popup.length;i++){

if(popup[i]!=null){

popupwindow.push(popup[i]);

}

}






var names =[];

names = strngnames;

var nms =[];

for(var i=0;i<names.length;i++){

if(names[i]!=null){

nms.push(names[i]);

}


}

var junctime = JSON.parse(document.getElementById('Hiddenjunctime').value);

var jtime=[];

for(var i=0;i<junctime.length;i++){
if(junctime[i]!=null){
jtime.push(junctime[i]);
}
}
 



var lon =[];

lon = arr_from_jsonlon;



var longcord =[];

for(var i=0;i<lon.length;i++){

var a = parseFloat(lon[i]);

longcord.push(a);




}
var arr_from_jsonlat =JSON.parse(document.getElementById('Hiddenwaypoint1').value);
var lat = [];
lat  = (arr_from_jsonlat);
var latcord = [];

for(var i =0;i<lat.length;i++){

var a = parseFloat(lat[i]);

latcord.push(a);
}

var finalcord=[];

for(var z=0;z<(longcord.length&&latcord.length);z++){

if(longcord[z]&&latcord[z]!=null){
var pramod = new google.maps.LatLng(longcord[z],latcord[z])


finalcord.push(pramod);
}
}



 start  = new google.maps.LatLng(12.9833,77.5833);
        end = new google.maps.LatLng(12.97809,77.640963);

var waypts = [];
for(j=1;j<finalcord.length-1;j++){  
if(j!=null)          
      waypts.push({location: finalcord[j],
                   stopover: true});
}
       
     
var request = {
            
            origin: finalcord[0],
            destination: finalcord[finalcord.length-1],
            waypoints: waypts,       
                       
            travelMode: google.maps.DirectionsTravelMode.DRIVING

        };

 

        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                
                directionsDisplay.setDirections(response);

                var route = response.routes[0];
                

            }
        });
var j=0;
for(var i=1;i<finalcord.length-1;i++){  



    add_marker(finalcord[i], 'Current Junction is: '+nms[j]+'<br />Travel Time to next Junction: '+popupwindow[j]);
j=j+1;
}



var pinIcon = new google.maps.MarkerImage(
    'images/250px-Flag_icon_green_4.svg.png',
    null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(22, 28)
); 

 
 var marker = new MarkerWithLabel({
       position: finalcord[0],
       draggable: true,
       map: map,
       labelContent: 'Start',
       labelAnchor: new google.maps.Point(22, 0),
       labelClass: 'labels', // the CSS class for the label
       labelStyle: {opacity: 0.75},
       icon: pinIcon
       
     });


var pinIcon1 = new google.maps.MarkerImage(
    'images/Flag_icon_red_4.svg.png',
    null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(22, 28)
); 




var marker = new MarkerWithLabel({
       position: finalcord[finalcord.length-1],
       draggable: true,
       map: map,
       labelContent: 'End',
       labelAnchor: new google.maps.Point(22, 0),
       labelClass: 'labels', // the CSS class for the label
       labelStyle: {opacity: 0.75},
       icon: pinIcon1
       
     });



var iw = new google.maps.InfoWindow({
       content: 'End point : ' + nms[nms.length-1]
     });
     google.maps.event.addListener(marker, 'mouseover', function (e) { iw.open(map, marker); });
      google.maps.event.addListener(marker, 'mouseout', function (e) { iw.close(); });


var polylineOptions = new google.maps.Polyline({
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
});

var polylineOptionsMouseOver = new google.maps.Polyline({
    
    strokeColor: '#00CD00',
    strokeOpacity: 1.0,
    strokeWeight: 5
});

google.maps.event.addListener(directionsDisplay, 'directions_changed', function(event) {

    var path = directionsDisplay.getDirections().routes[0].overview_path;
    
    var eventLine = new google.maps.Polyline({
        path: path,
        visible: true,
        strokeOpacity: 0,
        zIndex: 1000
    }); 
    eventLine.setMap(map);
   
     var infowindow =  new google.maps.InfoWindow({
		content: 'Total Travel Time : 0 hr 23 mins'
	});

    google.maps.event.addListener(eventLine, 'mouseover', function(event) {
      
            directionsDisplay.setOptions({
            'polylineOptions': {strokeColor: '#00CD00'}, 
            'preserveViewport': true
        });
        infowindow.setPosition(event.latLng);
		infowindow.open(map);
        directionsDisplay.setMap(map);
         
        });
   
    google.maps.event.addListener(eventLine, 'mouseout', function(event) {
       
        directionsDisplay.setOptions({
            'polylineOptions': {strokeColor: '#FF0000'},
            'preserveViewport': true
        });
        infowindow.close();
        directionsDisplay.setMap(map);
    });

});

}

       </script>
</head>
<body onLoad="initialize()" >
    <form method="post" action="" id="form1" style="width: 100%; height: 100%">
<div class="aspNetHidden">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwULLTE3NTkwNzc1ODcPFgweBmZybWxhdAeU5kXcUtUpQB4HZnJtbG9uZwfSCOwgZWZTQB4FdG9sYXQHhhhUwOLVKUAeBnRvbG9uZwcoCMMl7GdTQB4EdGltZQUMMCBociAyMyBtaW5zHglhcnJheWRhdGE8KwIIABYEAgEPFgIeBFRleHQFpTk8c2NyaXB0IHR5cGU9J3RleHQvamF2YXNjcmlwdCc+DQoNCnZhciBkaXJlY3Rpb25zRGlzcGxheTsNCg0KICAgIHZhciBkaXJlY3Rpb25zU2VydmljZSA9IG5ldyBnb29nbGUubWFwcy5EaXJlY3Rpb25zU2VydmljZSgpOw0KICAgIHZhciBtYXA7DQogICAgICAgICAgDQogICAgZnVuY3Rpb24gIGluaXRpYWxpemUoKSB7DQoNCiAgICAgICANCmRpcmVjdGlvbnNEaXNwbGF5ID0gbmV3IGdvb2dsZS5tYXBzLkRpcmVjdGlvbnNSZW5kZXJlcih7c3VwcHJlc3NNYXJrZXJzOiB0cnVlfSk7DQoNCg0KICAgICAgICB2YXIgY2hpY2FnbyA9IG5ldyBnb29nbGUubWFwcy5MYXRMbmcoJzEyLjkzNzA3JywnNzcuNjI2NjA1Jyk7DQogICAgICAgIHZhciBteU9wdGlvbnMgPSB7DQogICAgICAgICAgICBjZW50ZXI6IGNoaWNhZ28sDQogICAgICAgICAgICB6b29tOiAxMCwNCiAgICAgICAgICAgIG1hcFR5cGVJZDogZ29vZ2xlLm1hcHMuTWFwVHlwZUlkLlJPQURNQVAsICAgICAgICAgICAgICAgICAgICAgIA0KICAgICAgICB9DQoNCiANCg0KICAgICAgICBtYXAgPSBuZXcgZ29vZ2xlLm1hcHMuTWFwKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtYXBfY2FudmFzJyksIG15T3B0aW9ucyk7DQoNCiAgICAgICAgDQogICAgICAgZGlyZWN0aW9uc0Rpc3BsYXkuc2V0TWFwKG1hcCk7DQogICAgICBjYWxjUm91dGUoKTsNCg0KDQogICAgfQ0KDQpmdW5jdGlvbiBhZGRNYXJrZXIobG9jYXRpb24sbmFtZSkgew0KdmFyIG49MDsNCg0KDQphbGVydChuYW1lKTsNCiAgICAgICAgbWFya2VyID0gbmV3IGdvb2dsZS5tYXBzLk1hcmtlcih7DQogICAgICAgICAgICBwb3NpdGlvbjogbG9jYXRpb24sDQogICAgICAgICAgICBtYXA6IG1hcA0KICAgICAgICAgICAgDQogICAgICAgIH0pOw0KDQp2YXIgaXcgPSBuZXcgZ29vZ2xlLm1hcHMuSW5mb1dpbmRvdyh7DQogICAgICAgY29udGVudDogbmFtZQ0KICAgICB9KTsNCiAgICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIobWFya2VyLCAnY2xpY2snLCBmdW5jdGlvbiAoZSkgeyBpdy5vcGVuKG1hcCwgbWFya2VyKTsgfSk7DQoNCiAgICB9DQoNCg0KDQoNCg0KdmFyIGluZm9fd2luZG93ID0gbmV3IGdvb2dsZS5tYXBzLkluZm9XaW5kb3coe2NvbnRlbnQ6ICcnfSk7DQoNCg0KdmFyIG1hcmtJY29uID0gbmV3IGdvb2dsZS5tYXBzLk1hcmtlckltYWdlKA0KICAgICdpbWFnZXMveWVsbG93LWdvb2dsZS1tYXAtcGluLWhpLnBuZycsDQogICAgbnVsbCwgLyogc2l6ZSBpcyBkZXRlcm1pbmVkIGF0IHJ1bnRpbWUgKi8NCiAgICBudWxsLCAvKiBvcmlnaW4gaXMgMCwwICovDQogICAgbnVsbCwgLyogYW5jaG9yIGlzIGJvdHRvbSBjZW50ZXIgb2YgdGhlIHNjYWxlZCBpbWFnZSAqLw0KICAgIG5ldyBnb29nbGUubWFwcy5TaXplKDIwLCAyNSkNCik7IA0KDQpmdW5jdGlvbiBhZGRfbWFya2VyKHBvaW50LCBub3RlKSB7DQogICAgdmFyIG1hcmtlciA9IG5ldyBnb29nbGUubWFwcy5NYXJrZXIoe21hcDogbWFwLCBwb3NpdGlvbjogcG9pbnQsIGNsaWNrYWJsZTogdHJ1ZSxpY29uOm1hcmtJY29ufSk7DQogICAgbWFya2VyLm5vdGUgPSBub3RlOw0KICAgIGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKG1hcmtlciwgJ21vdXNlb3ZlcicsIGZ1bmN0aW9uKCkgew0KICAgICAgICBpbmZvX3dpbmRvdy5jb250ZW50ID0gbWFya2VyLm5vdGU7DQogICAgICAgIGluZm9fd2luZG93Lm9wZW4obWFwLCBtYXJrZXIpOw0KICAgIH0pOw0KDQogICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIobWFya2VyLCAnbW91c2VvdXQnLCBmdW5jdGlvbigpIHsNCiAgICAgICAgaW5mb193aW5kb3cuY2xvc2UoKTsNCiB9KTsNCiAgICByZXR1cm4gbWFya2VyOw0KfQ0KDQoNCg0KDQoNCg0KDQoNCg0KDQogICAgZnVuY3Rpb24gY2FsY1JvdXRlKCkgew0KDQogdmFyIGFycl9mcm9tX2pzb25sb24gPSBKU09OLnBhcnNlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdIaWRkZW53YXlwb2ludCcpLnZhbHVlKTsNCg0KIHZhciBzdHJuZ25hbWVzID0gSlNPTi5wYXJzZShkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnSGlkZGVuanVuY25hbWVzJykudmFsdWUpOw0KDQp2YXIgcG9wdXAgPSBKU09OLnBhcnNlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdIaWRkZW5pbmZvX3dpbmRvd3N0cmluZycpLnZhbHVlKTsNCg0KDQoNCnZhciBwb3B1cHdpbmRvdyA9W107DQoNCmZvcih2YXIgaT0wO2k8cG9wdXAubGVuZ3RoO2krKyl7DQoNCmlmKHBvcHVwW2ldIT1udWxsKXsNCg0KcG9wdXB3aW5kb3cucHVzaChwb3B1cFtpXSk7DQoNCn0NCg0KfQ0KDQoNCg0KDQoNCg0KdmFyIG5hbWVzID1bXTsNCg0KbmFtZXMgPSBzdHJuZ25hbWVzOw0KDQp2YXIgbm1zID1bXTsNCg0KZm9yKHZhciBpPTA7aTxuYW1lcy5sZW5ndGg7aSsrKXsNCg0KaWYobmFtZXNbaV0hPW51bGwpew0KDQpubXMucHVzaChuYW1lc1tpXSk7DQoNCn0NCg0KDQp9DQoNCnZhciBqdW5jdGltZSA9IEpTT04ucGFyc2UoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ0hpZGRlbmp1bmN0aW1lJykudmFsdWUpOw0KDQp2YXIganRpbWU9W107DQoNCmZvcih2YXIgaT0wO2k8anVuY3RpbWUubGVuZ3RoO2krKyl7DQppZihqdW5jdGltZVtpXSE9bnVsbCl7DQpqdGltZS5wdXNoKGp1bmN0aW1lW2ldKTsNCn0NCn0NCiANCg0KDQoNCnZhciBsb24gPVtdOw0KDQpsb24gPSBhcnJfZnJvbV9qc29ubG9uOw0KDQoNCg0KdmFyIGxvbmdjb3JkID1bXTsNCg0KZm9yKHZhciBpPTA7aTxsb24ubGVuZ3RoO2krKyl7DQoNCnZhciBhID0gcGFyc2VGbG9hdChsb25baV0pOw0KDQpsb25nY29yZC5wdXNoKGEpOw0KDQoNCg0KDQp9DQp2YXIgYXJyX2Zyb21fanNvbmxhdCA9SlNPTi5wYXJzZShkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnSGlkZGVud2F5cG9pbnQxJykudmFsdWUpOw0KdmFyIGxhdCA9IFtdOw0KbGF0ICA9IChhcnJfZnJvbV9qc29ubGF0KTsNCnZhciBsYXRjb3JkID0gW107DQoNCmZvcih2YXIgaSA9MDtpPGxhdC5sZW5ndGg7aSsrKXsNCg0KdmFyIGEgPSBwYXJzZUZsb2F0KGxhdFtpXSk7DQoNCmxhdGNvcmQucHVzaChhKTsNCn0NCg0KdmFyIGZpbmFsY29yZD1bXTsNCg0KZm9yKHZhciB6PTA7ejwobG9uZ2NvcmQubGVuZ3RoJiZsYXRjb3JkLmxlbmd0aCk7eisrKXsNCg0KaWYobG9uZ2NvcmRbel0mJmxhdGNvcmRbel0hPW51bGwpew0KdmFyIHByYW1vZCA9IG5ldyBnb29nbGUubWFwcy5MYXRMbmcobG9uZ2NvcmRbel0sbGF0Y29yZFt6XSkNCg0KDQpmaW5hbGNvcmQucHVzaChwcmFtb2QpOw0KfQ0KfQ0KDQoNCg0KIHN0YXJ0ICA9IG5ldyBnb29nbGUubWFwcy5MYXRMbmcoMTIuOTgzMyw3Ny41ODMzKTsNCiAgICAgICAgZW5kID0gbmV3IGdvb2dsZS5tYXBzLkxhdExuZygxMi45NzgwOSw3Ny42NDA5NjMpOw0KDQp2YXIgd2F5cHRzID0gW107DQpmb3Ioaj0xO2o8ZmluYWxjb3JkLmxlbmd0aC0xO2orKyl7ICANCmlmKGohPW51bGwpICAgICAgICAgIA0KICAgICAgd2F5cHRzLnB1c2goe2xvY2F0aW9uOiBmaW5hbGNvcmRbal0sDQogICAgICAgICAgICAgICAgICAgc3RvcG92ZXI6IHRydWV9KTsNCn0NCiAgICAgICANCiAgICAgDQp2YXIgcmVxdWVzdCA9IHsNCiAgICAgICAgICAgIA0KICAgICAgICAgICAgb3JpZ2luOiBmaW5hbGNvcmRbMF0sDQogICAgICAgICAgICBkZXN0aW5hdGlvbjogZmluYWxjb3JkW2ZpbmFsY29yZC5sZW5ndGgtMV0sDQogICAgICAgICAgICB3YXlwb2ludHM6IHdheXB0cywgICAgICAgDQogICAgICAgICAgICAgICAgICAgICAgIA0KICAgICAgICAgICAgdHJhdmVsTW9kZTogZ29vZ2xlLm1hcHMuRGlyZWN0aW9uc1RyYXZlbE1vZGUuRFJJVklORw0KDQogICAgICAgIH07DQoNCiANCg0KICAgICAgICBkaXJlY3Rpb25zU2VydmljZS5yb3V0ZShyZXF1ZXN0LCBmdW5jdGlvbihyZXNwb25zZSwgc3RhdHVzKSB7DQogICAgICAgICAgICBpZiAoc3RhdHVzID09IGdvb2dsZS5tYXBzLkRpcmVjdGlvbnNTdGF0dXMuT0spIHsNCiAgICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgICBkaXJlY3Rpb25zRGlzcGxheS5zZXREaXJlY3Rpb25zKHJlc3BvbnNlKTsNCg0KICAgICAgICAgICAgICAgIHZhciByb3V0ZSA9IHJlc3BvbnNlLnJvdXRlc1swXTsNCiAgICAgICAgICAgICAgICANCg0KICAgICAgICAgICAgfQ0KICAgICAgICB9KTsNCnZhciBqPTA7DQpmb3IodmFyIGk9MTtpPGZpbmFsY29yZC5sZW5ndGgtMTtpKyspeyAgDQoNCg0KDQogICAgYWRkX21hcmtlcihmaW5hbGNvcmRbaV0sICdDdXJyZW50IEp1bmN0aW9uIGlzOiAnK25tc1tqXSsnPGJyIC8+VHJhdmVsIFRpbWUgdG8gbmV4dCBKdW5jdGlvbjogJytwb3B1cHdpbmRvd1tqXSk7DQpqPWorMTsNCn0NCg0KDQoNCnZhciBwaW5JY29uID0gbmV3IGdvb2dsZS5tYXBzLk1hcmtlckltYWdlKA0KICAgICdpbWFnZXMvMjUwcHgtRmxhZ19pY29uX2dyZWVuXzQuc3ZnLnBuZycsDQogICAgbnVsbCwgLyogc2l6ZSBpcyBkZXRlcm1pbmVkIGF0IHJ1bnRpbWUgKi8NCiAgICBudWxsLCAvKiBvcmlnaW4gaXMgMCwwICovDQogICAgbnVsbCwgLyogYW5jaG9yIGlzIGJvdHRvbSBjZW50ZXIgb2YgdGhlIHNjYWxlZCBpbWFnZSAqLw0KICAgIG5ldyBnb29nbGUubWFwcy5TaXplKDIyLCAyOCkNCik7IA0KDQogDQogdmFyIG1hcmtlciA9IG5ldyBNYXJrZXJXaXRoTGFiZWwoew0KICAgICAgIHBvc2l0aW9uOiBmaW5hbGNvcmRbMF0sDQogICAgICAgZHJhZ2dhYmxlOiB0cnVlLA0KICAgICAgIG1hcDogbWFwLA0KICAgICAgIGxhYmVsQ29udGVudDogJ1N0YXJ0JywNCiAgICAgICBsYWJlbEFuY2hvcjogbmV3IGdvb2dsZS5tYXBzLlBvaW50KDIyLCAwKSwNCiAgICAgICBsYWJlbENsYXNzOiAnbGFiZWxzJywgLy8gdGhlIENTUyBjbGFzcyBmb3IgdGhlIGxhYmVsDQogICAgICAgbGFiZWxTdHlsZToge29wYWNpdHk6IDAuNzV9LA0KICAgICAgIGljb246IHBpbkljb24NCiAgICAgICANCiAgICAgfSk7DQoNCg0KdmFyIHBpbkljb24xID0gbmV3IGdvb2dsZS5tYXBzLk1hcmtlckltYWdlKA0KICAgICdpbWFnZXMvRmxhZ19pY29uX3JlZF80LnN2Zy5wbmcnLA0KICAgIG51bGwsIC8qIHNpemUgaXMgZGV0ZXJtaW5lZCBhdCBydW50aW1lICovDQogICAgbnVsbCwgLyogb3JpZ2luIGlzIDAsMCAqLw0KICAgIG51bGwsIC8qIGFuY2hvciBpcyBib3R0b20gY2VudGVyIG9mIHRoZSBzY2FsZWQgaW1hZ2UgKi8NCiAgICBuZXcgZ29vZ2xlLm1hcHMuU2l6ZSgyMiwgMjgpDQopOyANCg0KDQoNCg0KdmFyIG1hcmtlciA9IG5ldyBNYXJrZXJXaXRoTGFiZWwoew0KICAgICAgIHBvc2l0aW9uOiBmaW5hbGNvcmRbZmluYWxjb3JkLmxlbmd0aC0xXSwNCiAgICAgICBkcmFnZ2FibGU6IHRydWUsDQogICAgICAgbWFwOiBtYXAsDQogICAgICAgbGFiZWxDb250ZW50OiAnRW5kJywNCiAgICAgICBsYWJlbEFuY2hvcjogbmV3IGdvb2dsZS5tYXBzLlBvaW50KDIyLCAwKSwNCiAgICAgICBsYWJlbENsYXNzOiAnbGFiZWxzJywgLy8gdGhlIENTUyBjbGFzcyBmb3IgdGhlIGxhYmVsDQogICAgICAgbGFiZWxTdHlsZToge29wYWNpdHk6IDAuNzV9LA0KICAgICAgIGljb246IHBpbkljb24xDQogICAgICAgDQogICAgIH0pOw0KDQoNCg0KdmFyIGl3ID0gbmV3IGdvb2dsZS5tYXBzLkluZm9XaW5kb3coew0KICAgICAgIGNvbnRlbnQ6ICdFbmQgcG9pbnQgOiAnICsgbm1zW25tcy5sZW5ndGgtMV0NCiAgICAgfSk7DQogICAgIGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKG1hcmtlciwgJ21vdXNlb3ZlcicsIGZ1bmN0aW9uIChlKSB7IGl3Lm9wZW4obWFwLCBtYXJrZXIpOyB9KTsNCiAgICAgIGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKG1hcmtlciwgJ21vdXNlb3V0JywgZnVuY3Rpb24gKGUpIHsgaXcuY2xvc2UoKTsgfSk7DQoNCg0KdmFyIHBvbHlsaW5lT3B0aW9ucyA9IG5ldyBnb29nbGUubWFwcy5Qb2x5bGluZSh7DQogICAgc3Ryb2tlQ29sb3I6ICcjRkYwMDAwJywNCiAgICBzdHJva2VPcGFjaXR5OiAxLjAsDQogICAgc3Ryb2tlV2VpZ2h0OiAyDQp9KTsNCg0KdmFyIHBvbHlsaW5lT3B0aW9uc01vdXNlT3ZlciA9IG5ldyBnb29nbGUubWFwcy5Qb2x5bGluZSh7DQogICAgDQogICAgc3Ryb2tlQ29sb3I6ICcjMDBDRDAwJywNCiAgICBzdHJva2VPcGFjaXR5OiAxLjAsDQogICAgc3Ryb2tlV2VpZ2h0OiA1DQp9KTsNCg0KZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIoZGlyZWN0aW9uc0Rpc3BsYXksICdkaXJlY3Rpb25zX2NoYW5nZWQnLCBmdW5jdGlvbihldmVudCkgew0KDQogICAgdmFyIHBhdGggPSBkaXJlY3Rpb25zRGlzcGxheS5nZXREaXJlY3Rpb25zKCkucm91dGVzWzBdLm92ZXJ2aWV3X3BhdGg7DQogICAgDQogICAgdmFyIGV2ZW50TGluZSA9IG5ldyBnb29nbGUubWFwcy5Qb2x5bGluZSh7DQogICAgICAgIHBhdGg6IHBhdGgsDQogICAgICAgIHZpc2libGU6IHRydWUsDQogICAgICAgIHN0cm9rZU9wYWNpdHk6IDAsDQogICAgICAgIHpJbmRleDogMTAwMA0KICAgIH0pOyANCiAgICBldmVudExpbmUuc2V0TWFwKG1hcCk7DQogICANCiAgICAgdmFyIGluZm93aW5kb3cgPSAgbmV3IGdvb2dsZS5tYXBzLkluZm9XaW5kb3coew0KCQljb250ZW50OiAnVG90YWwgVHJhdmVsIFRpbWUgOiAwIGhyIDIzIG1pbnMnDQoJfSk7DQoNCiAgICBnb29nbGUubWFwcy5ldmVudC5hZGRMaXN0ZW5lcihldmVudExpbmUsICdtb3VzZW92ZXInLCBmdW5jdGlvbihldmVudCkgew0KICAgICAgDQogICAgICAgICAgICBkaXJlY3Rpb25zRGlzcGxheS5zZXRPcHRpb25zKHsNCiAgICAgICAgICAgICdwb2x5bGluZU9wdGlvbnMnOiB7c3Ryb2tlQ29sb3I6ICcjMDBDRDAwJ30sIA0KICAgICAgICAgICAgJ3ByZXNlcnZlVmlld3BvcnQnOiB0cnVlDQogICAgICAgIH0pOw0KICAgICAgICBpbmZvd2luZG93LnNldFBvc2l0aW9uKGV2ZW50LmxhdExuZyk7DQoJCWluZm93aW5kb3cub3BlbihtYXApOw0KICAgICAgICBkaXJlY3Rpb25zRGlzcGxheS5zZXRNYXAobWFwKTsNCiAgICAgICAgIA0KICAgICAgICB9KTsNCiAgIA0KICAgIGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKGV2ZW50TGluZSwgJ21vdXNlb3V0JywgZnVuY3Rpb24oZXZlbnQpIHsNCiAgICAgICANCiAgICAgICAgZGlyZWN0aW9uc0Rpc3BsYXkuc2V0T3B0aW9ucyh7DQogICAgICAgICAgICAncG9seWxpbmVPcHRpb25zJzoge3N0cm9rZUNvbG9yOiAnI0ZGMDAwMCd9LA0KICAgICAgICAgICAgJ3ByZXNlcnZlVmlld3BvcnQnOiB0cnVlDQogICAgICAgIH0pOw0KICAgICAgICBpbmZvd2luZG93LmNsb3NlKCk7DQogICAgICAgIGRpcmVjdGlvbnNEaXNwbGF5LnNldE1hcChtYXApOw0KICAgIH0pOw0KDQp9KTsNCg0KfQ0KDQogICAgICAgPC9zY3JpcHQ+ZAIDD2QWEgIFDxBkEBUDBlNlbGVjdBBKYXlhZGV2YSBGbHlvdmVyG1NpbGsgQm9hcmQganVuY3Rpb24sbWFkaXZhbBUDBlNlbGVjdBBKYXlhZGV2YSBGbHlvdmVyG1NpbGsgQm9hcmQganVuY3Rpb24sbWFkaXZhbBQrAwNnZ2dkZAIJDxBkEBUDBlNlbGVjdBtTaWxrIEJvYXJkIGp1bmN0aW9uLG1hZGl2YWwQSmF5YWRldmEgRmx5b3ZlchUDBlNlbGVjdBtTaWxrIEJvYXJkIGp1bmN0aW9uLG1hZGl2YWwQSmF5YWRldmEgRmx5b3ZlchQrAwNnZ2dkZAIPDw8WAh4HVmlzaWJsZWdkZAIRDw8WBB8GBQwwIGhyIDIzIG1pbnMfB2dkZAITDw8WAh8HZ2RkAhUPDxYCHwdnZGQCFw8PFgQfBgUEMyBrbR8HZ2RkAhkPDxYCHwdoZGQCGw9kFgICAQ88KwARAgAPFgQeC18hRGF0YUJvdW5kZx4LXyFJdGVtQ291bnQCAWQBEBYAFgAWABYCZg9kFgZmD2QWBGYPDxYEHgtCb3JkZXJTdHlsZQsqJVN5c3RlbS5XZWIuVUkuV2ViQ29udHJvbHMuQm9yZGVyU3R5bGUBHgRfIVNCAkBkZAIBDw8WBB8KCysEAR8LAkBkZAIBD2QWBGYPDxYGHwYFX0pheWFkZXZhIEZseW92ZXIsIEJhbm5lcmdoYXR0YSBNYWluIFJvYWQgdG8gU2lsayBCb2FyZCBKdW5jdGlvbiwgTWFkaXZhbGEsIEJhbmdhbG9yZSwgS2FybmF0YWthHwoLKwQBHwsCQGRkAgEPDxYGHwYFDDAgaHIgMjMgbWlucx8KCysEAR8LAkBkZAICDw8WAh8HaGQWBGYPDxYEHwoLKwQBHwsCQGRkAgEPDxYEHwoLKwQBHwsCQGRkGAEFBkd2SnVuYw88KwAMAQgCAWTJIpQsqP8Qu+xG2ozW3q1uRwauA4LlPExnH4RBLNWq7g==" />
</div>

<div class="aspNetHidden">

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWDgLv4si1BgK7kc6oDQLEw+fJBgKP+cPcCgKiyqXMCAKWoqi4DwLdmIytAwLCi9r7CgKtkuXnBwKzlrGGCQLh1NWMBQLbrsfNCwLBxcyOAgKs/bTsAUo1cS9A+FpawZr5UslzrGwuHD02lLG3aTgZ3UuA3Jga" />
</div>
    <!--Canvas for showing the google map-->
    <div class="OuterMost">
        <div class="InnerMost1">
            <div class="Logo">
                <img src="images/tromke.bmp" style="height:120%;width:90%;" />
            </div>
            <div class="Clear">
            </div>
            <div class="ShortGap10">
            </div>
            <div class="FloatLeft">
                <span id="lblfrom">From :</span>
            </div>
            <div class="FloatRight">
                <select name="ddfrom" id="ddfrom" style="font-size:8pt;width:70%; margin-left:1%;">
	<option value="Select">Select</option>
	<option selected="selected" value="Jayadeva Flyover">Jayadeva Flyover</option>
	<option value="Silk Board junction,madival">Silk Board junction,madival</option>

</select>
            </div>
            <div class="Clear">
            </div>
           
            <div class="FloatLeft">
                <span id="lblto">To :</span>
            </div>
            <div class="FloatRight">
                <select name="ddto" id="ddto" style="font-size:8pt;width:70%; margin-left:1%;">
	<option value="Select">Select</option>
	<option selected="selected" value="Silk Board junction,madival">Silk Board junction,madival</option>
	<option value="Jayadeva Flyover">Jayadeva Flyover</option>

</select>
            </div>
            <div class="Clear">
            </div>
           
            <div class="OuterFloat" style=" margin-left:16%;">
                <input type="submit" name="btnsubmit" value="Travel Time" id="btnsubmit" style="font-size:9pt;" />
            
            
                <input type="submit" name="btnclear" value="Clear" id="btnclear" style="font-size:9pt;" />
            </div>
            <div class="Clear">
            </div>
            
            
            <div class="OuterFloat">
            <div class="FloatLeft1">
                <span id="lbltime" style="font-size:9pt;">Travel Time in Current Traffic :</span>
            </div>
            <div class="FloatRight">
                
                    <span id="lbltimevalue" style="font-size:9pt;">0 hr 23 mins</span>
                <img id="imgvehicle" src="images/vehicle.jpg" style="height:12px;width:15px;margin-left: 1%;" />
            </div>
            </div>
            <div class="Clear">
            </div>
           
            <div class="OuterFloat">
            <div class="FloatLeft1">
                <span id="lbldist" style="font-size:10pt;">Distance to Destination :</span>
            </div>
            <div class="FloatRight">
                
                    <span id="lbldis">3 km</span>
            </div>
            </div>
            <div class="Clear">
            </div>
            <div class="ShortGap">
            </div>
            <div class="NotifyDiv">
                
            </div>
            <div id="gd" class="GridDiv">
                <div>
	<table cellspacing="0" rules="all" border="1" id="GvJunc" style="border-collapse:collapse;width: 93%; height:auto;
                    border-color: White; line-height: 18px; margin-left:3%;">
		<tr class="GridViewHeaderStyle" style="color:Black;">
			<th scope="col" style="border-style:None;"> Junctions</th><th scope="col" style="border-style:None;">Travel time</th>
		</tr><tr class="GridViewItemStyle">
			<td class="hr" style="border-style:None;">Jayadeva Flyover, Bannerghatta Main Road to Silk Board Junction, Madivala, Bangalore, Karnataka</td><td class="hr" style="border-style:None;">0 hr 23 mins</td>
		</tr>
	</table>
</div>
            </div>
        </div>
        <div class="InnerMost2">
            <div id="map_canvas" style="width: 100%; height: 100%;">
            </div>
        </div>
        <input type="hidden" name="Hiddenwaypoint" id="Hiddenwaypoint" value="[12.9166478,12.9166478,12.917631,0,0,0,0,0]" />
        <input type="hidden" name="Hiddenwaypoint1" id="Hiddenwaypoint1" value="[77.5999224,77.5999224,77.622997,0,0,0,0,0]" />
        <input type="hidden" name="Hiddenjuncnames" id="Hiddenjuncnames" value="[&quot;Jayadeva Flyover, Bannerghatta Main Road&quot;,&quot;Silk Board Junction, Madivala, Bangalore, Karnataka&quot;,null,null,null,null,null,null]" />
        <input type="hidden" name="Hiddenjunctime" id="Hiddenjunctime" value="[null,&quot;1405&quot;,null,null,null,null,null,null]" />
        <input type="hidden" name="Hiddeninfo_windowstring" id="Hiddeninfo_windowstring" value="[&quot;0 hrs23 mins&quot;,null,null,null,null,null,null,null]" />
    </div>
    </form>
</body>
</html>

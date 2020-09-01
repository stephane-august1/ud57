var map = L.map('map').setView([49.1191, 6.1727], 8);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoic3RlcGhhbmVhdWd1c3QxIiwiYSI6ImNrZWltMnZ1bDBhazIyeHBpdGt3b2VuZGQifQ.ROjzrcVm5OlR6YgjB3nJgg'
}).addTo(map);

//modifier le marker avec une image
/*var myIcon = L.icon({
    iconUrl: 'goutterigolo.png',
    iconSize: [48, 65],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
    //shadowUrl: 'goutterigolo.png',
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
});*/
//simple marker
var marker = L.marker([49.1191, 6.1727],{
    draggable:true,
    //icon: myIcon,
}).addTo(map);
//marker en rond
var circle = L.circle([48.708, 5.00], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 3900
}).addTo(map);
//popup au clic
circle.bindPopup("<a href='#'>my tooltip text</a>");
//popup mousehover
marker.bindTooltip("<a href='#'>my tooltip text</a>").openTooltip();



let xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = () =>  {
  if(xmlhttp.readyState == 4){
      if(xmlhttp.status == 200){
          //ici chargement ok
          let geojson = JSON.parse(xmlhttp.responseText);
          console.log('xm',geojson);
         
           // On dessine le polygone
            let geojsonLayer = L.geoJSON(geojson, {
                style: {
                    "color": "orange",
                    //'color': "#839C49",
                    "opacity": 0.3,
                    "weight": 4,
                    
                   // "fillColor": "black",
                   // "fillOpacity": 1
                }
            });
            // On ajoute une popup click
            //geojsonLayer.bindPopup("Département 57");
            //popup over
             geojsonLayer.bindTooltip("Département 57");

            // On ajoute à la carte
            geojsonLayer.addTo(map); 

      }else{
          console.log(xmlhttp.statusText);
      }
  }  
}
/*
xmlhttp.open("GET","http://localhost:8000/js/moselle.geojson",true);
xmlhttp.send(null);
*/
xmlhttp.open("GET","http://localhost:8000/js/test.geojson",false);
xmlhttp.send(null);
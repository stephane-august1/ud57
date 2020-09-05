
//recupere le champ ville
 const champVille = document.getElementById('champ-ville')
console.log(champVille);
// On écoute l'évènement "change" sur le champ ville
champVille.addEventListener("change", function () {
    let champVille2 = $('#champ-ville').val();
   
   
    // Ici nous chercherons les coordonnées GPS de la ville saisie
    ajaxGet(`https://nominatim.openstreetmap.org/search?q=${this.value}&format=json&addressdetails=1&limit=1&polygon_svg=1`).then(reponse => {
        // On convertit la réponse en objet Javascript
        let data = JSON.parse(reponse)
        console.log('data: ', data);
        // On stocke la latitude et la longitude dans la variable ville
        var lon = data[0].lon;
        var lat = data[0].lat;
       //'[49.2207124,6.9240547]'
        ville = ['[' + lat + ', ' + lon + '],',];
        $("#lon").html(data[0].lon);
        $("#lat").html( data[0].lat);
        //on fait un tableau de marker:
        mesmarker = [];
      
        mesmarker = mesmarker.push(data[0].lat+data[0].lon);
        console.log('ville', ville[0]);
        console.log('ville', mesmarker);
        //on affiche le nouveau marker
        //var layer = L.marker([49.1835376,6.874619]).addTo(map);
        for (let i = 0; i < ville.length; i++) {
            //modifier le marker avec une image
var myIcon = L.icon({
    iconUrl: 'goutterigolored.png',
    iconSize: [38, 55],
    iconAnchor: [13, 4],
    popupAnchor: [4, -46],
    //shadowUrl: 'goutterigolo.png',
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
});
        
        var layer = L.marker([data[0].lat, data[0].lon], {
    draggable:true,
    icon: myIcon,
}).addTo(map);
        layer.addTo(map);
    }
//layer.remove();

  
       
          
    })
   
})
   

     

var map = L.map('map').setView([49.0191, 6.6727], 9);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoic3RlcGhhbmVhdWd1c3QxIiwiYSI6ImNrZWltMnZ1bDBhazIyeHBpdGt3b2VuZGQifQ.ROjzrcVm5OlR6YgjB3nJgg'
}).addTo(map);
   


   
//modifier le marker avec une image
var myIcon = L.icon({
    iconUrl: 'goutterigolored.png',
    iconSize: [38, 55],
    iconAnchor: [13, 4],
    popupAnchor: [4, -46],
    //shadowUrl: 'goutterigolo.png',
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
});
//simple marker
/*
var tab = [
    [49.1191, 6.1727],
    [49.0991, 6.0727],
    [48.9991, 6.0927],
    [48.811, 6.1700],

]
for (let i = 0; i < tab.length; i++) {
  var marker = L.marker(
    tab[i],
    {
    draggable:true,
    icon: myIcon,
}).addTo(map);
    
}*/
var marker = L.marker(
    [49.1191, 6.1727],
 {
    draggable:true,
    icon: myIcon,
}
).addTo(map);

marker.bindPopup("<a href='#'>my tooltip text</a>");
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
//marker.bindTooltip("<a href='#'>my tooltip text</a>").openTooltip();



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
xmlhttp.open("GET", "http://localhost:8000/js/moselle.geojson", true);
xmlhttp.setRequestHeader('Access-Control-Allow-Origin','*');

xmlhttp.send(null);*/

xmlhttp.open("GET","http://127.0.0.1:8000/js/test.geojson",true);
xmlhttp.send(null);

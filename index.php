<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map: Drôme Ardèche</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <style>
        #map {
            height: 400px;
        }
        #errors {
            color: red;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <div id="errors"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

     <script>
        
        
        var map = L.map('map').setView([44.75, 4.5], 9); // Centre de la carte sur la Drôme et l'Ardèche

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        L.marker([0, 0]).addTo(map)
            .bindPopup('The center of world 😉')
            .openPopup();


        
    </script>


<?php
$chemin_txt = "load.txt";

$nom_fichier = $chemin_txt;


$handle = fopen($nom_fichier, 'r');


if ($handle) {
    
    while (($ligne = fgets($handle)) !== false) {
        $data = json_decode($ligne, true);
        
        // Afficher le contenu de la ligne
        $latitude = $data["latitude"];
        $longitude = $data["longitude"];
        if ($longitude == null){
            $longitude = 0;
        };
        if ($latitude == null){
            $latitude = 0;
        };
                
               
        echo "<script>L.marker([$latitude, $longitude]).addTo(map)
            .bindPopup('point')
            .openPopup();</script>";
                
    }

    
    fclose($handle);
} else {
    
    echo "Impossible d'ouvrir le fichier.";
}







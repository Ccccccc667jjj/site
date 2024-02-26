 <form method="post">
<input type="submit" name="submit" value="installer les dernier donné du ficher csv">
</form>

<?php

if(isset($_POST['submit'])) {
    echo "demarage ";
$nom_fichier = 'load.txt';
echo "demarage ";
// Vide le contenu du fichier
file_put_contents($nom_fichier, '');



    $chemin_fichier = 'adresses.csv';

// Récupérer le nom de domaine utilisé par l'utilisateur
$domaine = $_SERVER['HTTP_HOST'];

// Ouvrir le fichier en mode lecture
$fichier = fopen($chemin_fichier, 'r');



if ($fichier) {
    $nombre_lignes = 0;

    // Lire chaque ligne du fichier
    while (!feof($fichier)) {
        $ligne = fgets($fichier);
        if ($ligne !== false) {
            // Supprimer les espaces blancs au début et à la fin de la ligne
            $adresse = trim($ligne);
            
            // Effectuer la requête HTTP pour chaque ligne avec le nom de domaine
            $url = "http://$domaine:5000/api?adresse=" . urlencode($adresse);
            
            $response = file_get_contents($url);
            
            // Décoder la réponse JSON
            $data = json_decode($response, true); // Le deuxième paramètre true indique un tableau associatif
            var_dump($data);
            // Vérifier si la réponse a été correctement décodée
            if ($data !== null) {
                $latitude = $data["latitude"];
                $longitude = $data["longitude"];
                if ($longitude == null){
                    $longitude = 0;
                };
                if ($latitude == null){
                    $latitude = 0;
                };
                
                // Afficher les marqueurs sur la carte
                
                
                $texte = '{"latitude":'.$latitude.',"longitude":'.$longitude .'}';
                $texte =  $texte . "\n";
                file_put_contents("load.txt", $texte, FILE_APPEND);
             


                
                
            } else {
                // En cas d'erreur lors du décodage JSON
                echo "Erreur lors de la récupération des données pour l'adresse: $adresse<br>";
            }

            $nombre_lignes++;
        }
        echo "installation fini";
    }

    // Fermer le fichier
    fclose($fichier);

    
} else {
    echo "Impossible d'ouvrir le fichier.";
}
}
?>
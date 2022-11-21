<?php
/*
    Script pour insérer les vins dans la table 'vin' de la BD 'leila'
    à partir du fichier JSON existant (tp1)
*/

// Connexion
$cnx = mysqli_connect('127.0.0.1', 'root', '', 'leila');
// Encodage de caractères
mysqli_set_charset($cnx, 'utf8');

// Lire et décoder le fichier JSON contenant les vins
$carteVinsJson = file_get_contents('data-json/vins-fr.json');
$carteVinsTab = json_decode($carteVinsJson, true);
//print_r($carteVinsTab); // Juste pour débogage

// Boucler à travers les vins groupés par identifiant de catégorie
foreach ($carteVinsTab as $idCat => $vins) {
    foreach ($vins as $vin) {
        // Protéger les chaînes de caractères qui seront concaténées dans la
        // requête SQL ci-dessous pour éviter les attaques par injection SQL
        $nom = mysqli_escape_string($cnx, $vin['nom']);
        $desc = mysqli_escape_string($cnx, $vin['description']);
        $provenance = $vin['provenance'];
        $prix = $vin['prix'];
        mysqli_query($cnx, "INSERT INTO vin VALUES (0, '$nom', '$desc', 
                                                    '$provenance', $prix, $idCat)");
        echo "<p>Vin inséré : $nom</p>";
    }
}

?>
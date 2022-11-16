<?php
/*
    Script pour insérer les plats dans la table 'plat' de la BD 'leila'
    à partir du fichier JSON existant (tp1)
*/

// Connexion
$cnx = mysqli_connect('127.0.0.1', 'root', '', 'leila');
// Encodage de caractères
mysqli_set_charset($cnx, 'utf8');

// Lire et décoder le fichier JSON contenant les plats
$menuJson = file_get_contents('data-json/menu-fr.json');
$menuTab = json_decode($menuJson, true);
//print_r($menuTab); // Juste pour débogage

// Boucler à travers les plats groupés par identifiant de catégorie
foreach ($menuTab as $idCat => $plats) {
    foreach ($plats as $plat) {
        // Protéger les chaînes de caractères qui seront concaténées dans la
        // requête SQL ci-dessous pour éviter les attaques par injection SQL
        $nom = mysqli_escape_string($cnx, $plat['nom']);
        $desc = mysqli_escape_string($cnx, $plat['description']);
        $portion = $plat['portion'];
        $prix = $plat['prix'];
        mysqli_query($cnx, "INSERT INTO plat VALUES (0, '$nom', '$desc', 
                                                    $portion, $prix, $idCat)");
        echo "<p>Plat inséré : $nom</p>";
    }
}

?>
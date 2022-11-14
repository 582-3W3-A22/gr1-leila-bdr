<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier exemple d'intégration PHP/MySQL</title>
</head>
<body>
    <h2>Liste des noms des catégories de la BD <code>leila</code></h2>
    <ul>
        <?php
            // Intégrer les données à partir de la BD MySQL
            // Étape 1 : Se connecter au serveur MySQL
            $connexion = mysqli_connect('localhost', 'root', '');
            // Étape 1bis : choisir l'encodage UTF-8 pour la communication avec 
            // le serveur MySQL
            mysqli_set_charset($connexion, 'utf8');

            // Étape 2 : Sélectionner la BD 'leila'
            mysqli_select_db($connexion, 'leila');

            // Étape 3 : Écrire une requête SQL appropriée 
            // On utilise la commande SELECT avec la *clause* ORDER BY pour trier
            // par un champ (ou colonne) spécifique.
            $sql = "SELECT * FROM categorie ORDER BY id";

            // Étape 4 : Soumettre la requête SQL à la connexion obtenue à l'étape 1
            $resultat = mysqli_query($connexion, $sql);

            // Étape 5 : Afficher le résultat obtenu à l'étape 4 en suivant le 
            // gabarit HTML spécifié dans cette page
            // print_r($resultat); // juste pour déboguer (sinon illégal dans un UL)
            
            // Il faut accéder au résultat, ligne par ligne (autrement dit, un
            // enregistrement à la fois à partir du "jeu d'enregistrements" obtenu
            // dans la variable $resultat)
            //$ligne1 = mysqli_fetch_assoc($resultat);
            //print_r($ligne1); // Juste pour déboguer
            /*
            echo '<hr>';
            $ligne2 = mysqli_fetch_row($resultat);
            print_r($ligne2); // Juste pour déboguer
            echo '<hr>';
            $ligne3 = mysqli_fetch_row($resultat);
            print_r($ligne3); // Juste pour déboguer
            */
            while($ligne = mysqli_fetch_assoc($resultat)) {
        ?>
                <li><?= $ligne['nom']; ?></li>
        <?php
            }
        ?>
        
    </ul>    
</body>
</html>
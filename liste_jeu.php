<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des jeux</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('background other 2.0.png');
            background-size: cover;
            background-position: center;
            background-repeat: repeat;
            height: 100vh;
            overflow-y: auto; /* Ajoutez cette ligne pour activer la barre de défilement vertical */
        }

        h1 {
            color: white;
            text-align: center;
            margin-left: 70%;
            margin-top: 250px;

        }

        h2{
            color: white;
        }

        p{
            color: white;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 75px;
            margin-left: 70%; /* Ajoutez une marge à gauche pour déplacer la liste vers la droite */
        }


        li {
            background-color: indigo;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 15px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        img {
            max-width: 250px; /* ajustez la taille maximale de l'image selon vos besoins */
            height: auto;
        }
    </style>
</head>
<body>

    

</body>
</html>




<?php
session_start();
/*if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}*/

include('connexion_bdd.php');

$query = "SELECT * FROM jeu";
$result = mysqli_query($connexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Jeux</title>
</head>
<body>
    <h1>Liste des Jeux</h1>

    <?php
    // Vérifier s'il y a des jeux dans la base de données
    if (mysqli_num_rows($result) > 0) {
    
        while ($row = mysqli_fetch_assoc($result)) {
                echo "<h2>" . $row['nom'] . "</h2>";
            echo "<p><strong>Catégorie:</strong> " . $row['categorie'] . "</p>";
            echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
            echo "<p><strong>Règle du jeu:</strong> <a href='" . $row['regle_du_jeu'] . "' target='_blank'>Télécharger la règle du jeu (PDF)</a></p>";
            if (!empty($row['photos'])) {
                echo "<img src='" . $row['photos'] . "' alt='" . $row['nom'] . "'>";
            }
            echo "<hr>";
        }
    } else {
    echo "<p>Aucun jeu disponible pour le moment.</p>";
}
    ?>

</body>
</html>

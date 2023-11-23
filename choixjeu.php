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

        form {
            display: inline-block;
            text-align: left;
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
</html>




<?php
session_start();
/*if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}*/

include('param.inc.php');
$connexion = new mysqli($host, $login, $passwd, $dbname);
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
        echo "</p>les jeux existants sont les suivants.</p>";
        while ($row = mysqli_fetch_assoc($result)) {
                echo "<h2>" . $row['nom'] . "</h2>";
            echo "<p><strong>Catégorie:</strong> " . $row['categorie'] . "</p>";
            echo "<p><strong>Description:</strong> " . $row['descriptions'] . "</p>";
            echo "<p><strong>Règle du jeu:</strong> <a href='" . $row['regle_du_jeu'] . "' target='_blank' download> lire la règle du jeu (PDF)</a></p>";
            if (!empty($row['photos'])) {
                echo "<img src='" . $row['photos'] . "' alt='" . $row['nom'] . "'>";
            }
            echo "<hr>";
            
        }
    } else {
    echo "<p>Aucun jeu disponible pour le moment.</p>";
    }
    ?>

<div class="col-md-6">
                    <p class="texte-capitalize py-3 redressed banner-desc"> Bienvenue membre! </p>
                </div>
                <div class="col-md-6">
                    <h1 class="texte-capitalize py-3 redressed banner-desc">
                        Indiquer les jeux auxquels vous souhaitez jouer
                    </h1>    
                    <form action="liste_jeu.php" method="post">
                        <label for="jeu">Sélectionnez un jeu :</label>
                        <select name="jeu" id="jeu">
                            <option value="Jeu 1">jeu de Carte</option>
                            <option value="Jeu 2">jeu UNO</option>
                            <option value="Jeu 3">jeu de Scrable</option>
                            <option value="Jeu 4">jeu de Monopoly</option>
                            <option value="Jeu 5">jeu de Société</option>
                           
                        </select>
                        <button type="submit">Soumettre</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

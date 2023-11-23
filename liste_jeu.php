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

        echo "<div style='margin-left: 10%; margin-right: 10%;'>";

        echo "<h1 style='color: white;'>Les jeux existants sont les suivants :</h1>";

   

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<div style='border: 1px solid #ddd;background-color: indigo; border-radius: 5px; padding: 15px; margin-bottom: 20px;'>";

            echo "<h2 style='color: white;'>" . $row['nom'] . "</h2>";

            echo "<p><strong>Catégorie:</strong> " . $row['categorie'] . "</p>";

            echo "<p><strong>Description:</strong> " . $row['descriptions'] . "</p>";

            if (!empty($row['photos'])) {

                echo "<img src='" . $row['photos'] . "' alt='" . $row['nom'] . "' style='max-width: 250px; height: auto;'>";

            }

            echo "<p style='margin-top: 10px;'><strong>Règle du jeu:</strong> <a href='" . $row['regle_du_jeu'] . "' target='_blank' download style='color: #3498db;'>Lire la règle du jeu (PDF)</a></p>";

            echo "</div>";

        }

   

        echo "</div>";

    } else {

        echo "<p style='color: white;'>Aucun jeu trouvé.</p>";

    }


//Telechargement des fichiers

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si des fichiers ont été téléchargés
    if (isset($_FILES['pdf_file']) && isset($_FILES['image_file'])) {
        // Chemin où les fichiers seront enregistrés
        $uploadDirectory = 'uploads/';

        // Nom du fichier PDF
        $regle_du_jeu = basename($_FILES['pdf_file']['name']);
        $pdfTargetPath = $uploadDirectory . $regle_du_jeu;

        // Nom du fichier image
        $photos = basename($_FILES['image_file']['name']);
        $imageTargetPath = $uploadDirectory . $photos;

        // Télécharger le fichier PDF
        if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $pdfTargetPath)) {
            echo "Le fichier PDF $regle_du_jeu a été téléchargé avec succès.<br>";
        } else {
            echo "Erreur lors du téléchargement du fichier PDF.<br>";
        }

        // Télécharger le fichier image
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $imageTargetPath)) {
            echo "Le fichier image $photos a été téléchargé avec succès.<br>";
        } else {
            echo "Erreur lors du téléchargement du fichier image.<br>";
        }
    } else {
        echo "Veuillez sélectionner à la fois un fichier PDF et une image.<br>";
    }
}
    ?>
<form method="POST" action="traitementJeu.php">

<label for="nom">Nom:</label>
<input type="text" id="nom" name="nom" required>
<br>

<label for="categorie">Categorie:</label>
<input type="text" id="categorie" name="categorie" required>
<br>

<label for="email">Description:</label>
<input type="text" id="descriptions" name="descriptions" required>
<br>


        <label for="regle_du_jeu">Fichier PDF :</label>
        <input type="file" name="regle_du_jeu" accept=".pdf" required>
        <br>

        <label for="photos">Fichier Image :</label>
        <input type="file" name="photos" accept="image/*" required>
        <br>

        <input type="submit" value="valider">
    </form>
</body>
</html>


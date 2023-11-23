<?php
// Vérifier si l'utilisateur est connecté
session_start();
/*if (!isset($_SESSION['id_utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}*/

// Inclure la connexion à la base de données et d'autres fichiers nécessaires
include('param.inc.php'); // Assurez-vous d'adapter le nom du fichier selon votre configuration

$mysqli = new mysqli($host, $login, $passwd, $dbname);
// Récupérer la liste complète des jeux depuis la base de données
$query = "SELECT * FROM jeu";
$resultat = $mysqli->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil Membre</title>
    <!-- Ajoutez des liens vers vos fichiers CSS et autres ressources ici -->
    <style>
         body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-image: url('background other 2.0.png');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
         height: 100vh;
         overflow: hidden;

        }
        header {
         text-align: center;
         padding: 10px;
         background-color: #f2f2f2;
        }
        main {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 100%;
         color: white;
        }
        .button-container {
         width: 60vw;
         max-width: 600px;
         height: 40vh;
         display: flex;
         justify-content: space-between;
         align-items: flex-start;
         font-size: 4vw;
        }

        button {    
         font-size: 2vw; 
         font-weight: lighter;
         color: white;
         padding: 2vh 5vw;
         background: #000000;
         outline: none;
         cursor: pointer;
         border: none;
         border-radius: 2vw; 
         box-shadow: 0 1vh #000000;
         padding: 10px;
        }
        .game-section {
         margin-top: 20px;
         text-align: center;
        }

        .game-image {
         max-width: 50px; /* Réduire davantage la largeur de l'image */
         max-height: 50px; /* Réduire la hauteur de l'image */
         margin: 5px; /* Ajouter une marge autour de l'image */
        }

        @media (max-width: 600px) {
         .button-container {
            font-size: 8vw;
         }
        }

        label{
            color:white;
        }
        h1{
            color:white;
        }
        p{
            color:white;
        }
        form {
            display: inline-block;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input {
            padding: 8px;
            margin-bottom: 10px;
        }
        
        #result {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <!-- Ajoutez l'en-tête de la page et tout autre élément de navigation ici -->
    <h1>bon retour!</h1>
    <p>Que souhaitez-vous faire?</p>

    <!-- Liens vers les pages spécifiques pour les membres -->
   <div>
     <ul>
        <li><a href="pcjeux.php">prendre en charge un jeu</a></li>
        <li><a href="jeux_souhaitees.php">liste de jeux des membres</a></li> <!--proposition de créneau dedans, annulation des créneaux(tout en prévénant le joueur dans ce cas) -->
        <li><a href="admincree.php">creer un compte admin</a></li>
    
     </ul>
    </div>
    <!-- Ajoutez le pied de page et tout autre contenu supplémentaire ici -->

   
<body>


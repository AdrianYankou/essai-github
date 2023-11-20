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

    <h1>Liste des jeux</h1>

    <ul>
        <li>
            <input type="checkbox" id="jeu1">
            <div>
                <h2>Monopoly</h2>
                <img src="monopoly_image.jpg" alt="monopoly">
                <p>Un membre :
                    • Accède à la liste complète des jeux, avec tous les détails,
                    • Peut indiquer les jeux auxquels il souhaite jouer,
                    • Peut voir les parties à venir, avec les membres déjà inscrits. S’il le souhaite, il
                    peut s’inscrire pour participer,
                    • Bonus : Peut consulter l’historique des jeux auxquels il a joué.
                    Un administrateur :
                    • Peut ajouter, modifier ou supprimer des jeux,
                    • Peut consulter la liste des jeux auxquels les membres souhaitent jouer,
                    • Peut proposer un créneau pour jouer à un jeu donné,
                    • Bonus : Peut annuler un créneau de jeu (par exemple s’il n’y a pas assez d’inscrits). Les joueurs déjà inscrits sur ce créneau seront prévenus,
                    • Bonus : Peut créer un compte pour un autre administrateur.
                </p>
            </div>
        </li>

        <li>
            <input type="checkbox" id="jeu2">
            <div>
                <h2>Ludo</h2>
                <img src="ludo_image.jpg" alt="Ludo">
                <p>Description de l'article 2.</p>
            </div>
        </li>

        <li>
            <input type="checkbox" id="jeu3">
            <div>
                <h2>Jeu d'échecs</h2>
                <img src="chess_image.jpg" alt="chess">
                <p>Description de l'article 2.</p>
            </div>
        </li>

        <li>
            <input type="checkbox" id="jeu4">
            <div>
                <h2>jeu de dames</h2>
                <img src="dames_image.jpeg" alt="dames">
                <p>Description de l'article 2.</p>
            </div>
        </li>

        <li>
            <input type="checkbox" id="jeu5">
            <div>
                <h2>UNO</h2>
                <img src="uno_image.jpeg" alt="uno">
                <p>Description de l'article 2.</p>
            </div>
        </li>
    </ul>

</body>
</html>





<?php

session_start(); // Démarrage de la session pour stocker des messages entre les pages

// Fonction de connexion à la base de données
function connectDB() {
    require_once("connexion_bdd.php");
    $mysqli = new mysqli($host, $login, $passwd, $dbname);
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
    return $mysqli;
}

// Fonction de redirection avec message
function redirectTo($location, $message) {
    $_SESSION['message'] = $message;
    header("Location: $location");
    exit();
}

$email = $_POST['username']; 
$password = $_POST['password']; 

$mysqli = connectDB(); // Connexion à la base de données

// Préparation de la requête SQL avec une requête préparée pour éviter les injections SQL
if ($stmt = $mysqli->prepare("SELECT motdepasse, statut FROM utilisateur WHERE mail=? ")) {
    $stmt->bind_param("s", $email); // Liaison des paramètres
    $stmt->execute(); // Exécution de la requête
    $result = $stmt->get_result(); // Récupération des résultats

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Récupération de la première ligne de résultat

        // Vérification du mot de passe avec password_verify
        if (password_verify($password, $row["motdepasse"])) {
            // Redirection en fonction du statut de l'utilisateur
            if ($row["statut"] == "admin") {
                header('Location:admin.php');
            } elseif ($row["statut"] == "membre") {
                header('Location:sessionmembre.php');
            } else {
                redirectTo('index.php', 'Authentification réussie pour un rôle inconnu.');
            }
        } else {
            redirectTo('index.php', 'Mot de passe incorrect.');
        }
    } else {
        redirectTo('index.php', 'Identifiant inexistant.');
    }
} else {
    // En cas d'erreur de préparation de la requête
    redirectTo('connexion.html', 'Erreur lors de l\'authentification.');
}
?>







<?php

 

  session_start(); // Pour les massages

 

 

  $mail =  htmlentities($_POST['email']);

  $password = htmlentities($_POST['password']);

 

  // Connexion :

  require_once("param.inc.php");

  $mysqli = new mysqli($host, $login, $password, $dbname);

  if ($mysqli->connect_error) {

      die('Erreur de connexion (' . $mysqli->connect_errno . ') '

              . $mysqli->connect_error);

  }

 

 

 

 

  if ($stmt = $mysqli->prepare("SELECT * FROM users WHERE email=? limit 1"))

  {

   

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();  

 

    if($result->num_rows > 0)

    {    

     

        $row = $result->fetch_assoc();

            if (password_verify($password,$row["password"]))

            {

              echo "connexion reussi";

                  // Redirection vers la page admin.php ou autres pages en fonction du role (tuteur,admin, etc.);

                  $_SESSION['PROFILE']=$row;

                //$_SESSION['message'] = "Authentification réussi pour un role inconnu.";

                if($row["role"]==admin){

                 

                  $_SESSION['message'] = "Authentification réussi pour un admin.";

                 

                   header('Location: admin.php');

                }

                if($row["role"]==membre)

                {

                $_SESSION['message'] = "Authentification réussi pour un membre.";

                 header('Location: sessionmembre.php');

              }          

           

              }else {

                // Redirection vers la page d'authetification connexion.php

              $_SESSION['message'] = "Erreur de connexion";

                 header('Location: connexion.html');

               

              }    

       

    }else{

       

      $_SESSION['message'] = "Erreur de connexion";

         header('Location: conne.php');

        }

    }

 

?>
<?php
session_start(); // Démarrage de la session pour stocker des messages entre les pages

// Fonction de connexion à la base de données
function connectDB() {
    require_once("param.inc.php");
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

$email = $_POST['e-mail']; 
$password = $_POST['mot de passe']; 

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
                header("Location:menuadmin.php");
            } elseif ($row["statut"] == "membre") {
                header("Location:menumembre.php");
            } else {
                redirectTo('connexion.php', 'Authentification réussie pour un rôle inconnu.');
            }
        } else {
            redirectTo('connexion.php', 'Mot de passe incorrect.');
        }
    } else {
        redirectTo('connexion.php', 'Identifiant inexistant.');
    }
}
?>
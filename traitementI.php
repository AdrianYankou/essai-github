<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$motdepasse = $_POST['motdepasse'];
$datedenaissance = $_POST['datedenaissance'];

$servername = "localhost";
$username = "root"; // L'utilisateur par défaut de MySQL dans XAMPP
$passwords = ""; // Laissez le mot de passe vide par défaut

// Nom de la base de données que vous avez créée dans phpMyAdmin
$database = "projet";

//pour la vérification du statut
$statut = "membre";

// Créer une connexion
$conn = new mysqli($servername, $username, $passwords, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
} 
else 
{
    // Vérifier si l'utilisateur existe déjà
    $checkUserQuery = "SELECT * FROM utilisateur WHERE mail='$mail'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        echo "Erreur : L'utilisateur avec l'adresse e-mail '$mail' existe déjà.";
    } else {
        // Hacher le mot de passe
        $hashedPassword = password_hash($motdepasse, PASSWORD_DEFAULT);

        // Insérer l'utilisateur avec le mot de passe haché
        $insertUserQuery = "INSERT INTO utilisateur (nom,prenom,email,datedenaissance,motdepasse,statut) VALUES ('$nom','$prenom','$mail','$datedenaissance','$hashedPassword','$statut')";
        header("Location:index.php");

    }
}

$conn->close();
?>
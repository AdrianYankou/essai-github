<?php



$nom = $_POST['nom'];
$categorie = $_POST['categorie'];
$description = $_POST['descriptions'];
$regle_du_jeu= $_POST['regle_du_jeu'];
$photos=$_POST['photos'];



$servername = "localhost";
$username = "grp_6_2"; // L'utilisateur par défaut de MySQL dans XAMPP
$passwords = "18Oxc2vCTssy"; // Laissez le mot de passe vide par défaut


// Nom de la base de données que vous avez créée dans phpMyAdmin
$database = "bdd_6_2";



// Créer une connexion
$conn = new mysqli($servername, $username, $passwords, $database);




// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
} 
else 
{
    // Vérifier si l'utilisateur existe déjà
    $checkUserQuery = "SELECT * FROM jeu WHERE nom='$nom'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        echo "Erreur : Le jeu '$nom' existe déjà.";
    } else {

        // Insérer l'utilisateur avec le mot de passe haché
        $insertUserQuery = "INSERT INTO jeu (nom,categorie,descriptions,regle_du_jeu,photos) values ('$nom','$categorie','$description','$regle_du_jeu','$photos')";

        if ($conn->query($insertUserQuery) === TRUE) {
            header('Location: connexion.php');
            exit(); // Assure une sortie immédiate après la redirection
        } else {
            echo "Erreur lors de l'inscription : " . $conn->error . " Query: " . $insertUserQuery;
        }
        
    }
}

$conn->close();
?>
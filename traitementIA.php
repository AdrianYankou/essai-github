<?php



$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password'];

//pour la vérification du statut
$statut = "admin";

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
    $checkUserQuery = "SELECT * FROM utilisateur WHERE email='$email'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        echo "Erreur : L'utilisateur avec l'adresse e-mail '$email' existe déjà.";
    } else {
        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur avec le mot de passe haché
        $insertUserQuery = "INSERT INTO utilisateur (nom,prenom,email,password,statut) values ('$nom','$prenom','$email','$hashedPassword','$statut')";

        if ($conn->query($insertUserQuery) === TRUE) {
            header('Location: admin.php');
            exit(); // Assure une sortie immédiate après la redirection
        } else {
            echo "Erreur lors de l'inscription : " . $conn->error . " Query: " . $insertUserQuery;
        }
        
    }
}

$conn->close();
?>
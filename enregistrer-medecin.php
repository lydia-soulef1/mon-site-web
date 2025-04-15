<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
include 'db.php';

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hacher le mot de passe
$specialite = $_POST['specialite'];
$numero_licence = $_POST['numero_licence'];

// Insérer les données dans la table medecins
$sql = "INSERT INTO medecins (nom, prenom, email, password, specialite, numero_licence)
        VALUES ('$nom', '$prenom', '$email', '$password', '$specialite', '$numero_licence')";


if ($conn->query($sql) === TRUE) {
    // Rediriger vers la page de connexion après l'inscription
    header("Location: connexion-medecin.html");
    exit(); // Assurez-vous de terminer le script après la redirection
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$conn->close();
?>
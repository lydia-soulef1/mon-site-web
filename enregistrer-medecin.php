<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion PostgreSQL
$conn = pg_connect("host=localhost dbname=vaccination_infantile user=postgres password=your_password");

if (!$conn) {
    die("Connexion échouée : " . pg_last_error());
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$specialite = $_POST['specialite'];
$numero_licence = $_POST['numero_licence'];

// Préparer la requête SQL avec des paramètres
$query = "INSERT INTO medecins (nom, prenom, email, password, specialite, numero_licence)
          VALUES ($1, $2, $3, $4, $5, $6)";

$params = [$nom, $prenom, $email, $password, $specialite, $numero_licence];

$result = pg_query_params($conn, $query, $params);

if ($result) {
    // Rediriger après inscription réussie
    header("Location: connexion-medecin.html");
    exit();
} else {
    echo "Erreur lors de l'inscription : " . pg_last_error($conn);
}

// Fermer la connexion
pg_close($conn);
?>

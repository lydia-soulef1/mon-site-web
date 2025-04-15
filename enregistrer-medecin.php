<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion PostgreSQL
$conn = pg_connect("host=localhost dbname=vaccination_infantile user=postgres password=your_password");

if (!$conn) {
    die("Connexion échouée : " . pg_last_error());
}

// Récupérer et nettoyer les données du formulaire
$name = pg_escape_string($_POST['name']);
$email = pg_escape_string($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$hospital = pg_escape_string($_POST['hospital']);
$rpps_number = pg_escape_string($_POST['rpps_number']);

// Vérifier d'abord si l'email existe déjà
$check_query = "SELECT id FROM pediatricians WHERE email = $1";
$check_result = pg_query_params($conn, $check_query, [$email]);

if (pg_num_rows($check_result) > 0) {
    pg_close($conn);
    header("Location: register_pediatrician.php?error=email_exists");
    exit();
}

// Vérifier si le numéro RPPS existe déjà
$check_rpps_query = "SELECT id FROM pediatricians WHERE rpps_number = $1";
$check_rpps_result = pg_query_params($conn, $check_rpps_query, [$rpps_number]);

if (pg_num_rows($check_rpps_result) > 0) {
    pg_close($conn);
    header("Location: register_pediatrician.php?error=rpps_exists");
    exit();
}

// Préparer et exécuter la requête d'insertion
$insert_query = "INSERT INTO pediatricians (name, email, password, hospital, rpps_number)
                VALUES ($1, $2, $3, $4, $5) RETURNING id";

$params = [$name, $email, $password, $hospital, $rpps_number];
$result = pg_query_params($conn, $insert_query, $params);

if ($result) {
    // Démarrer la session et stocker les informations
    session_start();
    $row = pg_fetch_assoc($result);
    $_SESSION['pediatrician_id'] = $row['id'];
    $_SESSION['pediatrician_name'] = $name;
    $_SESSION['pediatrician_email'] = $email;
    $_SESSION['user_type'] = 'pediatrician';
    
    pg_close($conn);
    header("Location: pediatrician_dashboard.php");
    exit();
} else {
    // Journaliser l'erreur détaillée
    error_log("Erreur d'inscription pédiatre: " . pg_last_error($conn));
    pg_close($conn);
    header("Location: register_pediatrician.php?error=database");
    exit();
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

// Récupération des données du formulaire
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

try {
    // Vérifier si l'email existe déjà
    $stmt = $conn->prepare("SELECT id FROM parents WHERE email = :email");
    $stmt->execute([':email' => $email]);
    
    if ($stmt->rowCount() > 0) {
        header("Location: register_parent.php?error=email_exists");
        exit();
    }

    // Insérer le parent dans la table parents
    $sql = "INSERT INTO parents (name, email, password) 
            VALUES (:name, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $password
    ]);
    
    // Démarrer la session et stocker l'ID du parent
    session_start();
    $_SESSION['parent_id'] = $conn->lastInsertId();
    $_SESSION['parent_name'] = $name;
    $_SESSION['parent_email'] = $email;

    // Rediriger vers la page d'ajout d'enfant
    header("Location: add_child.php");
    exit();

} catch (PDOException $e) {
    // Journaliser l'erreur et rediriger
    error_log("Erreur d'inscription: " . $e->getMessage());
    header("Location: register_parent.php?error=database");
    exit();
}
?>
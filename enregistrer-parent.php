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
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$enfant_nom = $_POST['enfant-nom'];
$enfant_age = $_POST['enfant-age'];

// Insérer les données dans la table parents
$sql = "INSERT INTO parents (nom, prenom, email, password, enfant_nom, enfant_age)
VALUES ('$nom', '$prenom', '$email', '$password', '$enfant_nom', '$enfant_age')";

if ($conn->query($sql) === TRUE) {
    $parent_id = $conn->insert_id;

    $vaccins = [
        ['Vaccin 3 mois', 3],
        ['Vaccin 6 mois', 6],
        ['Vaccin 12 mois', 12],
    ];

    foreach ($vaccins as $vaccin) {
        $nom_vaccin = $vaccin[0];
        $age_vaccin = $vaccin[1];

        $date_vaccin = date('Y-m-d', strtotime("+$age_vaccin months", strtotime("-$enfant_age months")));

        $sql_vaccin = "INSERT INTO vaccins (parent_id, nom_vaccin, age_vaccin, date_vaccin)
                       VALUES ('$parent_id', '$nom_vaccin', '$age_vaccin', '$date_vaccin')";
        if (!$conn->query($sql_vaccin)) {
            echo "Erreur lors de l'insertion du vaccin : " . $conn->error;
        }
    }

    // Redirection via JavaScript avec stockage dans localStorage
    echo "<script>
        localStorage.setItem('username', '" . addslashes($prenom) . "');
        window.location.href = '../index.html';
    </script>";
    exit();
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

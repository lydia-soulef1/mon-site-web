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
$enfant_nom = $_POST['enfant-nom'];
$enfant_age = $_POST['enfant-age']; // Âge de l'enfant en mois

// Insérer les données dans la table parents
$sql = "INSERT INTO parents (nom, prenom, email, password, enfant_nom, enfant_age)
VALUES ('$nom', '$prenom', '$email', '$password', '$enfant_nom', '$enfant_age')";

if ($conn->query($sql) === TRUE) {
    $parent_id = $conn->insert_id; // Récupérer l'ID du parent inséré

    // Ajouter les vaccins programmés en fonction de l'âge de l'enfant
    $vaccins = [
        ['Vaccin 3 mois', 3],  // Vaccin à 3 mois
        ['Vaccin 6 mois', 6],  // Vaccin à 6 mois
        ['Vaccin 12 mois', 12], // Vaccin à 12 mois
        // Ajoutez d'autres vaccins ici
    ];

    foreach ($vaccins as $vaccin) {
        $nom_vaccin = $vaccin[0];
        $age_vaccin = $vaccin[1];

        // Calculer la date du vaccin en fonction de l'âge de l'enfant
        $date_vaccin = date('Y-m-d', strtotime("+$age_vaccin months", strtotime("-$enfant_age months")));

        // Insérer le vaccin dans la table vaccins
        $sql_vaccin = "INSERT INTO vaccins (parent_id, nom_vaccin, age_vaccin, date_vaccin)
                       VALUES ('$parent_id', '$nom_vaccin', '$age_vaccin', '$date_vaccin')";
        if (!$conn->query($sql_vaccin)) {
            echo "Erreur lors de l'insertion du vaccin : " . $conn->error;
        }
    }

    // Rediriger vers la page du calendrier après l'inscription
    header("Location: calendrier-parent.php?parent_id=$parent_id");
    exit(); // Assurez-vous de terminer le script après la redirection
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$conn->close();
?>
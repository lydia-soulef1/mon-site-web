<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$enfant_nom = $_POST['enfant-nom'];
$enfant_age = $_POST['enfant-age'];

try {
    // Insérer dans parents
    $sql = "INSERT INTO parents (nom, prenom, email, password, enfant_nom, enfant_age)
            VALUES (:nom, :prenom, :email, :password, :enfant_nom, :enfant_age)
            RETURNING id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':password' => $password,
        ':enfant_nom' => $enfant_nom,
        ':enfant_age' => $enfant_age
    ]);

    // Récupérer l'ID du parent inséré
    $parent_id = $stmt->fetchColumn();

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
                       VALUES (:parent_id, :nom_vaccin, :age_vaccin, :date_vaccin)";
        $stmt_vaccin = $conn->prepare($sql_vaccin);
        $stmt_vaccin->execute([
            ':parent_id' => $parent_id,
            ':nom_vaccin' => $nom_vaccin,
            ':age_vaccin' => $age_vaccin,
            ':date_vaccin' => $date_vaccin
        ]);
    }

    echo "<script>
        localStorage.setItem('username', '" . addslashes($prenom) . "');
        window.location.href = '../index.html';
    </script>";
    exit();

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

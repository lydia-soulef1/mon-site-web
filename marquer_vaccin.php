<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vaccin_id = $_POST['vaccin_id'];
    $enfant_id = $_POST['enfant_id'];

    // Sécurité : vérifier que le vaccin appartient bien à un enfant du parent
    $stmt = $pdo->prepare("SELECT v.id FROM vaccinations v JOIN children c ON v.enfant_id = c.id WHERE v.id = ? AND c.parent_id = ?");
    $stmt->execute([$vaccin_id, $_SESSION['parent_id']]);
    if ($stmt->rowCount() === 0) {
        exit('Action non autorisée.');
    }

    // Mettre à jour le statut
    $update = $pdo->prepare("UPDATE vaccinations SET statut = 'fait' WHERE id = ?");
    $update->execute([$vaccin_id]);

    // Redirection vers le calendrier
    header("Location: calendrier.php?enfant_id=" . $enfant_id);
    exit();
}

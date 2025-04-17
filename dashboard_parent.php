<?php
session_start();
// Connexion à la base de données
include 'db.php';

// Vérification si le parent est connecté
if (!isset($_SESSION['parent_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer les enfants de ce parent
$parent_id = $_SESSION['parent_id'];
$sql = $pdo->prepare("SELECT * FROM enfants WHERE parent_id = ?");
$sql->execute([$parent_id]);
$enfants = $sql->fetchAll();

// Récupérer les notifications (exemple simple)
$notif_sql = $pdo->prepare("SELECT message FROM notifications WHERE parent_id = ?");
$notif_sql->execute([$parent_id]);
$notifications = $notif_sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Parent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen p-6">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold text-blue-600 mb-6">👋 Bonjour, <?php echo $_SESSION['parent_name']; ?> !</h1>

        <!-- Ajouter un enfant -->
        <div class="mb-8">
            <a href="ajouter_enfant.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                ➕ Ajouter un enfant
            </a>
        </div>

        <!-- Liste des enfants -->
        <h2 class="text-2xl font-semibold mb-4">👶 Vos enfants :</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($enfants as $enfant): ?>
                <div class="bg-white shadow-md rounded p-4">
                    <h3 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($enfant['nom']); ?></h3>
                    <p>Date de naissance : <?php echo htmlspecialchars($enfant['date_naissance']); ?></p>
                    <a href="calendrier.php?enfant_id=<?php echo $enfant['id']; ?>"
                       class="mt-4 inline-block text-blue-500 hover:underline">
                        📅 Voir le calendrier
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Notifications -->
        <h2 class="text-2xl font-semibold mt-10 mb-4">🔔 Notifications :</h2>
        <ul class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
            <?php if (count($notifications) > 0): ?>
                <?php foreach ($notifications as $notif): ?>
                    <li class="mb-2">• <?php echo htmlspecialchars($notif['message']); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucune notification pour le moment.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>

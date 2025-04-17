<?php
session_start();

include 'db.php';
// Vérifier que le parent est connecté
if (!isset($_SESSION['parent_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifier que l'ID de l'enfant est passé dans l'URL
if (!isset($_GET['enfant_id'])) {
    echo "Enfant non spécifié.";
    exit();
}

$enfant_id = $_GET['enfant_id'];

// Récupérer les données de l'enfant
$stmt = $pdo->prepare("SELECT * FROM children WHERE id = ? AND parent_id = ?");
$stmt->execute([$enfant_id, $_SESSION['parent_id']]);
$enfant = $stmt->fetch();

if (!$enfant) {
    echo "Enfant non trouvé.";
    exit();
}

// Récupérer les vaccins
$stmt = $pdo->prepare("SELECT * FROM vaccinations WHERE enfant_id = ? ORDER BY date_vaccination ASC");
$stmt->execute([$enfant_id]);
$vaccinations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier de Vaccination</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen px-4 py-6">
    <div class="max-w-3xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-blue-400 mb-6 text-center">📅 Calendrier de Vaccination</h1>
        <h2 class="text-xl mb-4 text-center">Enfant : <span class="text-white font-semibold"><?php echo htmlspecialchars($enfant['name']); ?></span></h2>

        <?php if (count($vaccinations) > 0): ?>
            <div class="space-y-4">
                <?php foreach ($vaccinations as $vaccin): ?>
                    <div class="p-4 bg-gray-700 rounded-lg flex justify-between items-center">
                        <div>
                            <p class="text-lg font-bold"><?php echo htmlspecialchars($vaccin['nom_vaccin']); ?></p>
                            <p class="text-sm text-gray-300">🗓️ <?php echo date('d/m/Y', strtotime($vaccin['date_vaccination'])); ?></p>
                        </div>
                        <div>
                            <?php if ($vaccin['statut'] == 'fait'): ?>
                                <span class="px-3 py-1 bg-green-600 text-white rounded-full">✅ Fait</span>
                            <?php else: ?>
                                <form action="marquer_vaccin.php" method="POST" class="inline">
                                    <input type="hidden" name="vaccin_id" value="<?php echo $vaccin['id']; ?>">
                                    <input type="hidden" name="enfant_id" value="<?php echo $enfant_id; ?>">
                                    <button type="submit" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Marquer comme fait
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-400">Aucun vaccin programmé pour cet enfant.</p>
        <?php endif; ?>

        <div class="mt-6 text-center">
            <a href="dashboard_parent.php" class="text-blue-400 hover:underline">← Retour au tableau de bord</a>
        </div>
    </div>
</body>
</html>

<?php
session_start();
include 'db.php';

// Vérifie si le parent est connecté
if (!isset($_SESSION['parent_id'])) {
    header("Location: login.php");
    exit();
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $parent_id = $_SESSION['parent_id'];

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO children (parent_id, name, dob, gender) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$parent_id, $name, $dob, $gender])) {
        header("Location: dashboard_parent.php");
        exit();
    } else {
        $error = "Erreur lors de l'ajout de l'enfant.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un enfant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex justify-center items-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-blue-400 mb-6">Ajouter un enfant</h2>

        <?php if (isset($error)): ?>
            <div class="bg-red-500 text-white px-4 py-2 mb-4 rounded">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <!-- Nom -->
            <div class="mb-4">
                <label for="name" class="block mb-2 text-lg">Nom de l'enfant</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Date de naissance -->
            <div class="mb-4">
                <label for="dob" class="block mb-2 text-lg">Date de naissance</label>
                <input type="date" name="dob" id="dob" required
                    class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Genre -->
            <div class="mb-6">
                <label for="gender" class="block mb-2 text-lg">Genre</label>
                <select name="gender" id="gender" required
                    class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Choisir --</option>
                    <option value="M">Garçon</option>
                    <option value="F">Fille</option>
                </select>
            </div>

            <!-- Soumettre -->
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                Enregistrer
            </button>

            <!-- Retour -->
            <div class="text-center mt-4">
                <a href="dashboard_parent.php" class="text-blue-400 hover:underline">← Retour au tableau de bord</a>
            </div>
        </form>
    </div>
</body>
</html>

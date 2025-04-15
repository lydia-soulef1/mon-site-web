<?php
$host = 'localhost';
$db   = 'vaccins'; // اسم قاعدة البيانات في PostgreSQL
$user = 'postgres';
$pass = 'postgre14'; // ضع كلمة مرور PostgreSQL هنا
$port = '5432'; // المنفذ الافتراضي

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

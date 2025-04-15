<?php
$host = 'localhost';
$db   = 'vaccins'; // اسم قاعدة البيانات في PostgreSQL
$user = 'postgres';
$pass = 'lydialydia7@'; // ضع كلمة مرور PostgreSQL هنا
$port = '5432'; // المنفذ الافتراضي

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
raki sure dak mdps ? drtih f postgres wh ki tl3 gli diri mdps drt da
ok
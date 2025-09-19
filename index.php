<?php

$host = getenv('DB_HOST');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    echo "データベース接続成功！";
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage();
}
?>

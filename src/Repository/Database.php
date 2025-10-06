<?php
namespace App\Repository;

use PDO;
use PDOException;

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): PDO {
        if (self::$connection === null) {
            try {
                $host = $_ENV['DB_HOST'] ?? 'db';
                $dbname = $_ENV['DB_DATABASE'] ?? 'testdb';
                $user = $_ENV['DB_USER'] ?? 'testuser';
                $pass = $_ENV['DB_PASSWORD'] ?? 'testpass';

                $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
                self::$connection = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("DB接続エラー: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}

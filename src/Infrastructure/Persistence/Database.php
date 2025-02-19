<?php

namespace App\Infrastructure\Persistence;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            try {
//                $dbHost = getenv('DB_HOST');
//                $dbName = getenv('DB_NAME');
//                $dbUser = getenv('DB_USER');
//                $dbPassword = getenv('DB_PASSWORD');
                $dbHost = $_ENV['DB_HOST'];
                $dbName = $_ENV['DB_NAME'];
                $dbUser = $_ENV['DB_USER'];
                $dbPassword = $_ENV['DB_PASSWORD'];

                $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
                self::$pdo = new PDO($dsn, $dbUser, $dbPassword, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function getConnectionPg(): PDO
    {
        if (self::$pdo === null) {
            try {
                $dbHost = $_ENV['DB_HOST'] ?? 'localhost';
                $dbPort = $_ENV['DB_PORT'] ?? '5432';
                $dbName = $_ENV['DB_NAME'] ?? 'database';
                $dbUser = $_ENV['DB_USER'] ?? 'user';
                $dbPassword = $_ENV['DB_PASSWORD'] ?? 'password';
                
                $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName";
                self::$pdo = new PDO($dsn, $dbUser, $dbPassword, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Error de conexión a PostgreSQL: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

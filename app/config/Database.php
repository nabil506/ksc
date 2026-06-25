<?php

namespace app\config;

use PDO;
use PDOException;

class Database
{
    private static $host = 'localhost';
    private static $db_name = 'ksc';
    private static $username = 'root';
    private static $password = 'nabil12345';
    private static $conn = null;

    public static function getConnection()
    {
        // Jika belum ada koneksi yang terbuka, buat koneksi baru (Singleton Pattern)
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username,
                    self::$password
                );

                // Atur pemicu eror jika query SQL ada yang ngawur
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Otomatis ubah hasil query data menjadi Array Asosiatif yang rapi
                self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                die("Koneksi Database Gagal: " . $exception->getMessage());
            }
        }
        return self::$conn;
    }
}

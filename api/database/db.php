<?php
require_once __DIR__ . '/../config/config.php';

class DB {
    private static ?mysqli $conn = null;

    public static function conn(): mysqli
    {
        if (self::$conn === null) {
            self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (self::$conn->connect_errno) {
                throw new Exception("Connection error: " . self::$conn->connect_error);
            }
        }

        return self::$conn;
    }
}

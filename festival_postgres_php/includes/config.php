<?php
$DB_HOST = "localhost";
$DB_PORT = "5432";
$DB_NAME = "festival_db";
$DB_USER = "postgres";
$DB_PASS = "";   // postgres password टाक

try {
    $pdo = new PDO(
        "pgsql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME",
        $DB_USER,
        $DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

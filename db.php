<?php
// Update these settings to match your local MySQL configuration.
$host = 'localhost'; $dbname = 'studora_db'; $username = 'root'; $password = '';
try { $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]); }
catch(PDOException $e) { http_response_code(500); die('Database connection failed. Import database.sql and check backend/db.php settings.'); }

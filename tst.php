<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=regis;charset=utf8mb4', 'regis', 'password');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion OK !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

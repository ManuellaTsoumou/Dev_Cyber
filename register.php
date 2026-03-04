<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form>
        <label for="email">Email</label>
        <input type="email" id="email" name="email"> <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Submit">
    </form>

</body>

</html>

<?php
$success = false;
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Sécurité : Hachage moderne (BCRYPT) au lieu de MD5
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Connexion (Vérifie bien que l'utilisateur 'regis' a le mdp 'password' comme dans ton SQL)
            $conn = new PDO('mysql:host=localhost;dbname=regis;charset=utf8mb4', 'regis', 'password');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare('INSERT INTO users (email, hash_password) VALUES (?, ?)');
            $stmt->execute([$email, $hashPassword]);
            
            $success = true;
            $message = "Inscription réussie !";
        } catch (PDOException $e) {
            $success = false;
            $message = "Erreur base de données : " . $e->getMessage();
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
die();
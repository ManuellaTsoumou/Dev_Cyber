<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        form {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
 <form method="POST" action="">
    <label>Email</label>
    <input type="email" name="email" required><br>
    <label>Password</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="register" value="S'inscrire">
</form>

</body>

</html>

<?php
$success = false;
$message = "";

if (isset($_POST['register'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $conn = new PDO('mysql:host=localhost;dbname=regis;charset=utf8mb4', 'regis', 'password');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare('INSERT INTO users (email, hash_password) VALUES (?, ?)');
            $stmt->execute([$email, $hashPassword]);

            $success = true;
            $message = "Inscription réussie !";

        } catch (PDOException $e) {
            $message = "Erreur : " . $e->getMessage();
        }

    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<?php if($message): ?>
<p><?php echo $message; ?></p>
<?php endif; ?>


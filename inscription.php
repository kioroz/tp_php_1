<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>



<?php



$dsn = "mysql:host=localhost;dbname=centre_formation;charset=utf8";
$dbUser = "root";
$dbPass = "mysql";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Récupération des données
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // 2. Vérifications simples
    if (empty($username) || empty($password) || empty($password2)) {
        die("Tous les champs sont obligatoires.");
    }

    if ($password !== $password2) {
        die("Les mots de passe ne correspondent pas.");
    }

    // 3. Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 4. Connexion DB
    try {
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        die("Connexion échouée : " . $e->getMessage());
    }

    // 5. Insertion
    $sql = "INSERT INTO users (login, pass ) VALUES (:username, :pass)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':username' => $username,
        ':pass' => $hashedPassword,
    ])) {
        echo "<p id='success'>Inscription réussie !</p>";
        echo "<p><a href='index.html'>Se connecté</a></p>";
    } else {
        echo "<p id='error'>Erreur lors de l'inscription.</p>";
    }
}

?>
    
</body>
</html>
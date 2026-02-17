

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=centre_formation;charset=utf8";
$dbUser = "root";   
$dbPass = "mysql";

    try {
        $pdo = new PDO($dsn, $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }   

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Requête pour vérifier les informations de connexion
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "Connexion réussie ! Bienvenue, " . htmlspecialchars($user['prenom']) . " " . htmlspecialchars($user['nom']) . ".";
            // Vous pouvez rediriger l'utilisateur vers une page d'accueil ou un tableau de bord ici
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }
    ?>


?>
</body>
</html>

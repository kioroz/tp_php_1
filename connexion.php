<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>


<?php
// login_final.php - Script de connexion
session_start();

// --- Configuration BDD ---
// VÉRIFIEZ : Est-ce la bonne base de données pour cette table 'users'?
$dsn = "mysql:host=localhost;dbname=centre_formation;charset=utf8"; // J'utilise tp_users comme dans votre code précédent
$dbUser = "root";
$dbPass = "mysql";

// Options PDO recommandées
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// CONNEXION à la base de Données
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données. (" . $e->getMessage() . ")";
    exit;
}

// 1. Récupération des données du formulaire (Input)
// Note : J'assume que le formulaire envoie 'username' et 'password'.
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// 2. Validation
if ($username === '' || $password === '') {
    echo "Échec d'authentification : Veuillez remplir tous les champs.";
    exit;
}

// 3. Préparation de la requête de vérification
// On sélectionne l'ID et le mot de passe (colonne 'pass') pour l'utilisateur
$sql = "SELECT id, pass, role FROM users WHERE login = ? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$row = $stmt->fetch();

// 4. Vérification du mot de passe
// La colonne BDD s'appelle 'pass', on l'utilise ici -> $row['pass']
if ($row && password_verify($password, $row['pass'])) {
    
    // Connexion réussie : Initialisation de la session
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $row['role'];
    
    header("Location: menu_" . $_SESSION['role'] . ".php"); // Redirection vers la page d'accueil ou tableau de bord selon le rôle
    exit(); 
} else {
    // Échec de l'authentification (utilisateur non trouvé ou mot de passe incorrect)
    echo "<p id='error'>❌ Échec d'authentification : Nom d'utilisateur ou mot de passe incorrect.</p>";
}
?>

</body>

</html>
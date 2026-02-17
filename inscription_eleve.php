<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>inscriptions elèves</title>
</head>
<body>
    <?php
    session_start();
    ?>
        <nav>
    <?php
    $role = $_SESSION['role'] ?? '';

    // ADMIN : accès total
    if ($role === 'admin') {
        echo '<a href="menu_admin.php">accueil</a>';
        echo '<a href="stat_formateur.php">stats formateur</a>';
        echo '<a href="stats_notes.php">stats notes</a>';
        echo '<a href="stat_etudiant.php">stats etudiant</a>';
        echo '<a href="stat_formation.php">stats formation</a>';
        echo '<a href="inscription_eleve.php">inscription eleve</a>';
        echo '<a href="recherche1.php">recherche par id</a>';
        echo '<a href="recherche_liste.php">recherche via liste</a>';
    }

    // ENSEIGNANT : accès aux infos des étudiants
    else if ($role === 'enseignant') {
        header("Location: menu_enseignant.php");
        exit();
    }

    // ETUDIANT : accès limité
    else if ($role === 'etudiant') {
        header("Location: menu_etudiant.php");
        exit();
    }
    ?>
</nav>
<?php
if (isset($_SESSION['username'])) {
    echo "<p id='welcome'>Bienvenue, " . htmlspecialchars($_SESSION['username']) . " (" . htmlspecialchars($_SESSION['role']) . ") ! <a href='logout.php' id='logout'>Déconnexion</a></p>";
}
?>

    <h1>Inscription des élèves</h1>
    <form action="#" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required><br><br>

       <label for="email">email</label>
       <input type="email" id="email" name="email" required><br><br>

       <label for="num_tel">numéro de téléphone</label>
         <input type="tel" id="num_tel" name="num_tel" required>
        <br><br>
        <input type="submit" value="S'inscrire">

    </form>

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
    $prenom = trim($_POST['prenom'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $date_naissance = $_POST['date_naissance'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $num_tel = trim($_POST['num_tel'] ?? '');

    $sql = "INSERT INTO etudiants (nom, prenom, date_naissance, email, telephone) VALUES (:nom, :prenom, :date_naissance, :email, :telephone)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':date_naissance' => $date_naissance,
        ':email' => $email,
        ':telephone' => $num_tel,
    ])) {
        echo "<p id='success'> Inscription réussie !</p>";
    } else {
        echo "<p id='error'> Erreur lors de l'inscription.</p>";
    }
}


    ?>

</body>
</html>
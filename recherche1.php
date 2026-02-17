<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>recherche etudiant par id</title>
</head>
<body>
<?php
session_start();
?>
    <nav>
        <?php
    if ($_SESSION['role'] === 'formateur') {
        echo '<a href="menu-formateur.php">accueil</a>';
    } else if ($_SESSION['role'] === 'admin') {
        echo '<a href="menu-admin.php">accueil</a>';
    }
    ?>
    <a href="menu.html">accueil</a>
    <a href="stat_formateur.php">stats formateur</a>
    <a href="stats_notes.php">stats notes</a>
    <a href="stat_etudiant.php">stats etudiant</a>
    <a href="stat_formation.php">stats formation</a>
    <a href="inscription_eleve.php">inscription eleve</a>
    <a href="recherche1.php">recherche par id</a>
    <a href="recherche_liste.php">recherche via liste</a>
</nav>
<?php
if (isset($_SESSION['username'])) {
    echo "<p id='welcome'>Bienvenue, " . htmlspecialchars($_SESSION['username']) . " (" . htmlspecialchars($_SESSION['role']) . ") ! <a href='logout.php' id='logout'>Déconnexion</a></p>";
}
?>
    <h2>Recherche d’un étudiant par ID</h2>
    <form action="#" method="POST">
        <label for="id_etudiant">ID Étudiant :</label>
        <input type="number" id="id_etudiant" name="id_etudiant" required>
        <input type="submit" value="Rechercher">
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
        $id_etudiant = $_POST['id_etudiant'] ?? 0;

        $sql = "SELECT * FROM etudiants WHERE id_etudiant = :id_etudiant";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_etudiant' => $id_etudiant]);

        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($etudiant) {
            echo "<h2>Détails de l'étudiant :</h2>";
            echo "<p>ID : " . htmlspecialchars($etudiant['id_etudiant']) . "</p>";
            echo "<p>Nom : " . htmlspecialchars($etudiant['nom']) . "</p>";
            echo "<p>Prénom : " . htmlspecialchars($etudiant['prenom']) . "</p>";
            echo "<p>Date de naissance : " . htmlspecialchars($etudiant['date_naissance']) . "</p>";
            echo "<p>Email : " . htmlspecialchars($etudiant['email']) . "</p>";
            echo "<p>Numéro de téléphone : " . htmlspecialchars($etudiant['telephone']) . "</p>";
        } else {
            echo "<p>Aucun étudiant trouvé avec cet ID.</p>";
        }
    }
    ?>
</body>
</html>
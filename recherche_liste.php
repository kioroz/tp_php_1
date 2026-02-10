<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recherche étudiant via liste</title>
</head>
<body>

<nav>
    <a href="menu.html">accueil</a>
    <a href="stat_formateur.php">stats formateur</a>
    <a href="stats_notes.php">stats notes</a>
    <a href="stat_etudiant.php">stats etudiant</a>
    <a href="stat_formation.php">stats formation</a>
    <a href="inscription_eleve.php">inscription eleve</a>
    <a href="recherche1.php">recherche par id</a>
    <a href="recherche_liste.php">recherche via liste</a>
</nav>

<h2>Recherche d’un étudiant via une liste déroulante</h2>

<?php
// Connexion PDO
$dsn = "mysql:host=localhost;dbname=centre_formation;charset=utf8";
$dbUser = "root";
$dbPass = "mysql";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Charger la liste des étudiants
$sql = "SELECT id_etudiant, nom, prenom FROM etudiants ORDER BY nom";
$stmt = $pdo->query($sql);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
$etudiant = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id_etudiant"];

    $sql = "SELECT * FROM etudiants WHERE id_etudiant = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<form action="#" method="POST">
    <label for="id_etudiant">Choisir un étudiant :</label>
    <select name="id_etudiant" id="id_etudiant" required>
        <option value="">-- Sélectionner --</option>

        <?php foreach ($etudiants as $e): ?>
            <option value="<?= $e['id_etudiant'] ?>">
                <?= htmlspecialchars($e['nom'] . " " . $e['prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Rechercher">
</form>

<hr>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($etudiant) {
        echo "<h2>Détails de l'étudiant :</h2>";
        echo "<p>ID : " . htmlspecialchars($etudiant['id_etudiant']) . "</p>";
        echo "<p>Nom : " . htmlspecialchars($etudiant['nom']) . "</p>";
        echo "<p>Prénom : " . htmlspecialchars($etudiant['prenom']) . "</p>";
        echo "<p>Date de naissance : " . htmlspecialchars($etudiant['date_naissance']) . "</p>";
        echo "<p>Email : " . htmlspecialchars($etudiant['email']) . "</p>";
        echo "<p>Téléphone : " . htmlspecialchars($etudiant['telephone']) . "</p>";
    } else {
        echo "<p style='color:red;'>Aucun étudiant trouvé.</p>";
    }
}
?>

</body>
</html>
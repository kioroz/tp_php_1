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
        echo '<a href="menu_enseignant.php">accueil</a>';
        echo '<a href="stat_formateur.php">stats formateur</a>';
        echo '<a href="stats_notes.php">stats notes</a>';
        echo '<a href="stat_etudiant.php">stats etudiant</a>';
        echo '<a href="stat_formation.php">stats formation</a>';
        echo '<a href="recherche1.php">recherche par id</a>';
        echo '<a href="recherche_liste.php">recherche via liste</a>';
    }

    // ETUDIANT : accès limité
    else if ($role === 'etudiant') {
        header("Location: menu-etudiant.php");
        exit();
    }
    ?>
</nav>
<?php
if (isset($_SESSION['username'])) {
    echo "<p id='welcome'>Bienvenue, " . htmlspecialchars($_SESSION['username']) . " (" . htmlspecialchars($_SESSION['role']) . ") ! <a href='logout.php' id='logout'>Déconnexion</a></p>";
}
?>

    <h1>Statistiques des formateurs</h1>
    <p>Contenu de la page de statistiques des formateurs.</p>
    <?php
$dsn = "mysql:host=localhost;dbname=centre_formation;charset=utf8";
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
// Exemple de requête pour récupérer des données sur les formateurs
$slq1 = "SELECT COUNT(*) AS total_formateurs FROM formateurs";

$stmt1 = $pdo->prepare($slq1);
$stmt1->execute();
$row1 = $stmt1->fetch();

echo "<p>Total des formateurs inscrits : " . $row1['total_formateurs'] . "</p>";

$sql2 = "SELECT f.nom, f.prenom, COUNT(fo.id_formation) AS nb_formations FROM formateurs f LEFT JOIN formations fo ON f.id_formateur = fo.id_formateur GROUP BY f.id_formateur;";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$rows2 = $stmt2->fetchAll();
echo "<h2>Nombre de formations par formateur :</h2>";
echo "<ul>";
foreach ($rows2 as $row2) {
    echo "<li>" . htmlspecialchars($row2['nom'] . " " . $row2['prenom']) . ": " . $row2['nb_formations'] . "</li>";
}


?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>stat formations</title>
</head>
<body>
   <nav>
    <a href="index.html">accueil</a>
    <a href="stat_formateur.php">stats formateur</a>
    <a href="stats_notes.php">stats notes</a>
    <a href="stat_etudiant.php">stats etudiant</a>
    <a href="stat_formation.php">stats formation</a>
    <a href="inscription_eleve.php">inscription eleve</a>
    <a href="recherche1.php">recherche par id</a>
    <a href="recherche_liste.php">recherche via liste</a>
</nav>

    <h1>Statistiques des formations</h1>
    <p>Contenu de la page de statistiques des formations.</p>
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
// Exemple de requête pour récupérer des données sur les formations
$sql1 = "SELECT COUNT(*) AS total_formations FROM formations;";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();
$row1 = $stmt1->fetch();
echo "<p>Total des formations disponibles : " . $row1['total_formations'] . "</p>";
$sql2 = "SELECT f.intitule, COUNT(m.id_module) AS nb_modules FROM modules m JOIN formations f ON m.id_formation=f.id_formation GROUP BY f.intitule;";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$rows2 = $stmt2->fetchAll();
echo "<h2>Nombre de modules par formation :</h2>";
echo "<ul>";
foreach ($rows2 as $row2) {
    echo "<li>" . htmlspecialchars($row2['intitule']) . ": " . $row2['nb_modules'] . "</li>";
}
?>
</body>
</html>
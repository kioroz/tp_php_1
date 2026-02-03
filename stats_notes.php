<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
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

    <h1>Statistiques des notes</h1>
    <p>Contenu de la page de statistiques des notes.</p>
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
// Exemple de requête pour récupérer des données sur les notes
$sql1 = "SELECT AVG(note) AS moyenne_generale FROM notes;";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();
$row1 = $stmt1->fetch();
echo "<p>Moyenne générale des notes : " . $row1['moyenne_generale'] . "</p>";

$sql2 = "SELECT MAX(note) AS note_max, MIN(note) AS note_min FROM notes;";

$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$row2 = $stmt2->fetch();
echo "<p>Note maximale : " . $row2['note_max'] . "</p>";
echo "<p>Note minimale : " . $row2['note_min'] . "</p>";

$sql3 = "SELECT e.nom, e.prenom, AVG(n.note) AS moyenne FROM notes n JOIN etudiants e ON n.id_etudiant=e.id_etudiant GROUP BY e.id_etudiant;";
$stmt3 = $pdo->prepare($sql3);
$stmt3->execute();
$rows3 = $stmt3->fetchAll();
echo "<h2>Moyenne des notes par étudiant :</h2>";
echo "<ul>";
foreach ($rows3 as $row3) {
    echo "<li>" . htmlspecialchars($row3['nom'] . " " . $row3['prenom']) . ": " . $row3['moyenne'] . "</li>";
}
?>
    
</body>
</html>
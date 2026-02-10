<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>stat etudiant</title>
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

    <h1>Statistiques des étudiants</h1>
    <p>Contenu de la page de statistiques des étudiants.</p>
    <?php
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
// Exemple de requête pour récupérer des données sur les étudiants
$sql1 = "SELECT COUNT(*) AS total_etudiants FROM etudiants;";

$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();
$row1 = $stmt1->fetch();


echo "<p>Total des étudiants inscrits : " . $row1['total_etudiants'] . "</p>";

$sql2 = "SELECT f.intitule, COUNT(i.id_etudiant) AS nb_etudiants FROM inscriptions i JOIN formations f ON i.id_formation=f.id_formation GROUP BY f.intitule;";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$rows2 = $stmt2->fetchAll();
echo "<h2>Nombre d'étudiants par formation :</h2>";
echo "<ul>";
foreach ($rows2 as $row2) {
    echo "<li>" . htmlspecialchars($row2['intitule']) . ": " . $row2['nb_etudiants'] . "</li>";
}

echo "</ul>";
$sql3 = "SELECT nom, prenom, intitule FROM etudiants
JOIN inscriptions ON etudiants.id_etudiant = inscriptions.id_etudiant
JOIN formations ON inscriptions.id_formation = formations.id_formation";
$stmt3 = $pdo->prepare($sql3);
$stmt3->execute();
$rows3 = $stmt3->fetchAll();
echo "<h2>Liste des étudiants et leurs formations :</h2>";
echo "<ul>";
foreach ($rows3 as $row3) {
    echo "<li>" . htmlspecialchars($row3['prenom']) . " " . htmlspecialchars($row3['nom']) . " - " . htmlspecialchars($row3['intitule']) . "</li>";
}
echo "</ul>";
    ?>
</body>
</html>
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
    echo "<p id='welcome'>Bienvenue, " . htmlspecialchars($_SESSION['username']) . " (" . htmlspecialchars($_SESSION['role']) . ") ! <a href='logout.php' id='logout'>Déconnexion</a></p>";
    if (!isset($_SESSION['username'])) {
        header("Location: index.html");
        exit();
    } else if ($_SESSION['role'] === 'formateur') {
        header("Location: menu-formateur.php");
        exit();
    }   else if ($_SESSION['role'] === 'etudiant') {
        header("Location: menu-etudiant.php");
        exit();
    }
    ?>
<nav>
    <a href="menu-admin.php">accueil</a>
    <a href="stat_formateur.php">stats formateur</a>
    <a href="stats_notes.php">stats notes</a>
    <a href="stat_etudiant.php">stats etudiant</a>
    <a href="stat_formation.php">stats formation</a>
    <a href="inscription_eleve.php">inscription eleve</a>
    <a href="recherche1.php">recherche par id</a>
    <a href="recherche_liste.php">recherche via liste</a>
</nav>
    <h1>Bienvenue sur le tableau de bord des statistiques</h1>
    <p>Choisissez une option dans le menu ci-dessus pour afficher les statistiques.</p>
</body>
</html>
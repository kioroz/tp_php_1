# 🎓 TP Mission 1 — Centre de Formation  
Projet PHP / MySQL — BTS SIO SLAM

Ce projet consiste à créer et exploiter une base de données MySQL pour un centre de formation, puis développer une interface web en PHP permettant d’afficher différentes statistiques, gérer des inscriptions et effectuer des recherches.

---

## 📌 Objectifs pédagogiques

- Concevoir une base de données relationnelle
- Créer des tables avec clés primaires et étrangères
- Insérer des données de test
- Exploiter une base MySQL en PHP (PDO)
- Réaliser des requêtes SQL (COUNT, SUM, AVG…)
- Afficher des statistiques via une interface web
- Mettre en place des formulaires de recherche
- Utiliser des listes déroulantes dynamiques

---

## 🛠️ Technologies utilisées

- **PHP 8+**
- **MySQL / MariaDB**
- **PDO**
- **HTML / CSS**
- **Serveur local : Ampps / Wamp / Xampp**

---

## 🗂️ Structure du projet
/ (racine du projet) │── index.html │── style.css │── stat_etudiant.php │── stat_formation.php │── stat_formateur.php │── stats_notes.php │── inscription_eleve.php │── recherche1.php          (recherche par ID) │── recherche_liste.php     (recherche via liste déroulante) │── sql/ │     ├── creation_tables.sql │     └── insertions.sql


---

## 🧩 Fonctionnalités principales

### 🔹 1. Page d’accueil  
Menu de navigation permettant d’accéder à toutes les pages du projet.

### 🔹 2. Statistiques  
Pages affichant différentes statistiques SQL :

- Nombre total d’étudiants
- Étudiants par formation
- Nombre de formations
- Modules par formation
- Moyenne générale des notes
- Notes min / max
- Formations par formateur
- + une statistique personnalisée

### 🔹 3. Inscription d’un étudiant  
Formulaire permettant d’ajouter un nouvel étudiant dans la base.

### 🔹 4. Recherche d’un étudiant  
Deux méthodes :

#### ✔️ Recherche classique (ID)
Saisie d’un ID → affichage des informations de l’étudiant.

#### ✔️ Recherche via liste déroulante
Liste dynamique alimentée depuis la base → sélection d’un étudiant → affichage des informations.

---

## 🗄️ Base de données

Nom de la base : **centre_formation**

Tables créées :

- `etudiants`
- `formateurs`
- `formations`
- `modules`
- `inscriptions`
- `notes`
- `salles`

Les scripts SQL sont disponibles dans le dossier `/sql`.

---

## 🚀 Installation

1. Cloner le dépôt :

```bash
git clone https://github.com/ton-compte/ton-projet.git
- Importer la base de données :
- Ouvrir phpMyAdmin
- Créer la base centre_formation
- Importer creation_tables.sql
- Importer insertions.sql
- Placer le projet dans le dossier www ou htdocs.
- Lancer le serveur local (Ampps / Wamp / Xampp).
- Accéder au projet :
http://localhost/centre_formation/

👨‍💻 Auteur:
Projet réalisé par Noha, étudiant en BTS SIO SLAM.

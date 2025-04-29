<?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=catalogue_livres;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Supprimer un livre
if (isset($_GET['id']) && $_GET['action'] === 'delete') {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM livres WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit;
}

// Ajouter un livre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['titre']) && !empty($_POST['auteur']) && !empty($_POST['annee_publication'])) {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $annee = (int)$_POST['annee_publication'];
        $disponible = isset($_POST['disponible']) ? 1 : 0;

        $stmt = $pdo->prepare("INSERT INTO livres (titre, auteur, annee_publication, disponible) VALUES (?, ?, ?, ?)");
        $stmt->execute([$titre, $auteur, $annee, $disponible]);
        header("Location: index.php");
        exit;
    }
}

// Récupérer tous les livres
$stmt = $pdo->query("SELECT * FROM livres ORDER BY titre ASC");
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les livres publiés après 2000
$stmt2000 = $pdo->query("SELECT * FROM livres WHERE annee_publication > 2000 ORDER BY titre ASC");
$livres_apres_2000 = $stmt2000->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue des Livres</title>
</head>
<body>

    <h1>Catalogue complet</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Disponible</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres as $livre): ?>
                <tr>
                    <td><?= $livre['id'] ?></td>
                    <td><?= htmlspecialchars($livre['titre']) ?></td>
                    <td><?= htmlspecialchars($livre['auteur']) ?></td>
                    <td><?= $livre['annee_publication'] ?></td>
                    <td><?= $livre['disponible'] ? 'Oui' : 'Non' ?></td>
                    <td><a href="?id=<?= $livre['id'] ?>&action=delete" onclick="return confirm('Supprimer ce livre ?');">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Ajouter un livre</h2>
    <form method="POST">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required><br><br>

        <label for="auteur">Auteur :</label>
        <input type="text" name="auteur" id="auteur" required><br><br>

        <label for="annee_publication">Année de publication :</label>
        <input type="number" name="annee_publication" id="annee_publication" required><br><br>

        <label for="disponible">Disponible :</label>
        <input type="checkbox" name="disponible" id="disponible" checked><br><br>

        <input type="submit" value="Ajouter le livre">
    </form>

    <h2>Livres publiés après 2000 (triés par titre)</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Disponible</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres_apres_2000 as $livre): ?>
                <tr>
                    <td><?= $livre['id'] ?></td>
                    <td><?= htmlspecialchars($livre['titre']) ?></td>
                    <td><?= htmlspecialchars($livre['auteur']) ?></td>
                    <td><?= $livre['annee_publication'] ?></td>
                    <td><?= $livre['disponible'] ? 'Oui' : 'Non' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

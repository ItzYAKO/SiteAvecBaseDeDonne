<?php
$nom = $_GET['nom'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test XSS</title>
</head>
<body>

    <h1>Bienvenue sur mon site</h1>

    <form method="GET">
        <label for="nom">Entrez votre nom :</label>
        <input type="text" name="nom" id="nom">
        <input type="submit" value="Envoyer">
    </form>

    <h2>Sans `htmlspecialchars()` :</h2>
    <p><?= $nom ?></p>

    <h2>Avec `htmlspecialchars()` :</h2>
    <p><?= htmlspecialchars($nom) ?></p>

</body>
</html>

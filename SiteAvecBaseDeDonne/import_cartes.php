<?php require_once 'init.php'; ?> <!-- Initialisation de la session et connexion à la base de données -->

<?php

// Récupère la dernière version de Riot
$versionJson = file_get_contents("https://ddragon.leagueoflegends.com/api/versions.json");
$versions = json_decode($versionJson, true);
$latestVersion = $versions[0];

// Récupère la liste de tous les champions
$championJson = file_get_contents("https://ddragon.leagueoflegends.com/cdn/{$latestVersion}/data/fr_FR/champion.json");
$championData = json_decode($championJson, true);
$champions = $championData['data'];

// Parcourt tous les champions
foreach ($champions as $champion) {
    $championName = $champion['id'];

    // Récupère les infos détaillées du champion (y compris ses skins)
    $detailsJson = file_get_contents("https://ddragon.leagueoflegends.com/cdn/{$latestVersion}/data/fr_FR/champion/{$championName}.json");
    $details = json_decode($detailsJson, true);
    $skins = $details['data'][$championName]['skins'];

    // Parcourt tous les skins
    foreach ($skins as $skin) {
        $skinId = $skin['num'];
        $skinName = $skin['name'] === "default" ? $championName : $skin['name'];

        // Insertion en BDD
        $stmt = $pdo->prepare("INSERT INTO cartes (nom_champion, id_skin, nom_skin) VALUES (?, ?, ?)");
        $stmt->execute([$championName, $skinId, $skinName]);
    }
}

echo "Import terminé ";
?>

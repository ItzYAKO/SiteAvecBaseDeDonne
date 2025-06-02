<?php
// Initialisation de la session et connexion à la base de données
require_once 'init.php';

// Inclusion du header commun à toutes les pages
require 'haut_page.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p class='text-center text-red-500 mt-10'>Vous n'êtes pas connecté.</p>";
    require 'bas_page.php'; // Inclusion du footer commun
    exit;
}

$userId = $_SESSION['user_id'];
?>

<div class="flex-grow flex flex-col items-center justify-center mt-10 px-4">

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données des champions via l’API Riot
    $versionData = file_get_contents("https://ddragon.leagueoflegends.com/api/versions.json");
    $versions = json_decode($versionData, true);
    $latestVersion = $versions[0];

    $championData = file_get_contents("https://ddragon.leagueoflegends.com/cdn/{$latestVersion}/data/fr_FR/champion.json");
    $champions = json_decode($championData, true)['data'];

    $championList = array_values($champions);

    $cards = [];

    // Tirer 3 cartes aléatoires
    for ($i = 0; $i < 3; $i++) {
        $randomChampion = $championList[array_rand($championList)];
        $championName = $randomChampion['id'];

        $detailsJson = file_get_contents("https://ddragon.leagueoflegends.com/cdn/{$latestVersion}/data/fr_FR/champion/{$championName}.json");
        $details = json_decode($detailsJson, true);
        $skins = $details['data'][$championName]['skins'];

        $randomSkin = $skins[array_rand($skins)];
        $skinId = $randomSkin['num'];
        $skinName = $randomSkin['name'] === "default" ? $championName : $randomSkin['name'];

        // Préparer l'insertion avec INSERT IGNORE
        $stmt = $pdo->prepare("INSERT IGNORE INTO collection (user_id, champion_name, skin_id, skin_name) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $championName, $skinId, $skinName]);

        // Vérifier si l'insertion a eu lieu
        $inserted = $stmt->rowCount() > 0;

        $cards[] = [
            'championName' => $championName,
            'skinId' => $skinId,
            'skinName' => $skinName,
            'inserted' => $inserted,
        ];
    }

    // Affichage des cartes
    echo '<div class="flex flex-wrap justify-center gap-10">';
    foreach ($cards as $card) {
        $imageUrl = "https://ddragon.leagueoflegends.com/cdn/img/champion/splash/{$card['championName']}_{$card['skinId']}.jpg";
        $statusMessage = $card['inserted'] ? 
            '<p class="text-green-400 mt-2 font-semibold">Carte ajoutée !</p>' : 
            '<p class="text-red-400 mt-2 font-semibold">Vous avez déjà cette carte</p>';

        echo <<<HTML
        <div class="max-w-xs text-center">
            <img src="{$imageUrl}" alt="{$card['skinName']}" class="rounded-lg border-4 border-yellow-400 shadow-lg w-full">
            <p class="mt-3 text-lg font-bold text-yellow-300">{$card['championName']} - {$card['skinName']}</p>
            {$statusMessage}
        </div>
        HTML;
    }
    echo '</div><br><br>';
}
?>

<!-- Bouton pour ouvrir un coffre -->
<form method="POST" class="mt-10 text-center">
    <button type="submit" class="px-8 py-4 bg-yellow-400 text-black rounded-lg text-xl font-semibold hover:bg-yellow-300 transition">
        🎁 Ouvrir un coffre
    </button>
</form>

</div>

<?php require 'bas_page.php'; ?>

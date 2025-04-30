<?php require_once 'init.php'; ?>
<?php require 'haut_page.php'; ?>

<?php
$champion = $_GET['champion'] ?? null;
$skin = $_GET['skin'] ?? null;
$skinName = $_GET['skinName'] ?? null;

if (!$champion || $skin === null || !$skinName) {
    echo '<p class="text-red-500 text-lg font-semibold text-center mt-10">Paramètres manquants. Veuillez revenir à la page précédente.</p>';
    require 'bas_page.php';
    exit;
}

$championSafe = htmlspecialchars($champion);
$skinNum = intval($skin);
$skinNameSafe = htmlspecialchars($skinName);
$imageUrl = "https://ddragon.leagueoflegends.com/cdn/img/champion/splash/{$championSafe}_{$skinNum}.jpg";

$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['add_to_collection'])) {
        $check = $pdo->prepare("SELECT * FROM collection WHERE user_id = ? AND champion_name = ? AND skin_id = ?");
        $check->execute([$user_id, $championSafe, $skinNum]);

        if ($check->rowCount() === 0) {
            $insert = $pdo->prepare("INSERT INTO collection (user_id, champion_name, skin_id, skin_name) VALUES (?, ?, ?, ?)");
            $insert->execute([$user_id, $championSafe, $skinNum, $skinNameSafe]);
            $message = "Carte ajoutée à votre collection !";
        } else {
            $message = "Cette carte est déjà dans votre collection.";
        }
    }

    if (isset($_POST['remove_from_collection'])) {
        $delete = $pdo->prepare("DELETE FROM collection WHERE user_id = ? AND champion_name = ? AND skin_id = ?");
        $delete->execute([$user_id, $championSafe, $skinNum]);
        
        if ($delete->rowCount() > 0) {
            $message = "Carte retirée de votre collection.";
        } else {
            $message = "Cette carte n'est pas dans votre collection.";
        }
    }
}
?>

<div class="flex flex-col items-center p-8 text-center text-white">
    <h2 class="text-2xl font-bold text-yellow-400 mb-6">Carte de <?= $championSafe ?> - <?= $skinNameSafe ?></h2>

    <img src="<?= $imageUrl ?>" alt="Skin de <?= $championSafe ?>" class="w-full max-w-4xl rounded-2xl border-4 border-yellow-500 shadow-lg mb-6">

    <?php if ($message): ?>
        <p class="text-green-400 font-semibold mb-4"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST" class="flex gap-6">
            <button type="submit" name="add_to_collection"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-xl transition-all duration-200">
                Ajouter à ma collection
            </button>
            <button type="submit" name="remove_from_collection"
                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-xl transition-all duration-200">
                Retirer de ma collection
            </button>
        </form>
    <?php else: ?>
        <p class="text-yellow-300 mt-4">Connectez-vous pour ajouter ou retirer cette carte de votre collection.</p>
    <?php endif; ?>
</div>

<?php require 'bas_page.php'; ?>

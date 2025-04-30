<?php require_once 'init.php'; ?>

<?php
    // Inclus le haut de page (header commun)
    require 'haut_page.php';

    // Récupère les paramètres GET depuis l'URL
    $champion = isset($_GET['champion']) ? $_GET['champion'] : null;
    $skin = isset($_GET['skin']) ? $_GET['skin'] : null;
    $skinName = isset($_GET['skinName']) ? htmlspecialchars($_GET['skinName']) : null;
?>

<div class="flex flex-col items-center p-8 text-center text-white">
    <?php if (!$champion || $skin === null): ?>
        <p class="text-red-500 text-lg font-semibold">Paramètres manquants. Veuillez revenir à la page précédente.</p>
    <?php else: ?>
        <?php
            $championSafe = htmlspecialchars($champion);
            $skinNum = intval($skin);
            $imageUrl = "https://ddragon.leagueoflegends.com/cdn/img/champion/splash/{$championSafe}_{$skinNum}.jpg";
        ?>

        <h2 class="text-2xl font-bold text-yellow-400 mb-6">Carte de <?= $championSafe ?> -  <?= $skinName ?></h2>

        <img src="<?= $imageUrl ?>" alt="Skin de <?= $championSafe ?>" class="w-full max-w-4xl rounded-2xl border-4 border-yellow-500 shadow-lg mb-6">

        <div class="flex gap-6">
            <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-xl transition-all duration-200">
                Ajouter à ma collection
            </button>
            <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-xl transition-all duration-200">
                Retirer de ma collection
            </button>
        </div>
    <?php endif; ?>
</div>

<?php
    // Inclus le bas de page (footer commun)
    require 'bas_page.php';
?>

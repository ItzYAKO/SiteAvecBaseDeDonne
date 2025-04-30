<?php require_once 'init.php'; ?> <!-- Initialisation de la session et connexion à la base de données -->
<?php require 'haut_page.php'; ?> <!-- Inclusion du header commun à toutes les pages -->

<?php
// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Récupérer toutes les cartes du joueur connecté depuis la base de données
$stmt = $pdo->prepare("SELECT champion_name, skin_id, skin_name FROM collection WHERE user_id = ?");
$stmt->execute([$user_id]);
$cartes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Structure de la page avec une flexbox pour forcer le footer en bas -->
<div class="flex flex-col min-h-screen">

    <!-- Contenu principal -->
    <main class="flex-grow">
        <!-- Barre de titre pour la page "Ma Collection" -->
        <div class="text-center mt-10 mb-4">
            <h1 class="text-4xl font-bold text-yellow-400">Ma Collection</h1>
        </div>

        <!-- Affichage des cartes -->
        <div class="champion-container flex flex-wrap justify-center gap-6 px-4 pb-20">
            <!-- Si l'utilisateur n'a pas de carte, un message est affiché -->
            <?php if (empty($cartes)): ?>
                <p class="text-yellow-300 text-lg text-center w-full mt-10">Aucune carte dans votre collection pour le moment.</p>
            <?php else: ?>
                <!-- Boucle pour afficher chaque carte dans la collection -->
                <?php foreach ($cartes as $carte): ?>
                    <?php
                        // Récupérer les détails de chaque carte et formater l'URL de l'image
                        $champion = htmlspecialchars($carte['champion_name']);
                        $skinId = intval($carte['skin_id']);
                        $skinName = htmlspecialchars_decode($carte['skin_name']);
                        $imgUrl = "https://ddragon.leagueoflegends.com/cdn/img/champion/splash/{$champion}_{$skinId}.jpg";
                    ?>
                    <!-- Chaque carte est cliquable et redirige vers une page détaillant la carte -->
                    <a href="card.php?champion=<?= urlencode($champion) ?>&skin=<?= $skinId ?>&skinName=<?= urlencode($skinName) ?>" 
                       class="relative w-64 h-96 rounded-2xl overflow-hidden border-2 border-yellow-600 shadow-xl hover:scale-105 transition-transform duration-300">
                        <!-- Affichage de l'image de la carte (skin du champion) -->
                        <img src="<?= $imgUrl ?>" alt="<?= $champion ?> - <?= $skinName ?>" class="w-full h-full object-cover">
                        <!-- Texte affiché en bas de la carte avec le nom du champion et du skin -->
                        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white p-2 text-center font-bold">
                            <?= $champion ?> – <?= $skinName ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <!-- Inclusion du footer commun -->
    <?php require 'bas_page.php'; ?>
</div>

<?php require_once 'init.php'; ?> <!-- Initialisation de la session et connexion à la base de données -->
<?php require 'haut_page.php'; ?> <!-- Inclusion du header commun à toutes les pages -->

<?php
// Récupération des paramètres GET passés dans l'URL
$champion = $_GET['champion'] ?? null;
$skin = $_GET['skin'] ?? null;
$skinName = $_GET['skinName'] ?? null;

// Vérifie que tous les paramètres nécessaires sont présents, sinon affiche une erreur
if (!$champion || $skin === null || !$skinName) {
    echo '<p class="text-red-500 text-lg font-semibold text-center mt-10">Paramètres manquants. Veuillez revenir à la page précédente.</p>';
    require 'bas_page.php';
    exit;
}

// Sécurisation des données récupérées
$championSafe = htmlspecialchars($champion);
$skinNum = intval($skin);
$skinNameSafe = htmlspecialchars($skinName);

// Construction de l'URL de l'image du splash art
$imageUrl = "https://ddragon.leagueoflegends.com/cdn/img/champion/splash/{$championSafe}_{$skinNum}.jpg";

// Initialisation du message d'information
$message = null;

// Traitement du formulaire si la méthode POST est utilisée et que l'utilisateur est connecté
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Si l'utilisateur veut ajouter la carte à sa collection
    if (isset($_POST['add_to_collection'])) {
        // Vérifie si la carte existe déjà dans sa collection
        $check = $pdo->prepare("SELECT * FROM collection WHERE user_id = ? AND champion_name = ? AND skin_id = ?");
        $check->execute([$user_id, $championSafe, $skinNum]);

        // Si la carte n'existe pas, on l'ajoute
        if ($check->rowCount() === 0) {
            $insert = $pdo->prepare("INSERT INTO collection (user_id, champion_name, skin_id, skin_name) VALUES (?, ?, ?, ?)");
            $insert->execute([$user_id, $championSafe, $skinNum, $skinNameSafe]);
            $message = "Carte ajoutée à votre collection !";
        } else {
            $message = "Cette carte est déjà dans votre collection.";
        }
    }

    // Si l'utilisateur veut retirer la carte de sa collection
    if (isset($_POST['remove_from_collection'])) {
        // Suppression de la carte
        $delete = $pdo->prepare("DELETE FROM collection WHERE user_id = ? AND champion_name = ? AND skin_id = ?");
        $delete->execute([$user_id, $championSafe, $skinNum]);
        
        // Vérifie si une carte a bien été supprimée
        if ($delete->rowCount() > 0) {
            $message = "Carte retirée de votre collection.";
        } else {
            $message = "Cette carte n'est pas dans votre collection.";
        }
    }
}
?>

<!-- Contenu principal de la page -->
<div class="flex flex-col items-center p-8 text-center text-white">
    <!-- Titre de la carte -->
    <h2 class="text-2xl font-bold text-yellow-400 mb-6">Carte de <?= $championSafe ?> - <?= $skinNameSafe ?></h2>

    <!-- Affichage de l'image de la carte -->
    <img src="<?= $imageUrl ?>" alt="Skin de <?= $championSafe ?>" class="w-full max-w-4xl rounded-2xl border-4 border-yellow-500 shadow-lg mb-6">

    <!-- Affichage d'un message d'information (succès ou erreur) -->
    <?php if ($message): ?>
        <p class="text-green-400 font-semibold mb-4"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- Formulaire d'ajout ou de retrait, visible uniquement si l'utilisateur est connecté -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST" class="flex gap-6 justify-center">
            <!-- Bouton pour ajouter la carte à la collection -->
            <button type="submit" name="add_to_collection"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-xl transition-all duration-200">
                Ajouter à ma collection
            </button>
            <!-- Bouton pour retirer la carte de la collection -->
            <button type="submit" name="remove_from_collection"
                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-xl transition-all duration-200">
                Retirer de ma collection
            </button>
        </form>

        <!-- Bouton Ma collection -->
        <div class="mt-6">
            <a href="ma_collection.php" 
               class="inline-block bg-yellow-400 hover:bg-yellow-300 text-black font-semibold py-2 px-8 rounded-xl transition-all duration-200">
               Ma collection
            </a>
        </div>
    <?php else: ?>
        <!-- Message invitant à se connecter -->
        <p class="text-yellow-300 mt-4">Connectez-vous pour ajouter ou retirer cette carte de votre collection.</p>
    <?php endif; ?>
</div>

<?php require 'bas_page.php'; ?> <!-- Inclusion du footer commun -->

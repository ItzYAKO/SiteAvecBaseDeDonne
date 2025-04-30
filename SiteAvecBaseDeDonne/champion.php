<?php
// Récupération du nom du champion depuis l'URL, avec protection contre les injections XSS
$championName = isset($_GET['champion']) ? htmlspecialchars($_GET['champion']) : null;
?>

<!-- Inclusion du header commun à toutes les pages -->
<?php require 'haut_page.php'; ?> 

<!-- Contenu principal centré verticalement et horizontalement -->
<div class="main-content flex-grow flex flex-col items-center justify-center py-10">

    <!-- Titre affichant le nom du champion -->
    <h1 class="text-3xl font-bold text-yellow-500 mb-10">
        Carte skins de <?php echo $championName; ?>
    </h1>

    <!-- Bouton de retour vers la liste des cartes -->
    <div style="margin-bottom: 20px;">
        <a href="listcard.php" style="text-decoration: none;">
            <button class="px-6 py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300">
                Retour à la liste des cartes
            </button>
        </a>
    </div>

    <!-- Conteneur des skins qui sera rempli dynamiquement en JavaScript -->
    <div id="skinsContainer" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 20px;"></div>

</div>

<!-- Inclusion du footer commun -->
<?php require 'bas_page.php'; ?> 

<!-- Passage du nom du champion à JavaScript via une variable globale -->
<script>
    window.championName = "<?php echo $championName; ?>";
</script>

<!-- Inclusion du script qui va gérer l'affichage des skins -->
<script src="champion.js"></script>

<?php
    $championName = isset($_GET['champion']) ? htmlspecialchars($_GET['champion']) : null;
?>

<?php require 'haut_page.php'; ?> <!-- Require haut de page -->

<div class="main-content flex-grow flex flex-col items-center justify-center py-10">
    <h1 class="text-3xl font-bold text-yellow-500 mb-10">
        Carte skins de <?php echo $championName; ?>
    </h1>

    <div style="margin-bottom: 20px;">
        <a href="listcard.php" style="text-decoration: none;">
            <button class="px-6 py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300">
                Retour à la liste des cartes
            </button>
        </a>
    </div>

    <div id="skinsContainer" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 20px;"></div>
</div>

<?php require 'bas_page.php'; ?> <!-- Require bas de page -->

<script>
    window.championName = "<?php echo $championName; ?>";
</script>
<script src="champion.js"></script>
<?php
require_once 'init.php';

// Si l'utilisateur clique sur "Se déconnecter"
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: connexion.php");
    exit;
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}
?>

<?php require "haut_page.php"; ?>

<section class="flex-1 flex items-center justify-center px-6 py-24 relative">
  <div class="bg-white/5 backdrop-blur-md border border-yellow-600 rounded-2xl shadow-2xl p-10 w-full max-w-xl text-center">
    
    <h1 class="text-3xl font-bold text-yellow-500 mb-6">Ma Collection</h1>

    <p class="text-yellow-300 text-lg mb-8">
      Bonjour <span class="font-semibold"><?= htmlspecialchars($_SESSION['username']) ?></span>, voici votre collection de cartes :
    </p>

    <div class="bg-black/30 border border-yellow-600 rounded-lg p-6 text-yellow-200">
      <p>(Contenu fictif pour l'instant)</p>
      <ul class="mt-4 space-y-2 text-left">
        <li>✔️ Garen - Chevalier du roi</li>
        <li>✔️ Ahri - Élève rebelle</li>
        <li>✔️ Yasuo - Lame de l'exil</li>
      </ul>
    </div>

    <a href="ma_collection.php?action=logout" 
       class="inline-block mt-6 text-yellow-300 hover:underline">
      Se déconnecter
    </a>
  </div>

  <!-- Effet décoratif -->
  <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div>
</section>

<?php require "bas_page.php"; ?>

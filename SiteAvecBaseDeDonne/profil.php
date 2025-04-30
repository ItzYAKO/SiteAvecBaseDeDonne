<?php
require_once 'init.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

// Récupérer les informations de l'utilisateur depuis la base de données
$user_id = $_SESSION['user_id'];
$query = $pdo->prepare("SELECT username, email FROM users WHERE id = :user_id");
$query->execute(['user_id' => $user_id]);
$user = $query->fetch();

// Si l'utilisateur n'existe pas (par sécurité)
if (!$user) {
    header("Location: connexion.php");
    exit;
}

?>

<?php require "haut_page.php"; ?>

<section class="flex-1 flex items-center justify-center px-6 py-24 relative">
  <div class="bg-white/5 backdrop-blur-md border border-yellow-600 rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
    <h1 class="text-3xl font-bold text-yellow-500 mb-6">Mon Profil</h1>

    <div class="text-left mb-4">
      <label class="block text-sm font-semibold text-yellow-400 mb-2">Nom d'utilisateur</label>
      <p class="text-white"><?= htmlspecialchars($user['username']) ?></p>
      <a href="modification_profil.php?field=username" 
         class="text-yellow-300 hover:underline">Modifier</a>
    </div>

    <div class="text-left mb-4">
      <label class="block text-sm font-semibold text-yellow-400 mb-2">Adresse Email</label>
      <p class="text-white"><?= htmlspecialchars($user['email']) ?></p>
      <a href="modification_profil.php?field=email" 
         class="text-yellow-300 hover:underline">Modifier</a>
    </div>

    <div class="text-left mb-4">
      <label class="block text-sm font-semibold text-yellow-400 mb-2">Mot de passe</label>
      <p class="text-white">**********</p> <!-- Mot de passe masqué -->
      <a href="modification_profil.php?field=password" 
         class="text-yellow-300 hover:underline">Modifier</a>
    </div>

    <a href="profil.php?action=logout" 
       class="inline-block mt-6 text-yellow-300 hover:underline">
      Se déconnecter
    </a>
  </div>

  <!-- Effet décoratif -->
  <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div>
</section>

<?php require "bas_page.php"; ?>

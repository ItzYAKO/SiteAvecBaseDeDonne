<?php
require_once 'init.php';  <!-- Initialisation de la session et connexion à la base de données -->

// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

// Récupérer les informations de l'utilisateur depuis la base de données
$user_id = $_SESSION['user_id'];
$query = $pdo->prepare("SELECT username, email FROM users WHERE id = :user_id");
$query->execute(['user_id' => $user_id]);
$user = $query->fetch();

// Si l'utilisateur n'existe pas (par sécurité), redirection vers la page de connexion
if (!$user) {
    header("Location: connexion.php");
    exit;
}

// Si l'utilisateur clique sur "Se déconnecter"
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();  // Supprime toutes les variables de session
    session_destroy();  // Détruit la session
    header("Location: connexion.php");  // Redirige vers la page de connexion
    exit;
}
?>

<?php require "haut_page.php"; ?>  <!-- Inclusion du header commun à toutes les pages -->

<section class="flex-1 flex items-center justify-center px-6 py-24 relative">
  <div class="bg-white/5 backdrop-blur-md border border-yellow-600 rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
    <h1 class="text-3xl font-bold text-yellow-500 mb-6">Mon Profil</h1>

    <!-- Affichage du nom d'utilisateur et lien pour modification -->
    <div class="text-left mb-4">
      <label class="block text-sm font-semibold text-yellow-400 mb-2">Nom d'utilisateur</label>
      <p class="text-white"><?= htmlspecialchars($user['username']) ?></p>
      <a href="modification_profil.php?field=username" 
         class="text-yellow-300 hover:underline">Modifier</a>
    </div>

    <!-- Affichage de l'adresse email et lien pour modification -->
    <div class="text-left mb-4">
      <label class="block text-sm font-semibold text-yellow-400 mb-2">Adresse Email</label>
      <p class="text-white"><?= htmlspecialchars($user['email']) ?></p>
      <a href="modification_profil.php?field=email" 
         class="text-yellow-300 hover:underline">Modifier</a>
    </div>

    <!-- Affichage du mot de passe masqué et lien pour modification -->
    <div class="text-left mb-4">
      <label class="block text-sm font-semibold text-yellow-400 mb-2">Mot de passe</label>
      <p class="text-white">**********</p> <!-- Mot de passe masqué -->
      <a href="modification_profil.php?field=password" 
         class="text-yellow-300 hover:underline">Modifier</a>
    </div>

    <!-- Lien pour se déconnecter -->
    <a href="profil.php?action=logout" 
       class="inline-block mt-6 text-yellow-300 hover:underline">
      Se déconnecter
    </a>
  </div>

  <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div>
</section>

<?php require "bas_page.php"; ?>  <!-- Inclusion du footer commun -->

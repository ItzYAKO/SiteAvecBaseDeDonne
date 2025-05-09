<?php 
// Initialisation de la session et connexion à la base de données
require_once 'init.php'; 

// Inclusion du header commun à toutes les pages
require 'haut_page.php'; 

// Vérification si l'utilisateur est déjà connecté, redirection si c'est le cas
if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}
?>

<!-- Section de connexion -->
<section class="relative flex-1 flex items-center justify-center px-6 py-24">
  <!-- Conteneur principal pour le formulaire de connexion -->
  <div class="bg-white/5 backdrop-blur-md border border-yellow-600 rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
    
    <!-- Titre de la page -->
    <h1 class="text-3xl font-bold text-yellow-500 mb-6">Connexion</h1>

    <!-- Affichage d'un message d'erreur si présent dans l'URL -->
    <?php if (!empty($_GET['error'])): ?>
      <p class="text-red-400 mb-4 font-medium"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <!-- Formulaire de connexion -->
    <form action="traitement_connexion.php" method="POST" class="space-y-6">
      
      <!-- Champ de saisie pour l'adresse email -->
      <div class="text-left">
        <label for="email" class="block text-sm font-semibold text-yellow-400 mb-2">Adresse Email</label>
        <input type="email" id="email" name="email" required
          class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500"
          placeholder="exemple@email.com">
      </div>

      <!-- Champ de saisie pour le mot de passe -->
      <div class="text-left">
        <label for="password" class="block text-sm font-semibold text-yellow-400 mb-2">Mot de passe</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500"
          placeholder="Votre mot de passe">
      </div>

      <!-- Bouton de soumission du formulaire -->
      <button type="submit"
        class="w-full py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-black font-bold rounded-xl transition duration-300">
        Se connecter
      </button>

      <!-- Lien vers la page d'inscription pour les nouveaux utilisateurs -->
      <div class="text-sm text-yellow-300 mt-4 text-center">
        <a href="inscription.php" class="hover:underline">Pas encore de compte ? Inscrivez-vous</a>
      </div>
    </form>
  </div>

  <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div>
</section>

<?php 
// Inclusion du footer commun
require 'bas_page.php'; 
?>

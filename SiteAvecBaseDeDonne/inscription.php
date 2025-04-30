<?php require_once 'init.php'; ?> <!-- Initialisation de la session et connexion à la base de données -->
<?php require "haut_page.php"; ?> <!-- Inclusion du header commun à toutes les pages -->

<!-- Page d'inscription -->
<section class="relative flex-1 flex items-center justify-center px-6 py-24">
  <div class="bg-white/5 backdrop-blur-md border border-yellow-600 rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
    <h1 class="text-3xl font-bold text-yellow-500 mb-6">Créer un compte</h1>

    <!-- Formulaire d'inscription -->
    <form action="traitement_inscription.php" method="POST" class="space-y-6">
      <div class="text-left">
        <label for="username" class="block text-sm font-semibold text-yellow-400 mb-2">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" required
          class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500"
          placeholder="Nom d'utilisateur">
      </div>

      <div class="text-left">
        <label for="email" class="block text-sm font-semibold text-yellow-400 mb-2">Adresse Email</label>
        <input type="email" id="email" name="email" required
          class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500"
          placeholder="exemple@email.com">
      </div>

      <div class="text-left">
        <label for="password" class="block text-sm font-semibold text-yellow-400 mb-2">Mot de passe</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500"
          placeholder="Votre mot de passe">
      </div>

      <div class="text-left">
        <label for="confirm_password" class="block text-sm font-semibold text-yellow-400 mb-2">Confirmer le mot de passe</label>
        <input type="password" id="confirm_password" name="confirm_password" required
          class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500"
          placeholder="Confirmez votre mot de passe">
      </div>

      <!-- Bouton d'inscription -->
      <button type="submit"
        class="w-full py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-black font-bold rounded-xl transition duration-300">
        S'inscrire
      </button>

      <!-- Affichage d'erreurs si il y en a -->
      <?php if (isset($_GET['error'])): ?>
        <div style="color: red; margin-bottom: 1rem; font-weight: bold;">
          <?= htmlspecialchars($_GET['error']) ?>
        </div>
      <?php endif; ?>

      <!-- Lien vers la page de connexion si l'utilisateur a déjà un compte -->
      <div class="text-sm text-yellow-300 mt-4 text-center">
        <a href="connexion.php" class="hover:underline">Déjà un compte ? Connectez-vous</a>
      </div>

    </form>
  </div>

  <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div>
</section>

<?php require "bas_page.php"; ?> <!-- Inclusion du footer commun -->

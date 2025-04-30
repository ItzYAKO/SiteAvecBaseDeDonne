<?php require_once 'init.php'; ?>

<?php require "haut_page.php"; ?>

<!-- SECTION CONNEXION (style compact et clean) -->
<section class="relative flex-1 flex items-center justify-center px-6 py-24">
  <div class="bg-white/5 backdrop-blur-md border border-yellow-600 rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
    <h1 class="text-3xl font-bold text-yellow-500 mb-6">Connexion</h1>

    <form action="traitement_connexion.php" method="POST" class="space-y-6">
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

      <button type="submit"
        class="w-full py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-black font-bold rounded-xl transition duration-300">
        Se connecter
      </button>

      <div class="flex justify-between text-sm text-yellow-300 mt-4">
        <a href="mot_de_passe_oublie.php" class="hover:underline">Mot de passe oublié ?</a>
        <a href="inscription.php" class="hover:underline">Créer un compte</a>
      </div>
    </form>
  </div>

  <!-- Effet décoratif -->
  <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div>
</section>

<?php require "bas_page.php"; ?>

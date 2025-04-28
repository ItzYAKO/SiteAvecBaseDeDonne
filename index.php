<?php require "haut_page.php"; ?>


  <!-- SECTION HERO -->
  <section id="homepage" class="relative flex-1 flex items-center justify-center text-center px-6 py-24">
    <div class="max-w-2xl">
      <h1 class="text-5xl md:text-6xl font-extrabold text-yellow-500 mb-6 drop-shadow-lg">
        Collectionnez les Champions
      </h1>
      <p class="text-lg md:text-xl text-gray-300 mb-8">
        Constituez la collection ultime de cartes League of Legends et affichez vos plus grands héros.
      </p>
      <a href="#cardlist" class="inline-block px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-black font-bold rounded-full transition duration-300 shadow-lg">
        Voir les cartes
      </a>
    </div>

    <!-- Effet décoratif -->
    <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div>
  </section>

  <!-- SECTION DE PRESENTATION -->
  <section id="cardlist" class="bg-black/30 backdrop-blur-md border-t border-yellow-600 py-16 px-6 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-yellow-400 mb-6">Découvrez Tous les Champions</h2>
    <p class="max-w-3xl mx-auto text-gray-300 text-lg leading-relaxed">
      Explorez toutes les cartes disponibles, des combattants féroces aux mages mystiques. Chaque carte capture l'essence d'un champion iconique de League of Legends.
    </p>
  </section>

  <!-- FOOTER -->
  
  <?php require "bas_page.php"; ?>
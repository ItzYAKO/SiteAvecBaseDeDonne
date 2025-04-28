<?php require "haut_page.php"; ?>

<!-- SECTION PRINCIPALE -->
<section class="relative flex-1 flex flex-col items-center justify-center px-6 py-24">
    <!-- TITRE -->
    <h1 class="text-3xl font-bold text-yellow-500 mb-6 text-center">Carte de base de League of Legends</h1>

    <!-- RECHERCHE -->
    <div class="search-container mb-8">
        <input type="text" id="searchInput" class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 max-w-md"
            placeholder="Rechercher un champion..." oninput="filterChampions()">
    </div>

    <!-- CONTAINER DES CHAMPIONS -->
    <div class="champion-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10" id="championContainer">
        <!-- Exemple de carte de champion -->
        <div class="champion max-w-xs border-2 border-yellow-600 rounded-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-black/30">
            <img src="champion_image_url" alt="Champion" class="w-full h-64 object-cover">
            <div class="champion-name text-center p-4 bg-black/70 text-white">
                <h2 class="text-xl font-bold">Nom du Champion</h2>
            </div>
        </div>
    </div>
</section>

<?php require "bas_page.php"; ?>

<script src="script.js"></script>

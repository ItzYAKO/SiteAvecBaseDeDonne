<?php require "haut_page.php"; ?> <!-- Inclusion du header commun à toutes les pages -->

<div class="main-content">

    <!-- SECTION DE RECHERCHE -->
    <div class="search-container" style="text-align: center; margin-top: 20px;">
        <!-- Champ de recherche pour filtrer les champions -->
        <input type="text" id="searchInput" placeholder="Rechercher un champion..." oninput="filterChampions()" 
            style="padding: 10px; width: 80%; max-width: 400px; font-size: 16px; border: 2px solid #444; border-radius: 5px; background: #333; color: white;">
    </div>

    <!-- CONTAINER DES CHAMPIONS -->
    <div class="champion-container" id="championContainer" 
        style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 30px; padding: 20px;">
        <!-- Les champions seront injectés ici dynamiquement -->
    </div>
</div>

<?php require "bas_page.php"; ?> <!-- Inclusion du footer commun -->

<script src="script.js"></script> <!-- Inclusion du fichier JavaScript pour les interactions -->

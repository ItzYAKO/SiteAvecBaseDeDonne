<?php require "haut_page.php"; ?>

<!-- Main content container -->
<div class="main-content">
    <!-- Search bar -->
    <div class="search-container" style="text-align: center; margin-top: 20px;">
        <input type="text" id="searchInput" placeholder="Rechercher un champion..." oninput="filterChampions()" style="padding: 10px; width: 80%; max-width: 400px; font-size: 16px; border: 2px solid #444; border-radius: 5px; background: #333; color: white;">
    </div>

    <!-- Champion Container -->
    <div class="champion-container" id="championContainer" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 30px; padding: 20px;"></div>
</div>

<!-- Footer -->
<?php require "bas_page.php"; ?>

<script src="script.js"></script>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Champion - League of Legends</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-[#0a0a0a] to-[#1a1a2e] flex flex-col min-h-screen">

    <?php
        // Récupérer le nom du champion depuis l'URL (paramètre 'champion')
        $championName = isset($_GET['champion']) ? $_GET['champion'] : null;
    ?>

    <!-- Header -->
    <header class="bg-black/40 p-6 text-center">
        <h1 class="text-3xl font-bold text-yellow-500 mb-4">Carte skins de <?php echo htmlspecialchars($championName); ?></h1>
        <div style="margin-top: 15px;">
            <a href="index.php" style="text-decoration: none;">
                <button class="px-6 py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300">
                    Retour à l'accueil
                </button>
            </a>
        </div>
    </header>

    <!-- Main content -->
    <div class="main-content flex-grow flex flex-col items-center justify-center py-10">
        <!-- Conteneur des skins -->
        <div id="skinsContainer" class="flex flex-wrap justify-center gap-8"></div> <!-- Conteneur pour afficher les skins -->
    </div>

    <!-- Footer -->
    <footer class="bg-black/40 p-6 text-center">
        <p class="text-gray-400">© 2025 - Tous droits réservés</p>
        <p class="text-gray-400">Projet créé par Adrien Hersant</p>
    </footer>

    <!-- Passer la variable PHP au JavaScript -->
    <script>
        window.championName = "<?php echo htmlspecialchars($championName); ?>";
    </script>

    <!-- Le fichier JavaScript modifié -->
    <script src="champion.js"></script>
</body>
</html>

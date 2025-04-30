<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>League of Legends - Collection de Cartes</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-b from-[#0a0a0a] to-[#1a1a2e] text-white flex flex-col">

  <!-- HEADER -->
  <header class="w-full bg-black/30 backdrop-blur-md border-b border-yellow-600 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-4">
      <img src="https://upload.wikimedia.org/wikipedia/commons/2/25/LoL_icon.svg" alt="Logo" class="h-10 w-10">
      <span class="text-2xl font-bold text-yellow-500">LoL Cartes</span>
    </div>
    <nav class="hidden md:flex space-x-8 text-sm font-semibold">
      <a href="index.php" class="text-yellow-400 hover:text-yellow-300 transition">Accueil</a>
      <a href="listcard.php" class="text-yellow-400 hover:text-yellow-300 transition">Toutes les cartes</a>
      <a href="ma_collection.php" class="text-yellow-400 hover:text-yellow-300 transition">Ma collection</a>
      <?php 
      if (isset($_SESSION['user_id'])) {
        echo '<a href="profil.php" class="text-yellow-400 hover:text-yellow-300 transition">'.$_SESSION['username'].'</a>' ;
      }
      else  {    
        
        ?>
        <a href="connexion.php" class="text-yellow-400 hover:text-yellow-300 transition">Se connecter</a>
        <?php
      }




      ?>
    </nav>

  </header>
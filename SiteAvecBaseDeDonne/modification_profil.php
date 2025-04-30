<?php
require_once 'init.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

// Récupérer les informations de l'utilisateur depuis la base de données
$user_id = $_SESSION['user_id'];
$query = $pdo->prepare("SELECT username, email, password FROM users WHERE id = :user_id");
$query->execute(['user_id' => $user_id]);
$user = $query->fetch();

// Si l'utilisateur n'existe pas (par sécurité)
if (!$user) {
    header("Location: connexion.php");
    exit;
}

// Vérifie si on est en train de modifier un champ spécifique
$field = $_GET['field'] ?? '';

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_value = $_POST['new_value'] ?? '';
    $new_password = $_POST['new_password'] ?? '';

    // Vérifier le mot de passe actuel
    if (!password_verify($current_password, $user['password'])) {
        $error_message = "Mot de passe actuel incorrect.";
    } else {
        // Validation de l'email
        if ($field == 'email' && !filter_var($new_value, FILTER_VALIDATE_EMAIL)) {
            $error_message = "L'adresse email est invalide.";
        } else {
            // Mettre à jour le champ en fonction de ce qui a été demandé
            if ($field == 'username') {
                $update_query = $pdo->prepare("UPDATE users SET username = :username WHERE id = :user_id");
                $update_query->execute(['username' => $new_value, 'user_id' => $user_id]);
            } elseif ($field == 'email') {
                // Vérifier que l'email n'existe pas déjà dans la base de données
                $check_email_query = $pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :user_id");
                $check_email_query->execute(['email' => $new_value, 'user_id' => $user_id]);

                if ($check_email_query->rowCount() > 0) {
                    $error_message = "Cet email est déjà utilisé par un autre compte.";
                } else {
                    $update_query = $pdo->prepare("UPDATE users SET email = :email WHERE id = :user_id");
                    $update_query->execute(['email' => $new_value, 'user_id' => $user_id]);
                }
            } elseif ($field == 'password' && !empty($new_password)) {
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $update_query = $pdo->prepare("UPDATE users SET password = :password WHERE id = :user_id");
                $update_query->execute(['password' => $new_password_hash, 'user_id' => $user_id]);
            }

            // Rediriger vers la page de profil après mise à jour
            header("Location: profil.php");
            exit;
        }
    }
}
?>

<?php require "haut_page.php"; ?>

<section class="flex-1 flex items-center justify-center px-6 py-24 relative">
  <div class="bg-white/5 backdrop-blur-md border border-yellow-600 rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
    <h1 class="text-3xl font-bold text-yellow-500 mb-6">Modifier mon compte</h1>

    <?php if (isset($error_message)): ?>
      <div class="text-red-500 mb-4"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form action="modification_profil.php?field=<?= htmlspecialchars($field) ?>" method="POST" class="space-y-6">
      
      <!-- Champ Mot de passe actuel (commune pour tout) -->
      <div class="text-left">
        <label for="current_password" class="block text-sm font-semibold text-yellow-400 mb-2">Mot de passe actuel</label>
        <input type="password" id="current_password" name="current_password" required
          class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
      </div>

      <!-- Nouveau nom d'utilisateur -->
      <?php if ($field == 'username'): ?>
        <div class="text-left">
          <label for="new_value" class="block text-sm font-semibold text-yellow-400 mb-2">Nouveau nom d'utilisateur</label>
          <input type="text" id="new_value" name="new_value" required
            class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" 
            value="<?= htmlspecialchars($user['username']) ?>" />
        </div>
      <?php endif; ?>

      <!-- Nouveau email -->
      <?php if ($field == 'email'): ?>
        <div class="text-left">
          <label for="new_value" class="block text-sm font-semibold text-yellow-400 mb-2">Nouvelle adresse Email</label>
          <input type="email" id="new_value" name="new_value" required
            class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" 
            value="<?= htmlspecialchars($user['email']) ?>" />
        </div>
      <?php endif; ?>

      <!-- Nouveau mot de passe -->
      <?php if ($field == 'password'): ?>
        <div class="text-left">
          <label for="new_password" class="block text-sm font-semibold text-yellow-400 mb-2">Nouveau mot de passe</label>
          <input type="password" id="new_password" name="new_password" required
            class="w-full px-4 py-2 bg-black/30 text-white border border-yellow-600 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
        </div>
      <?php endif; ?>

      <button type="submit" 
        class="w-full py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-black font-bold rounded-xl transition duration-300">
        Modifier
      </button>
    </form>
  </div>
</section>

<?php require "bas_page.php"; ?>

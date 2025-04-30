<?php require_once 'init.php'; ?>

<?php
// Récupérer les données envoyées
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Vérifier que tous les champs sont remplis
if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    header("Location: inscription.php?error=Veuillez+remplir+tous+les+champs.");
    exit;
}

// Vérifier la validité de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: inscription.php?error=Email+invalide.");
    exit;
}

// Vérifier que les mots de passe correspondent
if ($password !== $confirm_password) {
    header("Location: inscription.php?error=Les+mots+de+passe+ne+correspondent+pas.");
    exit;
}

// Vérifier si l'email existe déjà
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    header("Location: inscription.php?error=Un+compte+existe+d%C3%A9j%C3%A0+avec+cet+email.");
    exit;
}

// Insérer le nouvel utilisateur
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hashed_password]);
?>

<?php require "haut_page.php"; ?>

<section class="flex-1 flex items-center justify-center px-6 py-24 relative">
  <div class="bg-white/5 backdrop-blur-md border border-yellow-600 rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
    
    <h1 class="text-3xl font-bold text-yellow-500 mb-6">Votre inscription est terminée</h1>

    <p class="text-yellow-300 text-lg mb-8">Vous pouvez maintenant vous connecter avec votre compte.</p>

    <button onclick="window.location.href='connexion.php'" 
      class="w-full py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-black font-bold rounded-xl transition duration-300">
      Retour à la connexion
    </button>

  </div>

  <!-- Effet décoratif -->
  <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div>
</section>

<?php require "bas_page.php"; ?>

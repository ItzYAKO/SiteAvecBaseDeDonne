<?php require_once 'init.php'; ?>

<?php
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Vérifier que les champs sont remplis
if (empty($email) || empty($password)) {
    header("Location: connexion.php?error=Veuillez+remplir+tous+les+champs.");
    exit;
}

// Vérifier si l'utilisateur existe
$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    header("Location: connexion.php?error=Email+ou+mot+de+passe+incorrect.");
    exit;
}

// Connexion réussie
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['email'] = $email;

// Redirection vers la page collection
header("Location: index.php");
exit;

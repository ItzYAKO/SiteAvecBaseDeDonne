<?php
// Récupération des données
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Vérifications de base
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Adresse email invalide.");
}

if ($password !== $confirm_password) {
    die("Les mots de passe ne correspondent pas.");
}

// Ici, tu pourrais hasher le mot de passe et l'enregistrer dans une base de données
// Exemple : $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Redirection ou message de confirmation
echo "Compte créé avec succès (en supposant un enregistrement en base) !";
?>

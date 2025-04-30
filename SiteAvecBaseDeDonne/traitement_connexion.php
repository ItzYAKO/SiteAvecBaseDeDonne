<?php require_once 'init.php';  <!-- Initialisation de la session et connexion à la base de données -->

<?php
// Récupération des données envoyées par le formulaire
$email = $_POST['email'] ?? '';  
$password = $_POST['password'] ?? '';  

// Vérifier que les champs sont remplis
if (empty($email) || empty($password)) {
    // Si l'un des champs est vide, rediriger vers la page de connexion avec un message d'erreur
    header("Location: connexion.php?error=Veuillez+remplir+tous+les+champs.");
    exit;  
}

// Vérifier si l'utilisateur existe dans la base de données
$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
$stmt->execute([$email]);  // Exécuter la requête pour récupérer les informations de l'utilisateur
$user = $stmt->fetch();  // Récupérer l'utilisateur trouvé (si existant)

// Si l'utilisateur n'existe pas ou si le mot de passe est incorrect
if (!$user || !password_verify($password, $user['password'])) {
    // Rediriger vers la page de connexion avec un message d'erreur
    header("Location: connexion.php?error=Email+ou+mot+de+passe+incorrect.");
    exit;  
}

// Connexion réussie
// Enregistrer les informations de l'utilisateur dans la session
$_SESSION['user_id'] = $user['id']; 
$_SESSION['username'] = $user['username'];  
$_SESSION['email'] = $email;  

// Redirection vers la page de collection après une connexion réussie
header("Location: index.php");
exit; 
?>

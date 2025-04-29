<?php
require_once("connexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Vérification que les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {
        $sql = "INSERT INTO user (email, password) VALUES(:email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        header("Location: login.php");
        unset($_SESSION["iduser"]);
        unset($_SESSION["email"]);
        exit;
    } else {
        echo "<p style='color: red;'>Veuillez remplir tous les champs.</p>";
    }
}
?>


<form method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Email" required>

    <label for="password">Mot de passe:</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required>

    <input type="submit" value="Inscription">

</form>

<!-- ✅ Bouton "Se connecter" qui redirige vers login.php -->
<form action="login.php" method="GET">
    <input type="submit" value="Se connecter">
</form>



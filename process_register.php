<?php
session_start();
include 'db.php';

if(isset($_POST['new_username'], $_POST['new_email'], $_POST['new_password'])) {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->execute(array(':username' => $new_username, ':email' => $new_email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['registerMessage'] = "Usuário ou email já registrado";
    } else {
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute(array(':username' => $new_username, ':email' => $new_email, ':password' => $new_password));
        $_SESSION['username'] = $new_username; 
        $_SESSION['isLoggedIn'] = true;
        header("Location: login.php"); 
        exit();
    }
} else {
    $_SESSION['registerMessage'] = "Erro: informações de cadastro não recebidas.";
}

header("Location: login.php");
exit();
?>

<?php
session_start();
include 'db.php';

if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(array(':username' => $username));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: index.html");
            exit();
        } else {
            $_SESSION['loginMessage'] = "Senha incorreta!";
        }
    } else {
        $_SESSION['loginMessage'] = "Usuário não encontrado!";
    }
} else {
    $_SESSION['loginMessage'] = "Erro: informações de login não recebidas.";
}

header("Location: login.php");
exit();
?>

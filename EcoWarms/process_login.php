<?php
session_start();
include 'db.php';

// Verificar se as variáveis POST foram definidas
if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(array(':username' => $username));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Login bem-sucedido
            $_SESSION['isLoggedIn'] = true;
            // Armazenar o nome de usuário na sessão
            $_SESSION['username'] = $user['username'];
            header("Location: login.php");
            exit();
        } else {
            // Senha incorreta
            $_SESSION['loginMessage'] = "Senha incorreta!";
        }
    } else {
        // Usuário não encontrado
        $_SESSION['loginMessage'] = "Usuário não encontrado!";
    }
} else {
    // Caso as variáveis POST não estejam definidas
    $_SESSION['loginMessage'] = "Erro: informações de login não recebidas.";
}

// Redirecionamento em caso de erro
header("Location: login.php");
exit();
?>

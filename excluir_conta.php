<?php
session_start();

// Verificar se o usuário está logado
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
    // Incluir o arquivo de configuração do banco de dados
    include 'db.php';

    // Preparar e executar a consulta de exclusão
    $stmt = $db->prepare("DELETE FROM users WHERE username = :username");
    $stmt->execute(array(':username' => $_SESSION['username']));

    // Verificar se a consulta foi executada com sucesso
    if($stmt->rowCount() > 0) {
        // Destruir a sessão
        session_destroy();
        // Redirecionar para a página de login após excluir a conta
        header("Location: login.php");
        exit();
    } else {
        // Se não foi possível excluir o usuário, exibir uma mensagem de erro
        echo "Erro ao excluir o usuário.";
        header("Location: login.php");
        exit();
    }
} else {
    // Se o usuário não estiver logado, redirecionar para a página de login
    header("Location: login.php");
    exit();
}
?>

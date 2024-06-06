<?php
session_start();

if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
    include 'db.php';

    $stmt = $db->prepare("DELETE FROM users WHERE username = :username");
    $stmt->execute(array(':username' => $_SESSION['username']));

    if($stmt->rowCount() > 0) {
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "Erro ao excluir o usuário.";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>

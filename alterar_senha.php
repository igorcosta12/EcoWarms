<?php
session_start();
include 'db.php';

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['new_password'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $username = $_SESSION['username'];

    $stmt = $db->prepare("UPDATE users SET password = :password WHERE username = :username");
    $stmt->execute(array(':password' => $new_password, ':username' => $username));

    $_SESSION['changePasswordMessage'] = "Senha alterada com sucesso!";
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Alterar Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .bg-initial {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../assets/bg-initial.jpg');
            background-size: cover;
            background-position: bottom;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: flex-start; 
            justify-content: center;
    }
        .container {
            width: 80%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        input[type="password"]:focus {
            outline: none;
            border-color: #4CAF50;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            margin-top: 20px;
            color: #4CAF50;
            font-weight: bold;
        }
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        
        .back-link a {
            color: #fff;
            font-size: 36px;
            text-decoration: none;
        }
        
        .back-link a:hover {
            color: #ccc;
        }
        
    </style>
</head>
<body>
    <div class="w-full h-screen bg-black bg-initial bg-fixed bg-cover bg-bottom">
        <div class="back-link">
            <a href="login.php" class="material-icons">arrow_back</a>
        </div>
    <div class="container">
        <h2>Alterar Senha</h2>
        <form action="alterar_senha.php" method="post">
            <label for="new_password">Nova Senha:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Alterar Senha</button>
        </form>
        <?php
        if (isset($_SESSION['changePasswordMessage'])) {
            echo "<p>{$_SESSION['changePasswordMessage']}</p>";
            unset($_SESSION['changePasswordMessage']); 
        }
        ?>
    </div>
</body>
</html>

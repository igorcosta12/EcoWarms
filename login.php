<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .bg-initial {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../assets/bg-initial.jpg');
            background-size: cover;
            background-position: bottom;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: flex-start; /* Alteração feita aqui */
            justify-content: center;
    }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
            margin-top: 5px;
        }
        
        .container {
            text-align: center;
            width: 80%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #000;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
            font-size: 18px;
        }

        .button-container button:hover {
            background-color: #45a049;
        }

        /* Estilos CSS para os modais */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 15px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
            position: relative;
        }
        .modal-buttons {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        /* Estilos CSS para espaçamento entre labels e inputs */
        form label {
            margin-bottom: 10px;
            display: block;
            color: #333;
        }

        form input {
            margin-bottom: 10px;
        }
        
        .close {
            color: #aaa;
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
       
        /* Esconder a marca d'água do 000webhost */
            div[style*="www.000webhost.com"] {
            display: none !important;
        }

    </style>
</head>
<body>
    <div class="w-full h-screen bg-black bg-initial bg-fixed bg-cover bg-bottom">
    <div class="back-link">
            <a href="index.html" class="material-icons">arrow_back</a>
        </div>
        <div class="container">
        <?php
            // Verificar se o usuário está logado
            if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
                // Se estiver logado, exibir a mensagem e os links
                $nomeUsuario = $_SESSION['username'];
                echo "<h1>Bem-vindo, $nomeUsuario</h1>";
                echo "<a href=\"index.html\"><button>Página Inicial</button></a>";
                echo "<a href=\"alterar_senha.php\"><button>Alterar Senha</button></a>";
                echo "<a href=\"excluir_conta.php\" onclick=\"return confirm('Tem certeza que deseja excluir sua conta?');\"><button>Excluir Conta</button></a>";
                echo "<a href=\"logout.php\" onclick=\"return confirm('Tem certeza que deseja sair da sua conta?');\"><button>Logout</button></a>";
                exit(); // Encerrar a execução do script
            }
            ?>
            <h1>Bem-vindo a EcoWarms</h1>
            <div class="button-container">
                <button onclick="openModal('loginModal')">Login</button>
                <button onclick="openModal('registerModal')">Cadastro</button>
            </div>
        </div>
    </div>

    <!-- Modal de Login -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('loginModal')">&times;</span>
            <h2>Login</h2>
            <form action="process_login.php" method="post">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
                <div class="modal-buttons">
                    <button type="submit">Entrar</button>
                </div>
            </form>
             <!-- Container para exibir a mensagem de erro -->
            <div id="loginErrorMessage" style="color: red;"></div>
        </div>
            
        </div>
    </div>

    <!-- Modal de Cadastro -->
<div id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('registerModal')">&times;</span>
        <h2>Cadastro</h2>
        <form action="process_register.php" method="post">
            <label for="new_username">Usuário:</label>
            <input type="text" id="new_username" name="new_username" required>
            <label for="new_email">Email:</label>
            <input type="email" id="new_email" name="new_email" required>
            <label for="new_password">Senha:</label>
            <input type="password" id="new_password" name="new_password" required>
            <div class="modal-buttons">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
        <!-- Container para exibir a mensagem de erro -->
        <div id="registerErrorMessage" style="color: red;">
        </div>
    </div>
</div>

<script>
    // Funções JavaScript para abrir e fechar o modal
    function openModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "block";
        }
        
        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }
        
        // Verificar se há uma mensagem de erro específica para o registro
        <?php
        if (isset($_SESSION['registerMessage'])) {
            $registerErrorMessage = $_SESSION['registerMessage'];
            echo "var registerErrorMessage = \"$registerErrorMessage\";";
            echo "document.getElementById('registerErrorMessage').textContent = registerErrorMessage;";
            echo "openModal('registerModal');";
            unset($_SESSION['registerMessage']); // Limpar a mensagem de erro da sessão após exibi-la
        }
        ?>

        // Verificar se há uma mensagem de erro específica para o login
        <?php
        if (isset($_SESSION['loginMessage'])) {
            $loginErrorMessage = $_SESSION['loginMessage'];
            echo "var loginErrorMessage = \"$loginErrorMessage\";";
            echo "document.getElementById('loginErrorMessage').textContent = loginErrorMessage;";
            echo "openModal('loginModal');";
            unset($_SESSION['loginMessage']); // Limpar a mensagem de erro da sessão após exibi-la
        }
        ?>
</script>
    
</body>
</html>

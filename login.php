<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../output.css">
    <title>Login</title>
</head>
<style>
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
<body id="login-page">
      <div class="w-full h-screen bg-black bg-initial bg-fixed bg-cover bg-bottom">
          <div class="back-link">
            <a href="index.html" class="material-icons">arrow_back</a>
        </div>
    <div class="login mt-28 text-white flex mx-auto my-0 bg-gray-950 justify-center items-center text-center rounded-lg">
        <div class="login-data p-8">
            <form action="process_login.php" method="post">
                <h2 class="font-links text-4xl font-bold">Login</h2>
                <p class="text-xs pt-2 text-gray-300">Se você tiver algum login, por favor insira abaixo</p>

                <input type="text" 
                name="username" 
                id="username"
                placeholder="Usuário"
                autocomplete="off"
                class="w-96 border-none rounded-md px-3 py-4 bg-gray-800 outline-none mt-8"
                required>

                <input type="password" 
                name="password" 
                id="password"
                placeholder="Senha"
                autocomplete="off"
                class="w-96 border-none rounded-md px-3 py-4 bg-gray-800 outline-none mt-6"
                required>

                <div class="ml-auto text-end pt-3 px-8">
                    <a href="#" id="qstPass" class="text-xs text-gray-300">Esqueceu a senha?</a>
                </div>

                <button type="submit" class="btnSecondary mt-6 text-xl">Login</button>

                <div class="flex justify-between mt-8 px-8">
                    <span class="text-xs text-gray-500">Ainda não tem uma conta?</span>
                    <a id="link-register" href="#" class="text-sm">Registre-se</a>
                </div>
            </form>

            <div id="loginErrorMessage" style="color: red;">
                <?php
                if (isset($_SESSION['loginMessage'])) {
                    echo $_SESSION['loginMessage'];
                    unset($_SESSION['loginMessage']); 
                }
                ?>
            </div>
        </div>
    </div>

    <div class="register mt-3 text-white hidden mx-auto my-0 bg-gray-950 justify-center items-center text-center rounded-lg">
        <div class="register-data p-8">
            <form action="process_register.php" method="post">
                <h2 class="font-links text-4xl font-bold">Registre-se</h2>
                <p class="text-xs pt-2 text-gray-300">Caso não tenha uma conta, registre-se abaixo</p>

                <input type="email" 
                name="new_email"
                id="new_email"
                placeholder="Email"
                autocomplete="off"
                class="w-96 border-none rounded-md px-3 py-4 bg-gray-800 outline-none mt-6"
                required>

                <input type="text" 
                name="new_username" 
                id="new_username"
                placeholder="Usuário"
                autocomplete="off"
                class="w-96 border-none rounded-md px-3 py-4 bg-gray-800 outline-none mt-6"
                required>

                <input type="password" 
                name="new_password" 
                id="new_password"
                placeholder="Senha"
                autocomplete="off"
                class="w-96 border-none rounded-md px-3 py-4 bg-gray-800 outline-none mt-6"
                required>

                <input type="password" 
                name="Confirmpassword" 
                id="Confirmpassword"
                placeholder="Confirmar senha"
                autocomplete="off"
                class="w-96 border-none rounded-md px-3 py-4 bg-gray-800 outline-none mt-6"
                required>

                <button type="submit" class="btnSecondary mt-6 text-xl">Registre-se</button>

                <div class="flex justify-between mt-4 p-8">
                    <span class="text-xs text-gray-500">Já tem uma conta?</span>
                    <a id="link-login" class="text-sm" href="#">Login</a>
                </div>
            </form>

            <div id="registerErrorMessage" style="color: red;">
                <?php
                if (isset($_SESSION['registerMessage'])) {
                    echo $_SESSION['registerMessage'];
                    unset($_SESSION['registerMessage']); 
                }
                ?>
            </div>
        </div>
        </div>
    </div>
    
    <script type="module" src="/js/app.js"></script>
    <script>
        <?php
        if (isset($_SESSION['registerMessage'])) {
            echo "document.querySelector('.login').classList.add('hidden');";
            echo "document.querySelector('.register').classList.remove('hidden');";
        }
        ?>

        <?php
        if (isset($_SESSION['loginMessage'])) {
            echo "document.querySelector('.register').classList.add('hidden');";
            echo "document.querySelector('.login').classList.remove('hidden');";
        }
        ?>
    </script>
</body>
</html>

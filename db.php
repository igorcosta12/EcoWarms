<?php
$host = 'localhost';
$dbname = 'ecowarms';
$username = 'root'; // Pode variar dependendo da sua configuração local
$password = ''; // Deixe em branco se você não definiu uma senha

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
}
?>

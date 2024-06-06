<?php
$host = 'localhost';
$dbname = 'id22111577_igor';
$username = 'id22111577_igor'; 
$password = 'Ecowarms1221@';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
}
?>

<?php
$servername = "localhost";
$username = "root"; // Se estiver usando o XAMPP, o usuário padrão é root
$password = ""; // Se não houver senha para o MySQL, deixe vazio
$dbname = "delivery"; // Substitua pelo nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>

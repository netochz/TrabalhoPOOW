<?php
$servername = "localhost";
$username = "root";
$password = ""; // Sem senha por padrão no XAMPP
$dbname = "parkplus_db"; // O nome do seu banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>

<?php
// Configurações do banco de dados
$host = '127.0.0.1'; // Endereço do servidor MySQL
$usuario = 'root'; // Nome de usuário do MySQL
$senha = ''; // Senha do MySQL (deixe em branco para root sem senha)
$banco = 'centro_bongo'; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>

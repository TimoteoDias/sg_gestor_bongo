<?php
// processar/processar_cadastro_usuario.php

// Inclui o arquivo de configuração com os dados de conexão
include "../conexao/conexao.php";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $senha = $_POST["senha"];

    // Validação dos dados (pode ser mais robusta, incluindo verificação no banco de dados)
    // Aqui vamos apenas verificar se os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($email) || empty($username) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        // Hash da senha para armazenamento seguro no banco de dados
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Preparar e executar a declaração SQL para inserir o novo usuário no banco de dados
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, username, senha) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $username, $senha_hash);

        if ($stmt->execute()) {
            // Cadastro bem-sucedido
            $mensagem_sucesso = "Usuário cadastrado com sucesso!";
        } else {
            // Erro ao cadastrar usuário
            $erro = "Erro ao cadastrar usuário: " . $conn->error;
        }

        // Fechar a declaração
        $stmt->close();
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta n

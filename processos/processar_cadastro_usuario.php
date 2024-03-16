<?php
// processar_cadastro_usuario.php

session_start(); // Inicia a sessão

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
        // Conexão com o banco de dados
        include "../conexao/conexao.php"; // Corrigindo o caminho para o arquivo de conexão

        // Verificar se o email já está cadastrado
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            $erro = "Este email já está cadastrado.";
        } else {
            // Inserir novo usuário no banco de dados
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, username, senha) VALUES (?, ?, ?, ?)");
            // Vamos usar a função password_hash() para criptografar a senha antes de inseri-la no banco de dados
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
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

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso no Cadastro</title>
</head>
<body>
    <h2>Sucesso no Cadastro</h2>
    <?php if (isset($mensagem_sucesso)) { ?>
        <p><?php echo $mensagem_sucesso; ?></p>
        <a href="../index.html">Faça login agora</a>
    <?php } else { ?>
        <p><?php echo isset($erro) ? $erro : "Ocorreu um erro durante o cadastro"; ?></p>
        <a href="../formularios/frm_cadastro_usuario.html">Voltar para o formulário de cadastro</a>
    <?php } ?>
</body>
</html>

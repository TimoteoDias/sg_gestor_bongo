<?php
// processar_login.php

session_start(); // Inicia a sessão

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação dos dados (pode ser mais robusta, incluindo verificação no banco de dados)
    // Aqui vamos apenas verificar se os campos obrigatórios foram preenchidos
    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        // Conexão com o banco de dados
        include "../conexao/conexao.php"; // Corrigindo o caminho para o arquivo de conexão

        // Preparar e executar a declaração SQL para buscar o usuário com o email fornecido
        $stmt = $conn->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        // Verifica se encontrou um usuário com o email fornecido
        if ($resultado->num_rows == 1) {
            $usuario = $resultado->fetch_assoc();
            // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
            if (password_verify($senha, $usuario["senha"])) { // Verifica a senha usando password_verify()
                // Login bem-sucedido
                $_SESSION["usuario_id"] = $usuario["id"]; // Armazena o ID do usuário na sessão
                $_SESSION["nome_usuario"] = $usuario["nome"]; // Armazena o nome do usuário na sessão
                header("Location: ../telas/painel.php"); // Redireciona para o painel principal
                exit();
            } else {
                // Senha incorreta
                $erro = "Senha incorreta.";
            }
        } else {
            // Usuário não encontrado
            $erro = "Email não registrado.";
        }

        // Fechar a declaração e a conexão com o banco de dados
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro de Login</title>
</head>
<body>
    <h2>Erro de Login</h2>
    <p><?php echo isset($erro) ? $erro : "Ocorreu um erro durante o login"; ?></p>
    <a href="../index.html">Voltar</a>
</body>
</html>

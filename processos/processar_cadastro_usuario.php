<?php
// processar/processar_cadastro_usuario.php

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $senha = $_POST["senha"];

    // Validação dos dados (pode ser mais robusta, incluindo verificação no banco de dados)
    // Por exemplo, verifique se o email já está em uso ou se o nome de usuário já está sendo usado
    // Se você estiver usando um banco de dados, este é o lugar para inserir o código de inserção
    // Aqui está um exemplo de mensagem de sucesso
    $mensagem_sucesso = "Usuário cadastrado com sucesso!";
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
    <p><?php echo isset($mensagem_sucesso) ? $mensagem_sucesso : "Ocorreu um erro durante o cadastro"; ?></p>
    <a href="../formularios/frm_cadastro_usuario.html">Voltar para o formulário de cadastro</a>
</body>
</html>

<?php
session_start(); // Inicia a sessão

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST["nome"];
    $numero_bilhete_identidade = $_POST["numero_bilhete_identidade"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $numero = $_POST["numero"];
    $classe = $_POST["classe"];
    $curso_id = $_POST["curso_id"];

    // Validação dos dados (pode ser mais robusta)
    if (empty($nome) || empty($numero_bilhete_identidade) || empty($email)) {
        $erro = "Por favor, preencha todos os campos obrigatórios.";
    } else {
        // Conexão com o banco de dados
        include "../conexao/conexao.php"; // Corrigindo o caminho para o arquivo de conexão

        // Verificar se o e-mail já está cadastrado
        $stmt = $conn->prepare("SELECT id FROM alunos WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            // Inserir novo aluno no banco de dados
            $stmt = $conn->prepare("INSERT INTO alunos (nome, numero_bilhete_identidade, email, endereco, numero, classe, curso_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $nome, $numero_bilhete_identidade, $email, $endereco, $numero, $classe, $curso_id);

            if ($stmt->execute()) {
                // Cadastro bem-sucedido
                $_SESSION["mensagem_sucesso"] = "Aluno cadastrado com sucesso!";
            } else {
                // Erro ao cadastrar aluno
                $erro = "Erro ao cadastrar aluno: " . $conn->error;
            }

            // Fechar a declaração
            $stmt->close();
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
}

// Redirecionamento após o processamento do formulário
if (isset($_SESSION["mensagem_sucesso"])) {
    // Se houver mensagem de sucesso, exibe um alerta e redireciona após clicar em OK
    echo "<script>alert('Aluno cadastrado com sucesso!'); window.location='../telas/gerenciar_alunos.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Cadastro</title>
</head>
<body>
    <?php if (isset($erro)) { ?>
        <h2>Erro no Cadastro</h2>
        <p><?php echo $erro; ?></p>
    <?php } ?>
    
    <a href="../formularios/frm_cadastro_aluno.html">Voltar para o formulário de cadastro</a>
</body>
</html>

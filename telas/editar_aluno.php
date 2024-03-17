<?php
session_start();
include "../conexao/conexao.php";

// Verifica se o aluno foi selecionado para edição
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    // Busca as informações do aluno no banco de dados
    $stmt = $conn->prepare("SELECT * FROM alunos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $aluno = $resultado->fetch_assoc();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário de edição
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $data_nascimento = $_POST["data_nascimento"];

    // Atualiza as informações do aluno no banco de dados
    $stmt = $conn->prepare("UPDATE alunos SET nome = ?, email = ?, telefone = ?, endereco = ?, data_nascimento = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $nome, $email, $telefone, $endereco, $data_nascimento, $id);
    if ($stmt->execute()) {
        $_SESSION["mensagem_sucesso"] = "Dados atualizados com sucesso!";
        header("Location: ../telas/gerenciar_alunos.php");
        exit();
    } else {
        $erro = "Erro ao atualizar aluno: " . $conn->error;
    }
}

// Verifica se há mensagem de sucesso na sessão
if (isset($_SESSION["mensagem_sucesso"])) {
    $mensagem_sucesso = $_SESSION["mensagem_sucesso"];
    // Remove a mensagem da sessão para que não seja exibida novamente
    unset($_SESSION["mensagem_sucesso"]);
}

// Fechar conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="../estilos/editar_aluno.css">
</head>
<body>
    <h2>Editar Aluno</h2>
    <?php if (isset($erro)) { ?>
        <p><?php echo $erro; ?></p>
    <?php } ?>
    <?php if (isset($mensagem_sucesso)) { ?>
        <p><?php echo $mensagem_sucesso; ?></p>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $aluno['id']; ?>">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $aluno['nome']; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $aluno['email']; ?>"><br>
        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" value="<?php echo $aluno['telefone']; ?>"><br>
        <label for="endereco">Endereço:</label><br>
        <input type="text" id="endereco" name="endereco" value="<?php echo $aluno['endereco']; ?>"><br>
        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $aluno['data_nascimento']; ?>"><br><br>
        <input type="submit" value="Atualizar"><br>
        <br> 
        <a href="../telas/gerenciar_alunos.php">Voltar</a>
        
    </form>
</body>
</html>

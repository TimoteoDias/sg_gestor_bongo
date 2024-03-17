<?php
// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir a conexão com o banco de dados
    include "../conexao/conexao.php";

    // Capturar os dados do formulário
    $nome_turma = $_POST["nome_turma"];
    $descricao = $_POST["descricao"];
    $sala = $_POST["sala"];
    $data_inicio = $_POST["data_inicio"];
    $data_termino = $_POST["data_termino"];

    // Validar os dados (você pode adicionar validações adicionais conforme necessário)

    // Inserir os dados da turma no banco de dados
    $sql = "INSERT INTO turmas (nome_turma, descricao, sala, data_inicio, data_termino) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome_turma, $descricao, $sala, $data_inicio, $data_termino);

    if ($stmt->execute()) {
        // Redirecionar para a página de gestão de turmas com uma mensagem de sucesso
        session_start();
        $_SESSION["success_message"] = "Turma adicionada com sucesso!";
        header("Location: ../telas/gerenciar_turmas.php");
        exit();
    } else {
        // Se houver um erro ao inserir a turma, exibir uma mensagem de erro
        session_start();
        $_SESSION["error_message"] = "Erro ao adicionar a turma: " . $conn->error;
        header("Location: ../formularios/frm_adicionar_turma.php");
        exit();
    }

    // Fechar a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    // Se o formulário não foi submetido corretamente, redirecionar para o formulário de adicionar turma
    header("Location: ../formularios/frm_adicionar_turma.php");
    exit();
}
?>

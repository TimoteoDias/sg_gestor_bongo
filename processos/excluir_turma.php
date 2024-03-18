<?php
// Verificar se o ID da turma foi fornecido na URL
if (isset($_GET['id'])) {
    // Incluir a conexão com o banco de dados
    include "../conexao/conexao.php";

    // Recuperar o ID da turma da URL
    $turma_id = $_GET['id'];

    // Consulta SQL para excluir a turma com base no ID fornecido
    $sql = "DELETE FROM turmas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $turma_id);

    // Executar a consulta
    if ($stmt->execute()) {
        // Redirecionar de volta para a página de gestão de turmas com mensagem de sucesso
        session_start();
        $_SESSION["success_message"] = "Turma excluída com sucesso!";
        header("Location: ../telas/gerenciar_turmas.php");
        exit();
    } else {
        // Se houver um erro ao excluir a turma, redirecionar com mensagem de erro
        session_start();
        $_SESSION["error_message"] = "Erro ao excluir a turma: " . $stmt->error;
        header("Location: ../telas/gestao_turmas.php");
        exit();
    }

    // Fechar a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    // Se o ID da turma não foi fornecido na URL, redirecionar de volta para a página de gestão de turmas
    header("Location: ../telas/gerenciar_turmas.php");
    exit();
}
?>

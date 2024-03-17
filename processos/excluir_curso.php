<?php
// Incluir a conexão com o banco de dados
include "../conexao/conexao.php";

// Verificar se o ID do curso foi fornecido via GET
if (isset($_GET['id'])) {
    // Recuperar o ID do curso da URL
    $curso_id = $_GET['id'];

    // Preparar e executar a consulta SQL para excluir o curso
    $sql = "DELETE FROM cursos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $curso_id);

    if ($stmt->execute()) {
        // Redirecionar para a página de gerenciamento de cursos com uma mensagem de sucesso
        session_start();
        $_SESSION["success_message"] = "Curso excluído com sucesso!";
        header("Location: ../telas/gerenciar_cursos.php");
        exit();
    } else {
        // Se houver um erro ao excluir o curso, exibir uma mensagem de erro
        session_start();
        $_SESSION["error_message"] = "Erro ao excluir o curso: " . $conn->error;
        header("Location: ../telas/gerenciar_cursos.php");
        exit();
    }

    // Fechar a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    // Se o ID do curso não foi fornecido, redirecionar para a página de gerenciamento de cursos
    header("Location: ../telas/gerenciar_cursos.php");
    exit();
}
?>

<?php
session_start();
include "../conexao/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    // Excluir aluno do banco de dados
    $stmt = $conn->prepare("DELETE FROM alunos WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION["mensagem_sucesso"] = "Aluno excluído com sucesso!";
    } else {
        $_SESSION["mensagem_erro"] = "Erro ao excluir aluno: " . $conn->error;
    }
}

header("Location: ../telas/gerenciar_alunos.php");
exit();
?>

<?php
// Incluir a conexão com o banco de dados
include "../conexao/conexao.php";

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar os dados do formulário
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $carga_horaria = $_POST["carga_horaria"];
    $id = $_POST["id"];

    // Validar os dados, se necessário

    // Inserir o novo curso no banco de dados
    $sql = "INSERT INTO cursos (id, titulo, descricao, carga_horaria) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $id, $titulo, $descricao, $carga_horaria);

    if ($stmt->execute()) {
        // Redirecionar para a página de gerenciamento de cursos com uma mensagem de sucesso
        session_start();
        $_SESSION["success_message"] = "Curso adicionado com sucesso!";
        header("Location: ../telas/gerenciar_cursos.php");
        exit();
    } else {
        // Se houver um erro ao inserir o curso, exibir uma mensagem de erro
        session_start();
        $_SESSION["error_message"] = "Erro ao adicionar o curso: " . $conn->error;
        header("Location: ../telas/gerenciar_cursos.php");
        exit();
    }

    // Fechar a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    // Se o formulário não foi submetido corretamente, redirecionar para a página de gerenciamento de cursos
    header("Location: ../telas/gerenciar_cursos.php");
    exit();
}
?>

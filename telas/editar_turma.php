<?php
// Incluir a conexão com o banco de dados
include "../conexao/conexao.php";

// Verificar se foi fornecido um ID de turma na URL
if (isset($_GET['id'])) {
    // Recuperar o ID da turma da URL
    $turma_id = $_GET['id'];

    // Consulta SQL para selecionar a turma com base no ID
    $sql = "SELECT * FROM turmas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $turma_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar se há resultados
    if ($resultado->num_rows > 0) {
        // Exibir o formulário de edição com os dados da turma
        $turma = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Turma - Centro de Formação Gestor Bongo</title>
</head>
<body>
    <h2>Editar Turma</h2>
    <form action="../processos/processar_editar_turma.php" method="POST">
        <input type="hidden" name="turma_id" value="<?php echo $turma['id']; ?>">
        
        <label for="nome_turma">Nome da Turma:</label><br>
        <input type="text" id="nome_turma" name="nome_turma" value="<?php echo $turma['nome_turma']; ?>" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4" cols="50"><?php echo $turma['descricao']; ?></textarea><br><br>

        <label for="sala">Sala:</label><br>
        <input type="text" id="sala" name="sala" value="<?php echo $turma['sala']; ?>"><br><br>

        <label for="data_inicio">Data de Início:</label><br>
        <input type="date" id="data_inicio" name="data_inicio" value="<?php echo $turma['data_inicio']; ?>"><br><br>

        <label for="data_termino">Data de Término:</label><br>
        <input type="date" id="data_termino" name="data_termino" value="<?php echo $turma['data_termino']; ?>"><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
<?php
    } else {
        echo "<p>Turma não encontrada.</p>";
    }

    // Fechar a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    echo "<p>ID da turma não especificado.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso - Centro de Formação Gestor Bongo</title>
    <link rel="stylesheet" href="../estilos/editar_curso.css">
</head>
<body>
    <h2>Editar Curso</h2>
    
    <?php
    // Verificar se foi fornecido um ID de curso na URL
    if (isset($_GET['id'])) {
        // Recuperar o ID do curso da URL
        $curso_id = $_GET['id'];

        // Incluir conexão com o banco de dados
        include "../conexao/conexao.php";

        // Consulta SQL para selecionar o curso com base no ID
        $sql = "SELECT * FROM cursos WHERE id = $curso_id";
        $resultado = $conn->query($sql);

        // Verificar se há resultados
        if ($resultado->num_rows > 0) {
            // Exibir o formulário de edição com os dados do curso
            $curso = $resultado->fetch_assoc();
    ?>
            <form action="../processos/processar_aditar_curso.php" method="POST">
                <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                
                <label for="titulo">Título do Curso:</label><br>
                <input type="text" id="titulo" name="titulo" value="<?php echo $curso['titulo']; ?>" required><br><br>

                <label for="descricao">Descrição:</label><br>
                <textarea id="descricao" name="descricao" rows="4" cols="50"><?php echo $curso['descricao']; ?></textarea><br><br>

                <label for="carga_horaria">Carga Horária:</label><br>
                <input type="text" id="carga_horaria" name="carga_horaria" value="<?php echo $curso['carga_horaria']; ?>"><br><br>

                <label for="instrutor">Instrutor:</label><br>
                <input type="text" id="instrutor" name="instrutor" value="<?php echo $curso['instrutor']; ?>"><br><br>

                <label for="sala">Sala:</label><br>
                <input type="text" id="sala" name="sala" value="<?php echo $curso['sala']; ?>"><br><br>

                <label for="data_inicio">Data de Início:</label><br>
                <input type="date" id="data_inicio" name="data_inicio" value="<?php echo $curso['data_inicio']; ?>"><br><br>

                <label for="data_termino">Data de Término:</label><br>
                <input type="date" id="data_termino" name="data_termino" value="<?php echo $curso['data_termino']; ?>"><br><br>

                <button type="submit">Salvar Alterações</button>
            </form>
    <?php
        } else {
            echo "<p>Curso não encontrado.</p>";
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    } else {
        echo "<p>ID do curso não especificado.</p>";
    }
    ?>
    
    <a href="../telas/gerenciar_cursos.php">Voltar</a>
</body>
</html>

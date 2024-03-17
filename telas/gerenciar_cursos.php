<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cursos - Centro de Formação Gestor Bongo</title>
    <link rel="stylesheet" href="../estilos/gerenciar_cursos.css">
</head>
<body>
    <h2>Gerenciar Cursos</h2>
    
    <!-- Adicionar novo curso -->
    <a href="../formularios/frm_adicionar_curso.php">Adicionar Novo Curso</a>
    
    <!-- Lista de cursos -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome do Curso</th>
            <th>Descrição</th>
            <th>Carga Horária</th>
            <th>Instrutor</th>
            <th>Sala</th>
            <th>Data de Início</th>
            <th>Data de Término</th>
            <th>Ações</th>
        </tr>
        <?php 
        // Incluir a conexão com o banco de dados
        include "../conexao/conexao.php";

        // Consulta SQL para selecionar todos os cursos
        $sql = "SELECT * FROM cursos";
        $resultado = $conn->query($sql);

        // Verificar se há cursos no resultado
        if ($resultado->num_rows > 0) {
            // Exibir os cursos
            while ($curso = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $curso["id"]; ?></td>
                    <td><?php echo $curso["titulo"]; ?></td>
                    <td><?php echo $curso["descricao"]; ?></td>
                    <td><?php echo $curso["carga_horaria"]; ?></td>
                    <td><?php echo $curso["instrutor"]; ?></td>
                    <td><?php echo $curso["sala"]; ?></td>
                    <td><?php echo $curso["data_inicio"]; ?></td>
                    <td><?php echo $curso["data_termino"]; ?></td>
                    <td>
                        <a href="editar_curso.php?id=<?php echo $curso["id"]; ?>">Editar</a> |
                        <a href="../processos/excluir_curso.php?id=<?php echo $curso["id"]; ?>" onclick="return confirm('Tem certeza que deseja excluir este curso?')">Excluir</a>
                    </td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='9'>Nenhum curso encontrado.</td></tr>";
        }
        ?>
    </table>

    <!-- Link para voltar à página anterior -->
    <a href="painel.php">Voltar</a>
</body>
</html>

<?php
// Incluir a conexão com o banco de dados
include "../conexao/conexao.php";

// Consulta SQL para selecionar todas as turmas
$sql = "SELECT * FROM turmas";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Turmas - Centro de Formação Gestor Bongo</title>
    <link rel="stylesheet" href="../estilos/gerenciar_turmas.css">
</head>
<body>
    <h2>Gestão de Turmas</h2>

    <a href="../formularios/frm_adicionar_turma.php"><h4>Adicionar Turma</h4></a>

    <!-- Lista de turmas existentes -->
    <h3>Turmas Existentes</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome da Turma</th>
            <th>Descrição</th>
            <th>Sala</th>
            <th>Data de Início</th>
            <th>Data de Término</th>
            <th>Ações</th>
        </tr>
        <?php 
        if ($resultado->num_rows > 0) {
            while ($turma = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $turma["id"]; ?></td>
                    <td><?php echo $turma["nome_turma"]; ?></td>
                    <td><?php echo $turma["descricao"]; ?></td>
                    <td><?php echo $turma["sala"]; ?></td>
                    <td><?php echo $turma["data_inicio"]; ?></td>
                    <td><?php echo $turma["data_termino"]; ?></td>
                    <td>
                        <a href="editar_turma.php?id=<?php echo $turma["id"]; ?>">Editar</a> |
                        <a href="../processos/excluir_turma.php?id=<?php echo $turma["id"]; ?>" onclick="return confirm('Tem certeza que deseja excluir esta turma?')">Excluir</a>
                    </td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='7'>Nenhuma turma encontrada.</td></tr>";
        }
        ?>
    </table>

    <!-- Link para voltar ao painel principal -->
    <a href="painel.php">Voltar ao Painel</a>
</body>
</html>

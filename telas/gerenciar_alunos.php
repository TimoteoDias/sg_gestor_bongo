<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Alunos - Centro de Formação Gestor Bongo</title>
    <link rel="stylesheet" href="../estilos/gerenciar_alunos.css">
</head>
<body>
    

    <div class="container">
        <h2>Gerenciar Alunos</h2>
        <form action="../telas/gerenciar_alunos.php" method="GET">
            <label for="pesquisa">Pesquisar Alunos:</label>
            <input type="text" id="pesquisa" name="q" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
            <button type="submit">Pesquisar</button> <br>
            <h3><a href="../formularios/frm_adicionar_aluno.php" class="btn">Adicionar Novo Aluno</a></h3>
        
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Data de Nascimento</th>
                    <th>Data de Matrícula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Inclua a conexão com o banco de dados
                include "../conexao/conexao.php";
                
                // Função para formatar datas
                function formatarData($data) {
                    return date("d/m/Y", strtotime($data));
                }

                // Definir o termo de pesquisa como vazio por padrão
                $termo_pesquisa = "";

                // Verifica se um termo de pesquisa foi enviado
                if(isset($_GET['q'])) {
                    $termo_pesquisa = $_GET['q'];
                }

                // Consulta SQL para selecionar os alunos filtrados pelo termo de pesquisa
                $sql = "SELECT * FROM alunos WHERE nome LIKE '%$termo_pesquisa%' OR email LIKE '%$termo_pesquisa%'";
                $resultado = $conn->query($sql);

                // Verifica se há erro na consulta
                if (!$resultado) {
                    die("Erro ao recuperar os alunos: " . $conn->error);
                }

                // Exibir os resultados da consulta
                while ($row = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["nome"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["telefone"]; ?></td>
                        <td><?php echo $row["endereco"]; ?></td>
                        <td><?php echo formatarData($row["data_nascimento"]); ?></td>
                        <td><?php echo formatarData($row["data_matricula"]); ?></td>
                        <td>
                            <a href="editar_aluno.php?id=<?php echo $row["id"]; ?>">Editar</a> |
                            <a href="../processos/excluir_aluno.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="painel.php" class="btn">Voltar Atrás</a>
        <?php 
        // Consulta SQL para contar o total de alunos cadastrados
        $sql_total_alunos = "SELECT COUNT(*) AS total_alunos FROM alunos";
        $resultado_total_alunos = $conn->query($sql_total_alunos);
        $total_alunos = $resultado_total_alunos->fetch_assoc()['total_alunos'];
        ?>
        <!-- Exibir o total de alunos cadastrados -->
        <p>Total de Alunos Cadastrados: <?php echo $total_alunos; ?></p>
       
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 - CENTRO DE FORMAÇAO GESTOR BONGO</p>
        </div>
    </footer>
</body>
</html>

<?php
// Feche a conexão com o banco de dados
$conn->close();
?>

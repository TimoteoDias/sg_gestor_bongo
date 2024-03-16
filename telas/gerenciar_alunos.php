<?php
// Inclua a conexão com o banco de dados
include "../conexao/conexao.php";

// Função para formatar datas
function formatarData($data) {
    return date("d/m/Y", strtotime($data));
}

// Consulta SQL para selecionar todos os alunos
$sql = "SELECT * FROM alunos";
$resultado = $conn->query($sql);

// Verifica se há erro na consulta
if (!$resultado) {
    die("Erro ao recuperar os alunos: " . $conn->error);
}

// Verifica se há mensagem de sucesso ao cadastrar, editar ou excluir aluno
if (isset($_SESSION['success_message'])) {
    echo "<p style='color: green;'>".$_SESSION['success_message']."</p>";
    unset($_SESSION['success_message']);
}

// Verifica se há mensagem de erro ao cadastrar, editar ou excluir aluno
if (isset($_SESSION['error_message'])) {
    echo "<p style='color: red;'>".$_SESSION['error_message']."</p>";
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Alunos - Centro de Formação Gestor Bongo</title>
    <link rel="stylesheet" href="../estilos/gerenciar_alunos.css
    ">
</head>
<body>
    <h2>Gerenciar Alunos</h2>
    <a href="../formularios/frm_adicionar_aluno.php">Adicionar Novo Aluno</a>
    <table border="1">
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
        <?php while ($row = $resultado->fetch_assoc()) { ?>
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
                <a href="excluir_aluno.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
// Feche a conexão com o banco de dados
$conn->close();
?>

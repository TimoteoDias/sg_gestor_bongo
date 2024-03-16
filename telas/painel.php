<?php
// Verifica se a sessão está iniciada
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["usuario_id"])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: index.html");
    exit();
}

// Obtém o nome do usuário da sessão
$nome_usuario = $_SESSION["nome_usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Gerenciamento - <?php echo $nome_usuario; ?></title>
</head>
<body>
    <h2>Bem-vindo, <?php echo $nome_usuario; ?>!</h2>
    <h3>Painel de Gerenciamento</h3>
    <ul>
        <li><a href="gerenciar_alunos.php">Gerenciar Alunos</a></li>
        <li><a href="gerenciar_cursos.php">Gerenciar Cursos</a></li>
        <li><a href="gerar_relatorios.php">Gerar Relatórios</a></li>
        <li><a href="logout.php">Sair</a></li>
    </ul>
</body>
</html>

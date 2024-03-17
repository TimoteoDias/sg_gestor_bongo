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
    <link rel="stylesheet" href="../estilos/painel.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Painel de Gerenciamento</h1><br>
            <br>
            <br>
            <nav>
                <ul>
                    <li><a href="gerenciar_alunos.php">Gerenciar Alunos</a></li>
                    <li><a href="gerenciar_cursos.php">Gerenciar Cursos</a></li>
                    <li><a href="gerar_relatorios.php">Gerar Relatórios</a></li>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Bem-vindo, <?php echo $nome_usuario; ?>!</h2>
        <!-- Conteúdo da página aqui -->
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 - Centro de Formação Gestor Bongo</p>
        </div>
    </footer>
</body>
</html>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Relatórios - Centro de Formação Gestor Bongo</title>
    <link rel="stylesheet" href="../estilos/gerar_relatorios.css">
</head>
<body>
    <h2>Gerar Relatórios</h2>
    
    <!-- Formulário para selecionar o tipo de relatório -->
    <form action="../processos/processar_gerar_relatorio.php" method="POST">
        <label for="tipo_relatorio">Tipo de Relatório:</label><br>
        <select id="tipo_relatorio" name="tipo_relatorio" required>
            <option value="">Selecione...</option>
            <option value="alunos">Relatório de Alunos</option>
            <option value="cursos">Relatório de Cursos</option>
            <!-- Adicione mais opções de relatório conforme necessário -->
        </select><br><br>

        <button type="submit">Gerar Relatório</button>
    </form>

    <a href="../telas/painel.php">Voltar</a>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Curso - Centro de Formação Gestor Bongo</title>
</head>
<body>
    <h2>Adicionar Novo Curso</h2>
    <form action="../processos/processar_adicionar_curso.php" method="POST">
        <label for="titulo">Título do Curso:</label><br>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea><br><br>

        <label for="carga_horaria">Carga Horária:</label><br>
        <input type="text" id="carga_horaria" name="carga_horaria"><br><br>

        <label for="instrutor">Instrutor:</label><br>
        <input type="text" id="instrutor" name="instrutor"><br><br>

        <label for="sala">Sala:</label><br>
        <input type="text" id="sala" name="sala"><br><br>

        <label for="data_inicio">Data de Início:</label><br>
        <input type="date" id="data_inicio" name="data_inicio"><br><br>

        <label for="data_termino">Data de Término:</label><br>
        <input type="date" id="data_termino" name="data_termino"><br><br>

        <button type="submit">Adicionar Curso</button>
    </form>

    <a href="../telas/gerenciar_cursos.php">Voltar</a>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Adicionar Curso</title>
</head>
<body>
    <h2>Adicionar Curso</h2>
    <form action="../processos/processar_adicionar_curso.php" method="post">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" required><br>
        
        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4" cols="50" required></textarea><br>
        
        <label for="carga_horaria">Carga Horária:</label><br>
        <input type="text" id="carga_horaria" name="carga_horaria" required><br>
        
        
        <input type="submit" value="Adicionar Curso">
    </form>
</body>
</html>

<?php
// Incluir a conexão com o banco de dados
include "../conexao/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Nova Turma - Centro de Formação Gestor Bongo</title>
    <link rel="stylesheet" href="../estilos/frm_adicionar_turma.css">
</head>
<body>
    <h2>Adicionar Nova Turma</h2>
    <form action="../processos/processar_adicionar_turma.php" method="POST">
        <label for="nome_turma">Nome da Turma:</label><br>
        <input type="text" id="nome_turma" name="nome_turma" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea><br><br>

        <label for="sala">Sala:</label><br>
        <input type="text" id="sala" name="sala"><br><br>

        <label for="data_inicio">Data de Início:</label><br>
        <input type="date" id="data_inicio" name="data_inicio"><br><br>

        <label for="data_termino">Data de Término:</label><br>
        <input type="date" id="data_termino" name="data_termino"><br><br>

        <button type="submit">Adicionar Turma</button>
    </form>
</body>
</html>

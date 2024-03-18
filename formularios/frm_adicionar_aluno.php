<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aluno - Centro de Formação Gestor Bongo</title>
    <link rel="stylesheet" href="../estilos/frm_adicionar_aluno.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Adicionar Aluno</h1>
            <nav>
                <a href="../telas/gerenciar_alunos.php">Voltar</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <form action="../processos/processar_adicionar_aluno.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="numero_bilhete_identidade">Número do Bilhete de Identidade:</label>
            <input type="text" id="numero_bilhete_identidade" name="numero_bilhete_identidade" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="endereco">Endereço:</label>
            <textarea id="endereco" name="endereco" rows="4" cols="50"></textarea>



            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero">

            <label for="classe">Classe:</label>
            <input type="text" id="classe" name="classe">

            <label for="curso_id">ID do Curso:</label>
            <input type="text" id="curso_id" name="curso_id">

            <input type="submit" value="Adicionar Aluno">
        </form>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 - Centro de Formação Gestor Bongo</p>
        </div>
    </footer>
</body>
</html>

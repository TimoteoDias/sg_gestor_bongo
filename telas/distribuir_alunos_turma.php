<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribuição de Alunos em Turmas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Distribuição de Alunos em Turmas</h1>
        <nav>
            <a href="gerenciar_turmas.php">Gerenciar Turmas</a>
            <a href="gerenciar_alunos.php">Gerenciar Alunos</a>
            <!-- Adicione links para outras páginas relevantes, se necessário -->
        </nav>
    </header>
    <main>
        <form action="processar_distribuicao_alunos.php" method="POST">
            <label for="curso">Curso:</label>
            <select name="curso" id="curso">
                <?php
                // Conexão com o banco de dados
                include "../conexao/conexao.php";

                // Recuperar cursos disponíveis do banco de dados
                $sqlCursos = "SELECT id, titulo FROM cursos";
                $resultadoCursos = $conn->query($sqlCursos);

                if ($resultadoCursos->num_rows > 0) {
                    while ($curso = $resultadoCursos->fetch_assoc()) {
                        echo "<option value='" . $curso['id'] . "'>" . $curso['titulo'] . "</option>";
                    }
                }
                ?>
            </select>

            <label for="classe">Classe:</label>
            <select name="classe" id="classe">
                <?php
                // Recuperar classes disponíveis do banco de dados
                $sqlClasses = "SELECT id, nome FROM classes";
                $resultadoClasses = $conn->query($sqlClasses);

                if ($resultadoClasses->num_rows > 0) {
                    while ($classe = $resultadoClasses->fetch_assoc()) {
                        echo "<option value='" . $classe['id'] . "'>" . $classe['nome'] . "</option>";
                    }
                }
                ?>
            </select>

            <label for="alunos">Alunos Disponíveis:</label>
            <select name="alunos[]" id="alunos" multiple>
                <?php
                // Recuperar alunos disponíveis do banco de dados
                $sqlAlunos = "SELECT id, nome FROM alunos WHERE matriculado = 0";
                $resultadoAlunos = $conn->query($sqlAlunos);

                if ($resultadoAlunos->num_rows > 0) {
                    while ($aluno = $resultadoAlunos->fetch_assoc()) {
                        echo "<option value='" . $aluno['id'] . "'>" . $aluno['nome'] . "</option>";
                    }
                }
                ?>
            </select>

            <label for="turmas">Turmas Disponíveis:</label>
            <select name="turmas[]" id="turmas" multiple>
                <?php
                // Recuperar turmas disponíveis do banco de dados
                $sqlTurmas = "SELECT id, nome FROM turmas";
                $resultadoTurmas = $conn->query($sqlTurmas);

                if ($resultadoTurmas->num_rows > 0) {
                    while ($turma = $resultadoTurmas->fetch_assoc()) {
                        echo "<option value='" . $turma['id'] . "'>" . $turma['nome'] . "</option>";
                    }
                }
                ?>
            </select>

            <input type="submit" value="Distribuir Alunos">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 - Centro de Formação Gestor Bongo</p>
    </footer>
</body>
</html>

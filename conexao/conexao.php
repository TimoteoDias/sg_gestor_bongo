<?php
// Configurações do banco de dados
$host = '127.0.0.1'; // Endereço do servidor MySQL
$usuario = 'root'; // Nome de usuário do MySQL
$senha = ''; // Senha do MySQL (deixe em branco para root sem senha)
$banco = 'centro_bongo'; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para criar a tabela alunos
$sql_alunos = "CREATE TABLE IF NOT EXISTS alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    endereco VARCHAR(255),
    data_nascimento DATE,
    data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Executa a consulta SQL para criar a tabela alunos
if ($conn->query($sql_alunos) === TRUE) {
    echo "Tabela alunos criada com sucesso!<br>";
} else {
    echo "Erro ao criar a tabela alunos: " . $conn->error . "<br>";
}

// Consulta SQL para criar a tabela cursos
$sql_cursos = "CREATE TABLE IF NOT EXISTS cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    carga_horaria INT,
    instrutor VARCHAR(100),
    sala VARCHAR(50),
    data_inicio DATE,
    data_termino DATE
)";

// Executa a consulta SQL para criar a tabela cursos
if ($conn->query($sql_cursos) === TRUE) {
    echo "Tabela cursos criada com sucesso!<br>";
} else {
    echo "Erro ao criar a tabela cursos: " . $conn->error . "<br>";
}

// Consulta SQL para criar a tabela matriculas
$sql_matriculas = "CREATE TABLE IF NOT EXISTS matriculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT,
    curso_id INT,
    data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (aluno_id) REFERENCES alunos(id),
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
)";

// Executa a consulta SQL para criar a tabela matriculas
if ($conn->query($sql_matriculas) === TRUE) {
    echo "Tabela matriculas criada com sucesso!<br>";
} else {
    echo "Erro ao criar a tabela matriculas: " . $conn->error . "<br>";
}

// Consulta SQL para criar a tabela pagamentos
$sql_pagamentos = "CREATE TABLE IF NOT EXISTS pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricula_id INT,
    valor DECIMAL(10, 2),
    data_pagamento DATE,
    FOREIGN KEY (matricula_id) REFERENCES matriculas(id)
)";

// Executa a consulta SQL para criar a tabela pagamentos
if ($conn->query($sql_pagamentos) === TRUE) {
    echo "Tabela pagamentos criada com sucesso!<br>";
} else {
    echo "Erro ao criar a tabela pagamentos: " . $conn->error . "<br>";
}

// Consulta SQL para criar a tabela usuarios
$sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
)";

// Executa a consulta SQL para criar a tabela usuarios
if ($conn->query($sql_usuarios) === TRUE) {
    echo "Tabela usuarios criada com sucesso!<br>";
} else {
    echo "Erro ao criar a tabela usuarios: " . $conn->error . "<br>";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

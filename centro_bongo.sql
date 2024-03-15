INCLUDE 'conexao/conexao.php';

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    endereco VARCHAR(255),
    data_nascimento DATE,
    data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

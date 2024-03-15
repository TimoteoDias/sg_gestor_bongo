<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conecta ao banco de dados
    include 'config.php'; // Arquivo de configuração com os dados de conexão

    // Consulta SQL para selecionar o usuário com base no email
    $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = '$email'";

    // Executa a consulta
    $result = $conn->query($sql);

    // Verifica se encontrou o usuário
    if ($result->num_rows > 0) {
        // Obtém os dados do usuário
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $nome = $row["nome"];
        $email = $row["email"];
        $senha_hash = $row["senha"];

        // Verifica se a senha fornecida está correta
        if (password_verify($senha, $senha_hash)) {
            // Inicia a sessão e armazena os dados do usuário
            session_start();
            $_SESSION["id"] = $id;
            $_SESSION["nome"] = $nome;
            $_SESSION["email"] = $email;

            // Redireciona para a página de perfil do usuário
            header("Location: perfil.php");
            exit();
        } else {
            // Senha incorreta
            echo "Senha incorreta. <a href='login.php'>Tente novamente</a>.";
        }
    } else {
        // Email não encontrado
        echo "Email não encontrado. <a href='login.php'>Tente novamente</a>.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>

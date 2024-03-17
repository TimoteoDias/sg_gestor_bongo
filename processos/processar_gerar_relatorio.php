<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar o tipo de relatório selecionado
    $tipo_relatorio = $_POST["tipo_relatorio"];

    // Redirecionar para a página de relatório correspondente com o tipo de relatório como parâmetro
    header("Location: ../telas/relatorio_$tipo_relatorio.php");
    exit();
} else {
    // Se o formulário não foi enviado corretamente, redirecionar de volta para a página de geração de relatórios
    header("Location: ../telas/gerar_relatorios.php");
    exit();
}
?>

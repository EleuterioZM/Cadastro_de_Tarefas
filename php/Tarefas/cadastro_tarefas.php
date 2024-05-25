<?php
// Habilita a exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui a classe de conexão ao banco de dados
require_once '../Connection/Database.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Instancia a classe Database
    $db = new Database();

    // Prepara e executa a instrução SQL para inserir os dados no banco de dados
    $stmt = $db->prepare("INSERT INTO tarefasdiarias (Actividade, Recursos_Necessarios, Resp_Actividade, Data_Inicio, Data_Fim, Observacoes) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $db->conn->error);
    }

    // Atribui os valores dos campos do formulário às variáveis
    $actividade = $_POST['actividade'];
    $recursos_necessarios = $_POST['recursos_necessarios'];
    $resp_actividade = $_POST['resp_actividade'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $observacoes = $_POST['observacoes'];

    // Vincula os parâmetros e executa a instrução SQL
    $stmt->bind_param("ssssss", $actividade, $recursos_necessarios, $resp_actividade, $data_inicio, $data_fim, $observacoes);

    if ($stmt->execute()) {
        // Redireciona para a página de listagem de tarefas após o cadastro bem-sucedido
        header("Location: /SCT/Cadastro_de_Tarefas/tarefas/FRMListarTarefas.php?success=true");
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        echo "Erro ao inserir os dados: " . $stmt->error;
    }

    // Fecha a instrução e a conexão com o banco de dados
    $stmt->close();
    $db->close();
}
?>

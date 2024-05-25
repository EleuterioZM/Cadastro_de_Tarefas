<?php
require 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $actividade = $_POST['actividade'];
    $recursos_necessarios = $_POST['recursos_necessarios'];
    $resp_actividade = $_POST['resp_actividade'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $observacoes = $_POST['observacoes'];

    $db = new Database();

    $stmt = $db->prepare("INSERT INTO tarefas (actividade, recursos_necessarios, resp_actividade, data_inicio, data_fim, observacoes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $actividade, $recursos_necessarios, $resp_actividade, $data_inicio, $data_fim, $observacoes);

    if ($stmt->execute()) {
        echo "Tarefa cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar tarefa: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
} else {
    echo "Método de requisição inválido.";
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clientestarefasdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $item = $_POST['Item'];
    $actividade = $_POST['actividade'];
    $recursos_necessarios = $_POST['recursos_necessarios'];
    $resp_actividade = $_POST['resp_actividade'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $observacoes = $_POST['observacoes'];

    // Prepara a consulta SQL para atualizar a tarefa
    $sql = "UPDATE tarefasdiarias SET 
            Actividade='$actividade', 
            Recursos_Necessarios='$recursos_necessarios', 
            Resp_Actividade='$resp_actividade', 
            Data_Inicio='$data_inicio', 
            Data_Fim='$data_fim', 
            Observacoes='$observacoes' 
            WHERE Item=$item";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: /SCT/Cadastro_de_Tarefas/Tarefas/FRMListarTarefas.php?updated=true");
        exit();
    } else {
        echo "Erro ao atualizar tarefa: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>

<?php
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

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST["item"];

    // Prepara a consulta SQL para exclusão da tarefa
    $sql = "DELETE FROM tarefasdiarias WHERE Item = $item";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página de listagem após a exclusão bem-sucedida
        header("Location: /SCT/Cadastro_de_Tarefas/Tarefas/FRMListarTarefas.php?deleted=true");
        exit();
    } else {
        echo "Erro ao excluir a tarefa: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

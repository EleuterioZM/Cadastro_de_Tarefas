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
    $id = $_POST["id"];
    $empresa = $_POST["empresa"];
    $endereco = $_POST["endereco"];
    $contacto = $_POST["contacto"];
    $email = $_POST["email"];
    $data = $_POST["data"];
    $objecto = $_POST["objecto"];
    $contabilidade_fiscalidade = $_POST["contabilidade_fiscalidade"];
    $auditoria = $_POST["auditoria"];
    $rh = $_POST["rh"];
    $assessoria_juridica = $_POST["assessoria_juridica"];
    $expectativa = $_POST["expectativa"];
    $criterios = $_POST["criterios"];

    // Prepara a consulta SQL para atualização dos dados do cliente
    $sql = "UPDATE clientes SET 
            Empresa = '$empresa', 
            Endereco = '$endereco', 
            Contacto = '$contacto', 
            Email = '$email', 
            Data = '$data', 
            Objecto = '$objecto', 
            ContabilidadeFiscalidade = '$contabilidade_fiscalidade', 
            Auditoria = '$auditoria', 
            Rh = '$rh', 
            Acessoria_Juridica = '$assessoria_juridica', 
            Expectativa = '$expectativa', 
            Criterios = '$criterios'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para o formulário de listagem após a atualização bem-sucedida
        header("Location: /SCT/Cadastro_de_Tarefas/clientes/FRMListarClientes.php?updated=true");
        exit();
    } else {
        echo "Erro ao atualizar o cliente: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

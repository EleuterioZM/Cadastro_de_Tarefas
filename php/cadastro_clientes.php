<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clientestarefasdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Prepara e executa a instrução SQL para inserir os dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO clientes (empresa, endereco, contacto, email, data, objecto, contabilidade_fiscalidade, auditoria, rh, assessoria_juridica, expectativa, criterios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $empresa, $endereco, $contacto, $email, $data, $objecto, $contabilidade_fiscalidade, $auditoria, $rh, $assessoria_juridica, $expectativa, $criterios);

    // Atribui os valores dos campos do formulário às variáveis
    $empresa = $_POST['empresa'];
    $endereco = $_POST['endereco'];
    $contacto = $_POST['contacto'];
    $email = $_POST['email'];
    $data = $_POST['data'];
    $objecto = $_POST['objecto'];
    $contabilidade_fiscalidade = $_POST['contabilidade_fiscalidade'];
    $auditoria = $_POST['auditoria'];
    $rh = $_POST['rh'];
    $assessoria_juridica = $_POST['assessoria_juridica'];
    $expectativa = $_POST['expectativa'];
    $criterios = $_POST['criterios'];

    // Executa a instrução SQL
    if ($stmt->execute()) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir os dados: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>

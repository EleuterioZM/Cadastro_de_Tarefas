<?php
// Habilita a exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    $stmt = $conn->prepare("INSERT INTO clientes (Empresa, Endereco, Contacto, Email, Data, Objecto, ContabilidadeFiscalidade, Auditoria, Rh, Acessoria_Juridica, Expectativa, Criterios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssss", $empresa, $endereco, $contacto, $email, $data, $objecto, $contabilidadeFiscalidade, $auditoria, $rh, $acessoria_juridica, $expectativa, $criterios);

    // Atribui os valores dos campos do formulário às variáveis
    $empresa = $_POST['empresa'];
    $endereco = $_POST['endereco'];
    $contacto = $_POST['contacto'];
    $email = $_POST['email'];
    $data = $_POST['data'];
    $objecto = $_POST['objecto'];
    $contabilidadeFiscalidade = $_POST['contabilidade_fiscalidade'];
    $auditoria = $_POST['auditoria'];
    $rh = $_POST['rh'];
    $acessoria_juridica = $_POST['assessoria_juridica'];
    $expectativa = $_POST['expectativa'];
    $criterios = $_POST['criterios'];

    // Executa a instrução SQL
    if ($stmt->execute()) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir os dados: " . $stmt->error;
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>

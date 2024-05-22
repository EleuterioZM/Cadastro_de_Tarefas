<?php
// Habilita a exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui a classe de conexão ao banco de dados
require_once 'Connection/Database.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Instancia a classe Database
    $db = new Database();

    // Prepara e executa a instrução SQL para inserir os dados no banco de dados
    $stmt = $db->prepare("INSERT INTO clientes (Empresa, Endereco, Contacto, Email, Data, Objecto, ContabilidadeFiscalidade, Auditoria, Rh, Acessoria_Juridica, Expectativa, Criterios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $db->conn->error);
    }

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

    // Vincula os parâmetros e executa a instrução SQL
    $stmt->bind_param("ssssssssssss", $empresa, $endereco, $contacto, $email, $data, $objecto, $contabilidadeFiscalidade, $auditoria, $rh, $acessoria_juridica, $expectativa, $criterios);

    if ($stmt->execute()) {
        // Redireciona para a página de listagem de clientes após o cadastro bem-sucedido
        header("Location: /SCT/Cadastro_de_Tarefas/clientes/FRMListarClientes.php?success=true");
        exit(); // Certifique-se de sair após o redirecionamento
    }
    
     else {
        echo "Erro ao inserir os dados: " . $stmt->error;
    }

    // Fecha a instrução e a conexão com o banco de dados
    $stmt->close();
    $db->close();
}
?>

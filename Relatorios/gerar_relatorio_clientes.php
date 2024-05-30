<?php
require_once('../tcpdf/tcpdf.php');

// Função para adicionar cabeçalho e tabela
function addTable($pdf, $headers, $data)
{
    // Adiciona o cabeçalho
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetFillColor(102, 153, 204); // Cor de fundo do cabeçalho
    $pdf->SetTextColor(255, 255, 255); // Cor do texto do cabeçalho

    foreach ($headers as $header) {
        $pdf->Cell(40, 10, $header, 1, 0, 'C', 1);
    }
    $pdf->Ln();

    // Estilo para os dados
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetTextColor(0, 0, 0); // Cor do texto preto

    // Adiciona os dados
    foreach ($data as $row) {
        foreach ($row as $value) {
            $pdf->Cell(40, 10, $value, 1, 0, 'L');
        }
        $pdf->Ln();
    }
}

// Cria um novo documento PDF na orientação Retrato (vertical) e tamanho A4
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Configurações do documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Seu Nome');
$pdf->SetTitle('Lista de Clientes');
$pdf->SetSubject('Relatório de Clientes');
$pdf->SetKeywords('Clientes, Relatório, PDF');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clientestarefasdb";

// Conexão com a base de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta SQL para os dados da primeira tabela
$sql1 = "SELECT id, Empresa, Endereco, Contacto, Email, Data FROM clientes";
$result1 = $conn->query($sql1);

// Dados da primeira tabela
$data1 = [];
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $data1[] = array_values($row);
    }
}

// Adiciona a primeira tabela
$headers1 = ['ID', 'Empresa', 'Endereço', 'Contacto', 'Email', 'Data'];
addTable($pdf, $headers1, $data1);

// Consulta SQL para os dados da segunda tabela
$sql2 = "SELECT id, Objecto, ContabilidadeFiscalidade, Auditoria, Rh FROM clientes";
$result2 = $conn->query($sql2);

// Dados da segunda tabela
$data2 = [];
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $data2[] = array_values($row);
    }
}

// Adiciona uma nova página para a segunda tabela
$pdf->AddPage();

// Configurações de estilo para o cabeçalho da segunda tabela
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(102, 153, 204); // Cor de fundo do cabeçalho
$pdf->SetTextColor(255, 255, 255); // Cor do texto do cabeçalho

// Cabeçalho para a segunda tabela
$headers2 = ['ID', 'Objecto', 'Contabilidade ', 'Auditoria', 'RH'];


$pdf->Ln();

// Adiciona a segunda tabela
addTable($pdf, $headers2, $data2);

$pdf->Output('lista_clientes.pdf', 'D');

$conn->close();
?>

<?php
require_once('../tcpdf/tcpdf.php');

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

// Cabeçalho
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Lista de Clientes', 0, 1, 'C');
$pdf->Ln(10); // Espaço após o cabeçalho

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(102, 153, 204); // Cor de fundo do cabeçalho
$pdf->SetTextColor(255, 255, 255); // Cor do texto do cabeçalho

// Títulos das colunas
$headers = [
    ['ID', 'Empresa', 'Endereço', 'Contacto', 'Email', 'Data'],
    ['Objecto', 'Contabilidade Fiscalidade', 'Auditoria', 'RH', 'Assessoria Jurídica', 'Expectativa', 'Criterios']
];

// Adiciona cabeçalhos
foreach ($headers as $headerRow) {
    foreach ($headerRow as $header) {
        $pdf->Cell(40, 10, $header, 1, 0, 'C', 1);
    }
    $pdf->Ln();
}

// Estilo para os dados
$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(0, 0, 0); // Cor do texto preto

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
$sql = "SELECT id, Empresa, Endereco, Contacto, Email, Data FROM clientes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $value) {
            $pdf->Cell(40, 10, $value, 1, 0, 'L');
        }
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'Nenhum registro encontrado.', 0, 1, 'C');
}

// Adiciona uma nova página para a segunda tabela
$pdf->AddPage();

// Cabeçalho para a segunda tabela
$pdf->SetFont('helvetica', 'B', 10);
foreach ($headers[1] as $header) {
    $pdf->Cell(40, 10, $header, 1, 0, 'C', 1);
}
$pdf->Ln();

// Consulta SQL para os dados da segunda tabela
$sql = "SELECT Objecto, ContabilidadeFiscalidade, Auditoria, Rh, Acessoria_Juridica, Expectativa, Criterios FROM clientes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $value) {
            $pdf->Cell(40, 10, $value, 1, 0, 'L');
        }
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'Nenhum registro encontrado.', 0, 1, 'C');
}

$pdf->Output('lista_clientes.pdf', 'D');

$conn->close();
?>

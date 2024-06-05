<?php
require_once('../tcpdf/tcpdf.php');

// Função para adicionar o título
function addTitle($pdf)
{
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Relatório de Clientes', 0, 1, 'C');
}

// Função para adicionar o cabeçalho da tabela
function addTableHeader($pdf, $headers, $cellWidths, $totalWidth)
{
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetFillColor(102, 153, 204); // Cor de fundo do cabeçalho
    $pdf->SetTextColor(255, 255, 255); // Cor do texto do cabeçalho

    foreach ($headers as $index => $header) {
        $pdf->Cell($cellWidths[$index] * $totalWidth, 8, $header, 1, 0, 'C', 1);
    }
    $pdf->Ln();

    // Define a cor do texto de volta ao preto após o cabeçalho
    $pdf->SetTextColor(0, 0, 0); // Define o texto dos dados em preto
}

// Função para adicionar uma tabela com os dados
function addClientTable($pdf, $headers, $data, $styles)
{
    // Define o número máximo de linhas por página, excluindo o cabeçalho
    $maxRowsPerPage = 22;

    // Calcula a largura total da tabela
    $totalWidth = $pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];
    $cellWidths = $styles['cell_widths']; // Proporções das colunas

    // Adiciona o cabeçalho inicial
    addTableHeader($pdf, $headers, $cellWidths, $totalWidth);

    // Estilo para os dados
    $pdf->SetFont($styles['font'], '', $styles['font_size']); // Fonte normal sem negrito

    // Adiciona os dados
    $rowCount = 0;
    foreach ($data as $row) {
        // Verifica se atingiu o limite de linhas por página
        if ($rowCount >= $maxRowsPerPage) {
            $pdf->AddPage();
            addTableHeader($pdf, $headers, $cellWidths, $totalWidth); // Adiciona cabeçalho na nova página
            $rowCount = 0; // Reinicia o contador de linhas
        }
        // Adiciona os dados da linha
        foreach ($row as $index => $value) {
            $pdf->Cell($cellWidths[$index] * $totalWidth, 8, $value, 1, 0, 'C');
        }
        $pdf->Ln();
        // Incrementa o contador de linhas
        $rowCount++;
    }
}

// Cria um novo documento PDF na orientação Retrato (vertical) e tamanho A4
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(5, 10, 5); // Margens esquerda e direita ajustadas para 5mm
$pdf->AddPage();

// Configurações do documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Seu Nome');
$pdf->SetTitle('Relatório de Clientes');
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

// Consulta SQL para os dados da tabela
$sql = "SELECT id, Empresa, Endereco, Contacto, Email, Data FROM clientes";
$result = $conn->query($sql);

// Dados da tabela
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array_values($row);
    }
}

// Cabeçalho da tabela
$headers = ['ID', 'Empresa', 'Endereço', 'Contacto', 'Email', 'Data'];

// Estilos para a tabela
$styles = [
    'font' => 'helvetica',
    'font_size' => 8,
    'cell_widths' => [0.1, 0.25, 0.15, 0.15, 0.25, 0.1], // Proporções das colunas
];

// Adiciona o título
addTitle($pdf);

// Adiciona a tabela inicial ao PDF
addClientTable($pdf, $headers, $data, $styles);

$pdf->Output('Relatorio_Clientes.pdf', 'D');

$conn->close();
?>

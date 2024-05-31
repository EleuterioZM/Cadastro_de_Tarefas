<?php
require_once('../tcpdf/tcpdf.php');

// Função para adicionar a tabela
function addTaskTable($pdf, $headers, $data)
{
    // Define o número máximo de linhas por página
    $maxRowsPerPage = 7;

    // Adiciona o título centralizado
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Relatório de Tarefas Diárias', 0, 1, 'C');

    // Calcula a largura total da tabela
    $tableWidth = 0;
    foreach ($headers as $index => $header) {
        $tableWidth += 0.15 * $pdf->getPageWidth();
    }

    // Ajusta margens para centralizar a tabela
    $pdf->SetLeftMargin(($pdf->getPageWidth() - $tableWidth) / 2);
    $pdf->SetRightMargin(($pdf->getPageWidth() - $tableWidth) / 2);

    // Adiciona o cabeçalho
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetFillColor(102, 153, 204); // Cor de fundo do cabeçalho
    $pdf->SetTextColor(255, 255, 255); // Cor do texto do cabeçalho

    foreach ($headers as $header) {
        $pdf->Cell(0.15 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
    }
    $pdf->Ln();

    // Estilo para os dados
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetTextColor(0, 0, 0); // Cor do texto preto

    // Adiciona os dados
    $rowCount = 0;
    foreach ($data as $row) {
        // Verifica se atingiu o limite de linhas por página
        if ($rowCount >= $maxRowsPerPage) {
            // Adiciona uma nova página
            $pdf->AddPage();
            // Recria o título centralizado
            $pdf->Cell(0, 10, 'Relatório de Tarefas Diárias', 0, 1, 'C');
            // Recria o cabeçalho
            foreach ($headers as $header) {
                $pdf->Cell(0.15 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
            }
            $pdf->Ln();
            // Reinicia o contador de linhas
            $rowCount = 0;
        }
        // Adiciona os dados da linha
        foreach ($row as $value) {
            $pdf->Cell(0.15 * $pdf->getPageWidth(), 10, $value, 1, 0, 'C');
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
$pdf->SetTitle('Relatório de Tarefas Diárias');
$pdf->SetSubject('Relatório de Tarefas Diárias');
$pdf->SetKeywords('Tarefas, Relatório, PDF');

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
$sql = "SELECT * FROM tarefasdiarias";
$result = $conn->query($sql);

// Dados da tabela
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array_values($row);
    }
}

// Cabeçalho da tabela
$headers = ['Item', 'Atividade', 'Recursos necess', 'Responsável', 'Data de Início', 'Data de Fim', 'Observações'];

// Adiciona a tabela ao PDF
addTaskTable($pdf, $headers, $data);

$pdf->Output('Relatorio_Tarefas.pdf', 'D');

$conn->close();
?>

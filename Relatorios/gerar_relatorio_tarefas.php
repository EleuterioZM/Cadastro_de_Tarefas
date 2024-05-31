<?php
require_once('../tcpdf/tcpdf.php');

// Define a largura do papel com margens maiores nas laterais
$pdf = new TCPDF('P', 'mm', array(210 + 20, 297), true, 'UTF-8', false); // Adiciona 20mm de margem em cada lado horizontal

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Seu Nome');
$pdf->SetTitle('Relatório de Tarefas Diárias');
$pdf->SetSubject('Relatório de Tarefas Diárias');
$pdf->SetKeywords('Tarefas, Relatório, PDF');

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Relatório de Tarefas Diárias', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clientestarefasdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM tarefasdiarias";
$result = $conn->query($sql);

// Títulos das colunas (com cor preta, centralizados e em negrito)
$pdf->SetTextColor(255, 255, 255); // Define a cor do texto como branco
$pdf->SetFillColor(102, 153, 204); // Cor de fundo do cabeçalho: azul meio
$pdf->SetFont('helvetica', 'B', 10); // Define a fonte como negrito e tamanho 10 para os títulos

$pdf->Cell(15, 10, 'Item', 1, 0, 'C', 1);
$pdf->Cell(35, 10, 'Atividade', 1, 0, 'C', 1);
$pdf->Cell(35, 10, 'Recursos necess', 1, 0, 'C', 1); // Abrevia "Recursos Necessários"
$pdf->Cell(40, 10, 'Responsável', 1, 0, 'C', 1);
$pdf->Cell(25, 10, 'Data de Início', 1, 0, 'C', 1);
$pdf->Cell(25, 10, 'Data de Fim', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Observações', 1, 1, 'C', 1); // Diminui a largura da coluna "Observações"

// Define o estilo de fonte para os dados (sem negrito)
$pdf->SetFont('helvetica', '', 10);

// Define a cor do texto para preto para as células de dados
$pdf->SetTextColor(0, 0, 0);

// Dados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(15, 10, $row["Item"], 1, 0, 'C');
        $pdf->Cell(35, 10, $row["Actividade"], 1, 0, 'L');
        $pdf->Cell(35, 10, $row["Recursos_Necessarios"], 1, 0, 'L');
        $pdf->Cell(40, 10, $row["Resp_Actividade"], 1, 0, 'L');
        $pdf->Cell(25, 10, $row["Data_Inicio"], 1, 0, 'C');
        $pdf->Cell(25, 10, $row["Data_Fim"], 1, 0, 'C');
        $pdf->MultiCell(30, 10, $row["Observacoes"], 1, 'L'); // Utiliza MultiCell para permitir quebras de linha na coluna "Observações"
    }
} else {
    $pdf->Cell(0, 10, 'Nenhum registro encontrado.', 0, 1, 'C');
}

$pdf->Output('Relatorio_Tarefas.pdf', 'D');

$conn->close();
?>
 
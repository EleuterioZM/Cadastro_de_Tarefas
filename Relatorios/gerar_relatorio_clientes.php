<?php
require_once('../tcpdf/tcpdf.php');

// Função para adicionar cabeçalho e tabela
function addTable($pdf, $headers, $data, $adjustIdCell = false)
{
    // Define o número máximo de linhas por página
    $maxRowsPerPage = 22;

    // Adiciona o título centralizado
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Relatório de Clientes', 0, 1, 'C');

    // Calcula a largura total da tabela
    $tableWidth = 0;
    foreach ($headers as $index => $header) {
        if ($adjustIdCell && $index === 0) {
            $tableWidth += 0.1 * $pdf->getPageWidth();
        } elseif ($index === 4) {
            $tableWidth += 0.25 * $pdf->getPageWidth();
        } elseif ($index === 5) {
            $tableWidth += 0.15 * $pdf->getPageWidth();
        } else {
            $tableWidth += 0.15 * $pdf->getPageWidth();
        }
    }

    // Ajusta margens para centralizar a tabela
    $pdf->SetLeftMargin(($pdf->getPageWidth() - $tableWidth) / 2);
    $pdf->SetRightMargin(($pdf->getPageWidth() - $tableWidth) / 2);

    // Adiciona o cabeçalho
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetFillColor(102, 153, 204); // Cor de fundo do cabeçalho
    $pdf->SetTextColor(255, 255, 255); // Cor do texto do cabeçalho

    foreach ($headers as $index => $header) {
        if ($adjustIdCell && $index === 0) {
            $pdf->Cell(0.1 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
        } elseif ($index === 4) {
            $pdf->Cell(0.25 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
        } elseif ($index === 5) {
            $pdf->Cell(0.15 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
        } else {
            $pdf->Cell(0.15 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
        }
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
            $pdf->Cell(0, 10, 'Relatório de Clientes', 0, 1, 'C');
            // Recria o cabeçalho
            foreach ($headers as $index => $header) {
                if ($adjustIdCell && $index === 0) {
                    $pdf->Cell(0.1 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
                } elseif ($index === 4) {
                    $pdf->Cell(0.25 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
                } elseif ($index === 5) {
                    $pdf->Cell(0.15 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
                } else {
                    $pdf->Cell(0.15 * $pdf->getPageWidth(), 10, $header, 1, 0, 'C', 1);
                }
            }
            $pdf->Ln();
            // Reinicia o contador de linhas
            $rowCount = 0;
        }
        // Adiciona os dados da linha
        foreach ($row as $index => $value) {
            if ($adjustIdCell && $index === 0) {
                $cellWidth = 0.1 * $pdf->getPageWidth();
            } elseif ($index === 4) {
                $emailParts = explode('@', $value);
                $email = isset($emailParts[1]) ? $emailParts[0] . "\n@" . $emailParts[1] : $value;
                $pdf->Cell(0.25 * $pdf->getPageWidth(), 10, $email, 1, 0, 'C');
                continue;
            } elseif ($index === 5) {
                $cellWidth = 0.15 * $pdf->getPageWidth();
            } else {
                $cellWidth = 0.15 * $pdf->getPageWidth();
            }
            $pdf->Cell($cellWidth, 10, $value, 1, 0, 'C');
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
addTable($pdf, $headers1, $data1, true); // Passa true para ajustar a célula do ID

// Verifica se é necessário adicionar uma nova página após a primeira tabela
if ($pdf->getY() > $pdf->getPageHeight() - 20) {
    $pdf->AddPage();
}

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

// Cabeçalho para a segunda tabela
$headers2 = ['ID', 'Objecto', 'Contabilidade', 'Auditoria', 'RH'];

$pdf->Ln();

// Adiciona a segunda tabela
addTable($pdf, $headers2, $data2, true); // Passa true para ajustar a célula do ID

// Verifica se é necessário adicionar uma nova página após a segunda tabela
if ($pdf->getY() > $pdf->getPageHeight() - 20) {
    $pdf->AddPage();
}

$pdf->Output('Relatorio_Clientes.pdf', 'D');
?>


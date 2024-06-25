<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Visualização de Cliente</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <!-- Adicionando o Font Awesome CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #ae6a55;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .table-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1200px;
        }
        
    </style>
</head>
<body>
<div class="table-container">
<div class="container mt-4">
<h5 class="mb-4 text-center">Detalhes do Cliente</h5>
    <hr>
    <?php
    // Verifica se foi fornecido um ID na URL
    if(isset($_GET['id'])) {
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

        // Prepara a consulta SQL para obter os detalhes do cliente com base no ID fornecido
        $id = $_GET['id'];
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $result = $conn->query($sql);

        // Verifica se encontrou algum resultado
        if ($result->num_rows > 0) {
            // Exibe os detalhes do cliente
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="id" value="<?php echo $row["id"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="empresa">Empresa:</label>
                        <input type="text" class="form-control" id="empresa" value="<?php echo $row["Empresa"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" value="<?php echo $row["Endereco"]; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="contacto">Contacto:</label>
                        <input type="text" class="form-control" id="contacto" value="<?php echo $row["Contacto"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" value="<?php echo $row["Email"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="data">Data:</label>
                        <input type="text" class="form-control" id="data" value="<?php echo $row["Data"]; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="objecto">Objecto:</label>
                        <input type="text" class="form-control" id="objecto" value="<?php echo $row["Objecto"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="contabilidade_fiscalidade">Contabilidade e Fiscalidade:</label>
                        <input type="text" class="form-control" id="contabilidade_fiscalidade" value="<?php echo $row["ContabilidadeFiscalidade"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="auditoria">Auditoria:</label>
                        <input type="text" class="form-control" id="auditoria" value="<?php echo $row["Auditoria"]; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="rh">RH:</label>
                        <input type="text" class="form-control" id="rh" value="<?php echo $row["Rh"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="assessoria_juridica">Assessoria Jurídica:</label>
                        <input type="text" class="form-control" id="assessoria_juridica" value="<?php echo $row["Acessoria_Juridica"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="expectativa">Expectativa:</label>
                        <input type="text" class="form-control" id="expectativa" value="<?php echo $row["Expectativa"]; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="criterios">Critérios:</label>
                        <input type="text" class="form-control" id="criterios" value="<?php echo $row["Criterios"]; ?>" readonly>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Nenhum cliente encontrado com o ID fornecido.</p>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        echo "<p>Nenhum ID de cliente fornecido.</p>";
    }
    ?>
<br>
<hr style>
    <a href="FRMListarClientes.php" class="btn btn-primary">Voltar</a>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<a href="FRMListarClientes.php" style="position: fixed; top: 20px; left: 20px; z-index: 9999;">
            <i class="fas fa-arrow-right fa-flip-horizontal rotate-icon" style="font-size: 30px; color: white;"></i>
        </a>
</body>
</html>

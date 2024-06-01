<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Visualização de Tarefa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
<h5 class="mb-4 text-center">Detalhes da Tarefa</h5>
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

        // Prepara a consulta SQL para obter os detalhes da tarefa com base no ID fornecido
        $id = $_GET['id'];
        $sql = "SELECT * FROM tarefasdiarias WHERE Item = $id";
        $result = $conn->query($sql);

        // Verifica se encontrou algum resultado
        if ($result->num_rows > 0) {
            // Exibe os detalhes da tarefa
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <label for="item">Item:</label>
                        <input type="text" class="form-control" id="item" value="<?php echo $row["Item"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="actividade">Atividade:</label>
                        <input type="text" class="form-control" id="actividade" value="<?php echo $row["Actividade"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="recursos_necessarios">Recursos Necessários:</label>
                        <input type="text" class="form-control" id="recursos_necessarios" value="<?php echo $row["Recursos_Necessarios"]; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="resp_actividade">Responsável pela Atividade:</label>
                        <input type="text" class="form-control" id="resp_actividade" value="<?php echo $row["Resp_Actividade"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="data_inicio">Data de Início:</label>
                        <input type="date" class="form-control" id="data_inicio" value="<?php echo $row["Data_Inicio"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="data_fim">Data de Fim:</label>
                        <input type="date" class="form-control" id="data_fim" value="<?php echo $row["Data_Fim"]; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="observacoes">Observações:</label>
                        <textarea class="form-control" id="observacoes" readonly><?php echo $row["Observacoes"]; ?></textarea>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Nenhuma tarefa encontrada com o ID fornecido.</p>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        echo "<p>Nenhum ID de tarefa fornecido.</p>";
    }
    ?>
<br>
<hr>
    <a href="FRMListarTarefas.php" class="btn btn-primary">Voltar</a>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

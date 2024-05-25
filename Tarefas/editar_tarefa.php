<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edição de Tarefa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #c8e3ee;
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
    <h5 class="mb-4 text-center">Edição de Tarefa</h5>
    <hr>
    <?php
    // Verifica se foi fornecido um id na URL
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

        // Prepara a consulta SQL para obter os detalhes da tarefa com base no id fornecido
        $id = $_GET['id'];
        $sql = "SELECT * FROM tarefasdiarias WHERE Item = $id";
        $result = $conn->query($sql);

        // Verifica se encontrou algum resultado
        if ($result->num_rows > 0) {
            // Exibe o formulário de edição da tarefa
            $row = $result->fetch_assoc();
            ?>
            <form action="../php/Tarefas/atualizar_tarefa.php" method="post">
                <input type="hidden" name="Item" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <label for="actividade">Atividade:</label>
                        <input type="text" class="form-control" id="actividade" name="actividade" value="<?php echo $row['Actividade']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="recursos_necessarios">Recursos Necessários:</label>
                        <input type="text" class="form-control" id="recursos_necessarios" name="recursos_necessarios" value="<?php echo $row['Recursos_Necessarios']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="resp_actividade">Responsável pela Atividade:</label>
                        <input type="text" class="form-control" id="resp_actividade" name="resp_actividade" value="<?php echo $row['Resp_Actividade']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="data_inicio">Data de Início:</label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo $row['Data_Inicio']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="data_fim">Data de Fim:</label>
                        <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo $row['Data_Fim']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="observacoes">Observações:</label>
                        <textarea class="form-control" id="observacoes" name="observacoes"><?php echo $row['Observacoes']; ?></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-block">Atualizar</button>
                    </div>
                    <div class="col-md-2">
                        <a href="FRMListarTarefas.php" class="btn btn-danger btn-block">Cancelar</a>
                    </div>
                </div>
            </form>

            <?php
        } else {
            echo "<p>Nenhuma tarefa encontrada com o id fornecido.</p>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        echo "<p>Nenhum id de tarefa fornecido.</p>";
    }
    ?>
    <br>
    <hr>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

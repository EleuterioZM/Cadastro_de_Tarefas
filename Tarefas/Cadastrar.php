<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro de Tarefas</title>
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
        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1200px;
        }
        .form-control {
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form id="taskForm" method="post" action="../php/Tarefas/cadastro_tarefas.php">
        <h5 class="text-center mb-4">Cadastro de Tarefas</h5>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="actividade">Atividade</label>
                <input type="text" class="form-control" id="actividade" name="actividade" required>
            </div>
            <div class="form-group col-md-6">
                <label for="recursos_necessarios">Recursos Necessários</label>
                <input type="text" class="form-control" id="recursos_necessarios" name="recursos_necessarios">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="resp_actividade">Responsável pela Atividade</label>
                <input type="text" class="form-control" id="resp_actividade" name="resp_actividade">
            </div>
            <div class="form-group col-md-6">
                <label for="data_inicio">Data de Início</label>
                <input type="date" class="form-control" id="data_inicio" name="data_inicio">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="data_fim">Data de Fim</label>
                <input type="date" class="form-control" id="data_fim" name="data_fim">
            </div>
            <div class="form-group col-md-6">
                <label for="observacoes">Observações</label>
                <textarea class="form-control" id="observacoes" name="observacoes"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
            </div>
            <div class="col-md-2">
                <a href="FRMListarTarefas.php" class="btn btn-primary btn-block">Voltar</a>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

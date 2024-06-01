<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Tarefa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ae6a55;
        }

        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('../img/view-3d-school-classroom.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .modal-content h2 {
            margin-top: 0;
        }

        .modal-content p {
            margin-bottom: 20px;
        }

        .modal-content button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .confirm-button {
            background-color: #f44336;
            color: white;
            margin-right: 10px;
        }

        .cancel-button {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="modal-container">
        <div class="modal-content">
            <h2>Exclusão de Tarefa</h2>
            <!-- Verifica se o parâmetro "atividade" foi passado -->
            <?php if (isset($_GET["atividade"])): ?>
                <p>Deseja realmente excluir a tarefa "<?php echo htmlspecialchars($_GET["atividade"]); ?>"?</p>
            <?php else: ?>
                <p>Deseja realmente excluir esta tarefa?</p>
            <?php endif; ?>

            <form id="deleteForm" action="../php/Tarefas/apagar_tarefa.php" method="POST">
                <!-- Adicione os campos ocultos para passar o Item da tarefa -->
                <input type="hidden" name="item" value="<?php echo htmlspecialchars($_GET["item"]); ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="confirm-button">Confirmar Exclusão</button>
                <button type="button" class="cancel-button" onclick="fecharModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        function fecharModal() {
            // Redirecionar de volta para a página de listagem de tarefas
            window.location.href = "FRMListarTarefas.php";
        }
    </script>
</body>
</html>

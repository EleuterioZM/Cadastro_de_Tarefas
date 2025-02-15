<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lista de Tarefas Diárias</title>
    <link href="../assets/css/style.css" rel="stylesheet">
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
            margin-top: 6.5vw;
        }

        .action-icons {
            display: flex;
            justify-content: space-around;
        }

        .action-icons a {
            color: #000;
            margin: 0 5px;
        }
       
    </style>
</head>

<body>

    <?php include '../includes/menu.php'; ?>



    <div class="table-container">
        <h5 class="text-center mb-4">Lista de Tarefas Diárias</h5>

        <div class="toast" id="successToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
            style="position: absolute; top: 7vw; right: 42vw;">
            <div class="toast-header bg-success text-white">
                <strong class="mr-auto">Sucesso!</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body" id="toastBody">
                <!-- Mensagem será inserida aqui via JavaScript -->
            </div>
        </div>


        <!-- Toast de exclusão -->
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] === 'true'): ?>
            <div class="toast" id="deletedToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
                style="position: absolute; top: 7vw; right: 42vw;">
                <div class="toast-header bg-danger text-white">
                    <strong class="mr-auto">Exclusão!</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Tarefa excluída com sucesso!
                </div>
            </div>
        <?php endif; ?>
        <div class="text-right mb-3">
            <button class="btn btn-success mr-2" onclick="location.href='Cadastrar.php';">Cadastrar Tarefa</button>
            <button class="btn btn-primary" onclick="gerarRelatorio()">Gerar Relatório</button>

        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Atividade</th>
                    <th>Responsável</th>
                    <th>Data de Início</th>
                    <th>Data de Fim</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "clientestarefasdb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Erro de conexão: " . $conn->connect_error);
                }

                $limit = 6; // Número de registros por página
                $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                // Consulta para obter o número total de registros
                $total_result = $conn->query("SELECT COUNT(*) AS total FROM tarefasdiarias");
                $total_rows = $total_result->fetch_assoc()['total'];
                $total_pages = ceil($total_rows / $limit);

                // Consulta para obter os registros da página atual
                $sql = "SELECT * FROM tarefasdiarias LIMIT $limit OFFSET $offset";
                $result = $conn->query($sql);

                // Variável para contar o número de registros
                $counter = 1 + ($page - 1) * $limit;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $counter++ . "</td>";

                        echo "<td>" . $row["Actividade"] . "</td>";
                        echo "<td>" . $row["Resp_Actividade"] . "</td>";
                        echo "<td>" . $row["Data_Inicio"] . "</td>";
                        echo "<td>" . $row["Data_Fim"] . "</td>";
                        echo "<td class='action-icons'>";
                        echo "<a href='visualizar_tarefa.php?id=" . $row["Item"]
                            . "'><i class='fas fa-eye text-success'></i></a>";
                        echo "<a href='editar_tarefa.php?id=" . $row["Item"] . "'><i class='fas fa-edit text-primary'></i></a>";
                        echo "<a href='apagar_tarefa.php?item=" . $row["Item"] . "'><i class='fas fa-trash-alt text-danger'></i></a>";

                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Nenhum registro encontrado</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Paginação -->
        <nav aria-label="Navegação de página">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page)
                        echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
     <!-- bootstrap js -->
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        // Função para exibir o Toast de sucesso
        function showSuccessToast(message) {
            $('#toastBody').text(message);
            $('#successToast').toast('show');
        }

        // Função para exibir o Toast de exclusão
        function showDeletedToast() {
            $('#deletedToast').toast('show');
        }

        // Verifica se a notificação de sucesso deve ser exibida e mostra o Toast
        $(document).ready(function () {
            // Verifica se os parâmetros "success" ou "updated" estão presentes na URL
            const urlParams = new URLSearchParams(window.location.search);
            const successParam = urlParams.get('success');
            const updatedParam = urlParams.get('updated');

            // Mostra o Toast com a mensagem apropriada
            if (successParam === 'true') {
                showSuccessToast('Tarefa cadastrada com sucesso!');
            } else if (updatedParam === 'true') {
                showSuccessToast('Tarefa atualizada com sucesso!');
            }

            // Verifica se o parâmetro "deleted" está presente na URL
            const deletedParam = urlParams.get('deleted');

            // Mostra o Toast de exclusão se o parâmetro estiver presente e for true
            if (deletedParam === 'true') {
                showDeletedToast();
            }
        });


        function gerarRelatorio() {
            // Redireciona para o script PHP que gera o relatório
            window.location.href = '../Relatorios/gerar_relatorio_tarefas.php';

        }


    </script>
</body>

</html>
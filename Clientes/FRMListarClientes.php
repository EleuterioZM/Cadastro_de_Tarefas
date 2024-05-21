<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lista de Clientes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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

<div class="table-container">
    <h5 class="text-center mb-4">Lista de Clientes</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Endereço</th>
                <th>Contacto</th>
                <th>Email</th>
                <th>Data</th>
                
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

            $sql = "SELECT * FROM clientes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["Empresa"] . "</td>";
                    echo "<td>" . $row["Endereco"] . "</td>";
                    echo "<td>" . $row["Contacto"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["Data"] . "</td>";
                  
                    echo "<td class='action-icons'>";
                    echo "<a href='visualizar_cliente.php?id=" . $row["id"] . "'><i class='fas fa-eye'></i></a>";
                    echo "<a href='editar_cliente.php?id=" . $row["id"] . "'><i class='fas fa-edit'></i></a>";
                    echo "<a href='apagar_cliente.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='14' class='text-center'>Nenhum registro encontrado</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>
</html>

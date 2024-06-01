
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro de Clientes</title>
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
            width: 90%; /* Largura aumentada para ocupar 90% da tela */
            max-width: 1200px; /* Largura máxima definida */
        }
        .form-control {
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form id="clientForm" method="post" action="../php/cadastro_clientes.php">

        <h5 class="text-center mb-4">Cadastro de Clientes</h5>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="empresa">Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa" required>
            </div>
            <div class="form-group col-md-4">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco">
            </div>
            <div class="form-group col-md-4">
                <label for="contacto">Contacto</label>
                <input type="tel" class="form-control" id="contacto" name="contacto">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group col-md-4">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data">
            </div>
            <div class="form-group col-md-4">
                <label for="objecto">Objecto</label>
                <input type="text" class="form-control" id="objecto" name="objecto">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="contabilidade_fiscalidade">Contabilidade e Fiscalidade</label>
                <input type="text" class="form-control" id="contabilidade_fiscalidade" name="contabilidade_fiscalidade">
            </div>
            <div class="form-group col-md-4">
                <label for="auditoria">Auditoria</label>
                <input type="text" class="form-control" id="auditoria" name="auditoria">
            </div>
            <div class="form-group col-md-4">
                <label for="rh">RH</label>
                <input type="text" class="form-control" id="rh" name="rh">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="assessoria_juridica">Assessoria Jurídica</label>
                <input type="text" class="form-control" id="assessoria_juridica" name="assessoria_juridica">
            </div>
            <div class="form-group col-md-4">
                <label for="expectativa">Expectativa</label>
                <input type="text" class="form-control" id="expectativa" name="expectativa">
            </div>
            <div class="form-group col-md-4">
                <label for="criterios">Critérios</label>
                <input type="text" class="form-control" id="criterios" name="criterios">
            </div>
        </div>
     

        <div class="row mt-3">
                    <div class="col-md-2">
                    <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
                    </div>
                    <div class="col-md-2">
                        <a href="FRMListarClientes.php" class="btn btn-primary btn-block">Voltar</a>
                    </div>
                </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

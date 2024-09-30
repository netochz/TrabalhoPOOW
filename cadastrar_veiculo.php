<?php
// Inclui a conexão com o banco de dados
include 'conexao.php';

// Inicializa a variável de mensagem
$mensagem = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $placa = $_POST['placa'];
    $tipo_veiculo_id = $_POST['tipo_veiculo'];
    $hora_entrada = date('Y-m-d H:i:s'); // Pega a hora atual no formato do MySQL

    // Insere os dados no banco de dados
    $sql = "INSERT INTO veiculos (placa, tipo_veiculo_id, hora_entrada) 
            VALUES ('$placa', '$tipo_veiculo_id', '$hora_entrada')";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Veículo cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar o veículo: " . $conn->error;
    }

    // Fecha a conexão
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Cadastro - ParkPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Cor de fundo suave */
        }
        .status-card {
            border-radius: 15px; /* Bordas arredondadas */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        h1 {
            color: #000000; /* Cor do título */
        }
        .btn-primary {
            background-color: #007bff; /* Cor do botão */
            border: none; /* Sem borda */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Cor do botão ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card status-card p-4">
            <h1 class="mb-4 text-center">Status do Cadastro</h1>
            
            <?php if ($mensagem): ?>
                <div class="alert <?php echo strpos($mensagem, 'sucesso') !== false ? 'alert-success' : 'alert-danger'; ?> text-center" role="alert">
                    <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>
            
            <a href="index.php" class="btn btn-primary mt-3 d-block mx-auto">Voltar ao Cadastro</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</html>

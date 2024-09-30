<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Inicializa a variável de mensagem
$mensagem = '';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placa = $_POST['placa'];

    // Consulta para obter os dados da saída
    $sql = "SELECT v.placa, tv.descricao AS tipo_veiculo, v.hora_entrada, v.hora_saida, v.tempo_permanencia, v.valor_pago 
            FROM veiculos v 
            JOIN tipo_veiculo tv ON v.tipo_veiculo_id = tv.id 
            WHERE v.placa = '$placa' AND v.hora_saida IS NOT NULL";
    $result = $conn->query($sql);

    // Verifica se o veículo foi encontrado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tempo_permanencia = $row['tempo_permanencia'];
        $valor_pago = $row['valor_pago'];
        
        // Monta o recibo
        $mensagem = "
        <div class='card shadow-lg mt-4'>
            <div class='card-header bg-success text-white text-center'>
                <h2>Recibo de Pagamento</h2>
            </div>
            <div class='card-body'>
                <p><strong>Placa do Veículo:</strong> {$row['placa']}</p>
                <p><strong>Tipo de Veículo:</strong> {$row['tipo_veiculo']}</p>
                <p><strong>Hora de Entrada:</strong> {$row['hora_entrada']}</p>
                <p><strong>Hora de Saída:</strong> {$row['hora_saida']}</p>
                <p><strong>Tempo de Permanência:</strong> " . round($tempo_permanencia, 2) . " horas</p>
                <p><strong>Valor a Pagar:</strong> R$ " . number_format($valor_pago, 2, ',', '.') . "</p>
            </div>
            <div class='card-footer text-center'>
                <p class='text-muted'>Obrigado por utilizar nossos serviços!</p>
            </div>
        </div>";
    } else {
        $mensagem = "<div class='alert alert-danger mt-4'>Registro de saída não encontrado.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Recibo de Saída - ParkPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #000000;
            font-weight: bold;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .alert {
            font-size: 1.1em;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Buscar Recibo de Saída</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="placa" class="form-label">Placa do Veículo</label>
            <input type="text" class="form-control" id="placa" name="placa" placeholder="Ex: ABC-1234" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Buscar Recibo</button>
    </form>

    <!-- Exibe a mensagem do recibo ou erro -->
    <?php
    if (!empty($mensagem)) {
        echo $mensagem;
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



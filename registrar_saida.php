<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

$resultado = '';
$alert_class = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placa = $_POST['placa'];

    // Consulta para obter o tipo de veículo e a hora de entrada
    $sql = "SELECT tv.descricao AS tipo_veiculo, v.hora_entrada 
            FROM veiculos v 
            JOIN tipo_veiculo tv ON v.tipo_veiculo_id = tv.id 
            WHERE v.placa = '$placa' AND v.hora_saida IS NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tipo_veiculo = $row['tipo_veiculo'];
        $hora_entrada = $row['hora_entrada'];
        
        // Registrar a hora de saída
        $hora_saida = date("Y-m-d H:i:s");
        $tempo_permanencia = (strtotime($hora_saida) - strtotime($hora_entrada)) / 3600; // em horas
        
        // Calcular o valor a pagar
        $valor_pago = calcularTarifa($tipo_veiculo, $tempo_permanencia);

        // Atualizar o registro no banco de dados
        $update_sql = "UPDATE veiculos SET hora_saida = '$hora_saida', tempo_permanencia = '$tempo_permanencia', valor_pago = '$valor_pago' WHERE placa = '$placa'";
        if ($conn->query($update_sql) === TRUE) {
            $resultado = "Saída registrada com sucesso. Tempo de permanência: " . round($tempo_permanencia, 2) . " horas. Valor a pagar: R$ " . number_format($valor_pago, 2, ',', '.');
            $alert_class = 'alert-success';
        } else {
            $resultado = "Erro ao registrar a saída: " . $conn->error;
            $alert_class = 'alert-danger';
        }
    } else {
        $resultado = "Veículo não encontrado ou já registrado para saída.";
        $alert_class = 'alert-warning';
    }
}

// Função para calcular a tarifa considerando frações de hora
function calcularTarifa($tipo_veiculo, $tempo) {
    $tarifa_inicial = 0; // Valor inicial para cada tipo de veículo
    $tarifa_por_hora = 2; // Tarifa adicional por hora ou fração

    // Define o valor inicial da tarifa conforme o tipo de veículo
    if ($tipo_veiculo == "carro de passeio") {
        $tarifa_inicial = 4;
    } elseif ($tipo_veiculo == "moto") {
        $tarifa_inicial = 2;
    } elseif ($tipo_veiculo == "caminhonete") {
        $tarifa_inicial = 6;
    }

    // Calcula o tempo de permanência em frações de hora (arredonda para cima)
    $tempo_em_horas = ceil($tempo * 60) / 60;

    // O valor total será o valor inicial mais o adicional por tempo
    $tarifa_total = $tarifa_inicial + ($tempo_em_horas > 1 ? ($tempo_em_horas - 1) * $tarifa_por_hora : 0);

    return $tarifa_total;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Saída - ParkPlus</title>
    <!-- Inclui o Bootstrap para facilitar o layout responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Registrar Saída de Veículo</h1>

        <!-- Exibe a mensagem de sucesso, erro ou alerta -->
        <?php if ($resultado): ?>
        <div class="alert <?= $alert_class ?> text-center">
            <?= $resultado ?>
        </div>
        <?php if ($alert_class === 'alert-success'): ?>
            <a href="recibo.php?placa=<?= htmlspecialchars($placa) ?>" class="btn btn-primary mt-3">Ver Recibo</a>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Inclui os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Consulta para obter todos os veículos
$sql = "SELECT v.placa, tv.descricao AS tipo_veiculo, v.hora_entrada, v.hora_saida, v.tempo_permanencia, v.valor_pago 
        FROM veiculos v 
        JOIN tipo_veiculo tv ON v.tipo_veiculo_id = tv.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Estacionamento - ParkPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Cor de fundo suave */
        }
        h1 {
            color: #000000; /* Cor do título */
            text-align: center; /* Centraliza o título */
            margin-top: 20px; /* Margem superior */
            margin-bottom: 30px; /* Margem inferior */
        }
        .table {
            background-color: #fff; /* Fundo da tabela */
            border-radius: 10px; /* Bordas arredondadas */
            overflow: hidden; /* Para bordas arredondadas funcionarem */
        }
        .table th {
            background-color: #007bff; /* Cor de fundo do cabeçalho */
            color: white; /* Cor do texto do cabeçalho */
        }
        .table td {
            vertical-align: middle; /* Alinha o texto ao centro */
        }
        .alert {
            text-align: center; /* Centraliza o texto das mensagens */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Histórico de Estacionamento</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Tipo de Veículo</th>
                        <th>Hora de Entrada</th>
                        <th>Hora de Saída</th>
                        <th>Tempo de Permanência</th>
                        <th>Valor Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['placa']; ?></td>
                            <td><?php echo $row['tipo_veiculo']; ?></td>
                            <td><?php echo $row['hora_entrada']; ?></td>
                            <td><?php echo $row['hora_saida'] ? $row['hora_saida'] : 'Ainda no estacionamento'; ?></td>
                            <td><?php echo round($row['tempo_permanencia'], 2) . ' horas'; ?></td>
                            <td>R$ <?php echo number_format($row['valor_pago'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Nenhum registro encontrado.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


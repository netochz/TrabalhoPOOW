<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - ParkPlus</title>
    <!-- Inclui o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Administração de Veículos</h1>

        <?php
        // Verifica se há uma mensagem na URL
        if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
        }
        ?>

        <!-- Tabela para listar veículos -->
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Placa</th>
                    <th>Tipo de Veículo</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Saída</th>
                    <th>Tempo de Permanência</th>
                    <th>Valor Pago</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta todos os registros de veículos
                $sql = "SELECT v.id, v.placa, t.descricao AS tipo_veiculo, v.hora_entrada, v.hora_saida, 
                        v.tempo_permanencia, v.valor_pago 
                        FROM veiculos v 
                        JOIN tipo_veiculo t ON v.tipo_veiculo_id = t.id";
                $result = $conn->query($sql);

                // Verifica se há registros
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['placa']}</td>
                                <td>{$row['tipo_veiculo']}</td>
                                <td>{$row['hora_entrada']}</td>
                                <td>" . ($row['hora_saida'] ? $row['hora_saida'] : 'Ainda no estacionamento') . "</td>
                                <td>" . round($row['tempo_permanencia'], 2) . " horas</td>
                                <td>R$ " . number_format($row['valor_pago'], 2, ',', '.') . "</td>
                                <td>
                                    <a href='excluir_veiculo.php?id={$row['id']}' class='btn btn-danger btn-sm'>Excluir</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Nenhum veículo encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Inclui os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


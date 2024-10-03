<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkPlus - Estacionamento Inteligente</title>
    
    <!-- Inclui o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Estilo Personalizado -->
    <style>
        /* Estilo para o cabeçalho */
        header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        /* Estilo para a área de informações */
        .info-section {
            background-color: #f8f9fa;
            padding: 40px 0;
        }

        .info-section h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Estilo do formulário */
        .card {
            animation: fadeIn 1.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        button {
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Estilo do rodapé */
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        /* Loader */
        .spinner-border {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Estilo para o mapa (imagem estática de exemplo) */
        .map-image {
            width: 100%;
            height: 300px;
            background-image: url('https://img.freepik.com/fotos-gratis/garagem-vazia-com-estacionamentos-com-teto-e-piso-de-concreto-e-pilares-marcados-com-numeros_342744-1241.jpg?t=st=1727670451~exp=1727674051~hmac=6eec83595286718e9d2fe008b8eb0e0ade8b28c21a9f145b397333f1b79b4241&w=1380'); /* Trocar por uma imagem real */
            background-size: cover;
            background-position: center;
            margin-bottom: 40px;
        }

        /* Corpo da página */
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

      <!-- Cabeçalho -->
    <header>
    <div class="container text-center py-4">
        <!-- Logo e nome do sistema -->
        <h1>ParkPlus - Estacionamento Inteligente</h1>
       
        <!-- Navegação centralizada abaixo do texto -->
        <nav class="mt-3">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="saida.php" class="nav-link text-white hover-link">Saída</a>
                </li>
                <li class="nav-item">
                    <a href="historico.php" class="nav-link text-white hover-link">Histórico</a>
                </li>
                <li class="nav-item">
                    <a href="admin.php" class="nav-link text-white hover-link">Administração</a>
                </li>
                <li class="nav-item">
                    <a href="recibo.php" class="nav-link text-white hover-link">Buscar Recibo</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- Estilo adicional para o hover -->
<style>
    .hover-link:hover {
        text-decoration: none;
        color: #f0a500; /* Cor de hover personalizada */
    }
</style>
    <!-- Seção informativa -->
    <section class="info-section">
        <div class="container">
            <h2>Facilidade no Registro de Veículos</h2>
            <p class="text-center mb-4">Nosso sistema automatizado garante um processo simples e eficiente para registrar e gerenciar veículos no estacionamento. Veja abaixo como você pode cadastrar seu veículo.</p>
            
            <!-- Mapa ou visualização do local (imagem estática de exemplo) -->
            <div class="map-image"></div>

            <!-- Formulário de cadastro de veículos -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-4">Cadastro de Veículos</h3>
                            <form action="cadastrar_veiculo.php" method="POST">
                                <!-- Campo para a placa do veículo -->
                                <div class="mb-3">
                                    <label for="placa" class="form-label">Placa do Veículo</label>
                                    <input type="text" class="form-control" id="placa" name="placa" placeholder="Ex: ABC-1234" required>
                                </div>

                                <!-- Campo para selecionar o tipo de veículo -->
                                <div class="mb-3">
                                    <label for="tipo_veiculo" class="form-label">Tipo de Veículo</label>
                                    <select class="form-control" id="tipo_veiculo" name="tipo_veiculo" required>
                                        <option value="">Selecione o tipo de veículo</option>
                                        <?php
                                        // Consulta os tipos de veículos disponíveis no banco de dados
                                        $sql = "SELECT id, descricao FROM tipo_veiculo";
                                        $result = $conn->query($sql);

                                        // Preenche as opções do dropdown com os tipos de veículo
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['descricao'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Botão para submeter o formulário -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-car"></i> Cadastrar Veículo
                                    </button>
                                    <!-- Animação de carregamento -->
                                    <div id="loading" style="display: none;">
                                        <div class="spinner-border text-primary mt-3" role="status">
                                            <span class="visually-hidden">Carregando...</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <p>&copy; 2024 ParkPlus Solutions. Todos os direitos reservados.</p>
            <p>Desenvolvido por Roberto Chaves</p>
        </div>
    </footer>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>


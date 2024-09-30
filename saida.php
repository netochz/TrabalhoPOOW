<?php
// Inclui a conexão com o banco de dados
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Saída - ParkPlus</title>
    <!-- Inclui o Bootstrap para facilitar o layout responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclui ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilo personalizado para animações e layout -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 500px;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
            animation: slideIn 1s ease-in-out;
        }

        .form-label {
            font-size: 16px;
            font-weight: 600;
        }

        .form-control {
            height: 50px;
            border-radius: 8px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            height: 50px;
            font-size: 18px;
            font-weight: 600;
            display: block;
            width: 100%;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Carregamento (Loading Spinner) */
        .spinner-border {
            display: none;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Registrar Saída de Veículo</h1>

        <!-- Formulário para buscar o veículo pela placa -->
        <form action="registrar_saida.php" method="POST" onsubmit="showLoading()">
            <div class="form-group">
                <label for="placa" class="form-label">Placa do Veículo</label>
                <input type="text" class="form-control" id="placa" name="placa" placeholder="Ex: ABC-1234" required>
            </div>

            <!-- Botão para submeter o formulário -->
            <button type="submit" class="btn btn-primary">Registrar Saída</button>

            <!-- Animação de carregamento -->
            <div class="spinner-border text-primary mt-3" role="status">
                <span class="visually-hidden">Carregando...</span>
            </div>
        </form>
    </div>

    <!-- Inclui os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para mostrar animação de carregamento -->
    <script>
        function showLoading() {
            document.querySelector('.spinner-border').style.display = 'block';
        }
    </script>
</body>
</html>


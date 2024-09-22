<?php
include('conect.php'); // Certifique-se de que a conexão está correta
include('conexao.php');

session_start();

// Verifique se o ID da sessão está definido
if (!isset($_SESSION['id'])) {
    echo "Erro: ID de sessão não definido. Faça o login novamente.";
    exit;
}

$id = $_SESSION['id'];

// Buscar tarefas do usuário
$sql = "SELECT * FROM tarefas WHERE id_usuario = '$id'";
$result = $conn->query($sql);

// Verificar se a consulta executou corretamente
if ($result === FALSE) {
    echo "Erro na consulta SQL: " . $conn->error;
    exit;
}

$tarefas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tarefas[] = $row;
    }
}

// Verificar se as tarefas estão sendo recuperadas
//var_dump($tarefas); // Para verificar os dados recuperados

// Função para gerar sugestões com base nas tarefas
function gerarSugestoes($tarefas)
{
    $sugestoes = [];

    // Verificar tarefas pendentes
    $pendentes = array_filter($tarefas, function ($tarefa) {
        return isset($tarefa['status']) && $tarefa['status'] == 'pendente';
    });

    if (count($pendentes) > 0) {
        $sugestoes[] = "Você tem " . count($pendentes) . " tarefa(s) pendente(s). Considere priorizá-las.";
    }

    // Verificar tarefas concluídas
    $concluidas = array_filter($tarefas, function ($tarefa) {
        return isset($tarefa['status']) && $tarefa['status'] == 'concluida';
    });

    if (count($concluidas) > 0) {
        $sugestoes[] = "Você completou " . count($concluidas) . " tarefa(s). Ótimo trabalho!";
    }

    // Adicione mais lógica conforme necessário
    return $sugestoes;
}

// Gerar sugestões com base nas tarefas
$sugestoes = gerarSugestoes($tarefas);

// Fechar conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Sugestões de Planejamento</title>
    <style>
        body {
            background-color: #e9f5e9;
            font-family: 'Arial', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            color: #2c6e49;
            margin-bottom: 20px;
            font-size: 24px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        li:hover {
            background-color: #c3e6cb;
        }

        .botao-voltar {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #2c6e49;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .botao-voltar:hover {
            background-color: #24532a;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <button class="botao-voltar" onclick="window.location.href='index.php'">Voltar</button>
    <div class="container">
        <h2>Sugestões Personalizadas</h2>
        <ul>
            <?php if (count($sugestoes) > 0): ?>
                <?php foreach ($sugestoes as $sugestao): ?>
                    <li><?php echo htmlspecialchars($sugestao); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Nenhuma sugestão disponível no momento.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>

</html>
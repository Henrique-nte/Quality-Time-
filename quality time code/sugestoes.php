<?php
// Conectar ao banco de dados
include 'conect.php'; // Certifique-se de que este arquivo contém as credenciais corretas

// Função para buscar tarefas do banco de dados
function buscarTarefas($conn)
{
    $query = "SELECT * FROM tarefas"; // Ajuste conforme necessário
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die('Query Error: ' . mysqli_error($conn)); // Erro na consulta SQL
    }

    $tarefas = [];
    while ($tarefa = mysqli_fetch_assoc($resultado)) {
        $tarefas[] = $tarefa;
    }
    return $tarefas;
}

// Função para gerar sugestões
function gerarSugestoes($tarefas)
{
    $sugestoes = [];
    $hoje = date('Y-m-d');

    // Verificar tarefas pendentes
    $pendentes = array_filter($tarefas, fn($tarefa) => $tarefa['status'] === 'pendente');

    // Sugestão de tarefas para hoje
    $proximas_tarefas = array_filter($pendentes, fn($tarefa) => $tarefa['dia'] === $hoje);
    if (count($proximas_tarefas) > 0) {
        $sugestoes[] = "Você tem tarefas para hoje. Não se esqueça delas!";
    }

    // Sugestão de dias produtivos
    if (!empty($dias_produtivos)) {
        $nomes_dias = ['1' => 'segunda-feira', '2' => 'terça-feira', '3' => 'quarta-feira', '4' => 'quinta-feira', '5' => 'sexta-feira', '6' => 'sábado', '7' => 'domingo'];
        $dias_nomes = array_map(fn($dia) => $nomes_dias[$dia], $dias_produtivos);
        $sugestoes[] = "Notei que você é mais produtivo " . implode(', ', $dias_nomes) . ". Considere realizar suas atividades mais urgentes nesses dias.";
    }

    $sugestoes = [
        "Você tem muitas tarefas programadas para esta semana. Considere planejar seus dias, dedicando horários específicos para tarefas de alta prioridade nas segundas e quartas-feiras, quando você é mais produtivo.",
        "Notei que você tem uma tarefa grande intitulada 'Projeto Final'. Para facilitar, que tal dividi-la em subtarefas menores? Isso pode ajudar a tornar a conclusão mais gerenciável.",
        "Você tem várias tarefas que não foram concluídas na última semana. Considere priorizá-las e reservá-las em um tempo específico nos próximos dias para evitar acúmulos.",
        "Percebi que você tem várias tarefas relacionadas ao estudo. Tente aplicar a técnica de Pomodoro, dividindo seu tempo em blocos de 25 minutos de trabalho seguidos por breves pausas. Isso pode aumentar sua concentração e eficiência.",
        "Você tem um bom número de tarefas concluídas este mês. Para manter esse ritmo, considere reservar um tempo a cada sexta-feira para revisar seu progresso e ajustar suas prioridades para a próxima semana.",
        "Você parece estar mais produtivo quando utiliza blocos de tempo. Experimente agendar suas tarefas mais desafiadoras nos períodos em que você se sente mais alerta e focado.",
        "Percebi que você tem tarefas que se repetem semanalmente. Que tal agendá-las todas em um único dia da semana para otimizar seu tempo?",
        "Você possui várias tarefas na área de 'saúde'. Considere agendar uma sessão de autocuidado semanal, como yoga ou meditação, para manter seu bem-estar.",
        "Várias de suas tarefas têm prazos próximos. Tente concluir as tarefas com prazo mais próximo até a quarta-feira para aliviar sua carga de trabalho no final da semana.",
        "Considere dedicar um tempo todo domingo à noite para refletir sobre as tarefas da semana anterior e planejar as da próxima. Isso pode ajudar a melhorar sua organização e foco."

    ];










    // Remover duplicações
    $sugestoes = array_unique($sugestoes);
    return $sugestoes;


}

// Buscar tarefas do banco de dados
$tarefas = buscarTarefas($conn);
$sugestoes = gerarSugestoes($tarefas);

// Fechar a conexão com o banco de dados
mysqli_close($conn);
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
            min-height: 100vh;
            margin: 0;
            position: relative;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            /* Aumentado para mais espaço interno */
            width: 100%;
            max-width: 1000px;
            /* Aumentado para maior largura */
            box-sizing: border-box;
            display: flex;
            /* Usado para centrar conteúdo */
            flex-direction: column;
            /* Coloca os itens em coluna */
            align-items: center;
            /* Centraliza os itens */
        }

        h2 {
            text-align: center;
            color: #2c6e49;
            margin-bottom: 25px;
            /* Aumentado para mais espaço abaixo do título */
            font-size: 40px;
            /* Tamanho do título */
        }

        ul {
            list-style-type: none;
            padding: 0;
            width: 100%;
            /* Ocupa toda a largura do container */
        }

        li {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 18px;
            /* Aumentado para melhorar a legibilidade */
        }

        li:hover {
            background-color: #c3e6cb;
        }

        .no-sugestoes {
            text-align: center;
            color: #777;
            font-size: 18px;
            padding: 20px;
            /* Espaço para mensagens quando não há sugestões */
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
            font-size: 18px;
            /* Aumentado para melhor proporção */
            transition: background-color 0.3s ease;
        }

        .botao-voltar:hover {
            background-color: #24532a;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
                /* Ajustado para manter a proporção em telas menores */
            }
        }
    </style>
</head>

<body>
    <button class="botao-voltar" onclick="window.location.href='index.php'">Voltar</button>
    <div class="container">
        <h2>Sugestões Personalizadas</h2>
        <ul>
            <?php if (isset($sugestoes) && count($sugestoes) > 0): ?>
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
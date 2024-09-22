<?php
// Função para gerar sugestões com base nas tarefas
function gerarSugestoes($tarefas)
{
    $sugestoes = [];
    $hoje = date('Y-m-d');

    // Verificar tarefas pendentes
    $pendentes = array_filter($tarefas, fn($tarefa) => $tarefa['status'] === 'pendente');
    if (count($pendentes) > 0) {
        $sugestoes[] = "Você tem " . count($pendentes) . " tarefa(s) pendente(s). Considere priorizá-las.";
    }

    // Verificar tarefas para hoje
    $proximas_tarefas = array_filter($pendentes, fn($tarefa) => $tarefa['dia'] === $hoje);
    if (count($proximas_tarefas) > 0) {
        $sugestoes[] = "Você tem " . count($proximas_tarefas) . " tarefa(s) para hoje. Não se esqueça delas!";
    }

    // Sugestão de prioridade
    $alta_prioridade = array_filter($tarefas, fn($tarefa) => $tarefa['prioridade'] === 'alta');
    if (count($alta_prioridade) > 0) {
        $sugestoes[] = "Você tem " . count($alta_prioridade) . " tarefa(s) de alta prioridade. Verifique se estão em
andamento.";
    }

    // Sugestão com base na carga de trabalho
    $carga_de_trabalho = count($tarefas);
    if ($carga_de_trabalho > 5) {
        $sugestoes[] = "Você tem " . $carga_de_trabalho . " tarefas no total. Considere delegar algumas ou priorizar as mais
importantes.";
    }

    // Sugestão para revisão de tarefas concluídas
    $concluidas = array_filter($tarefas, fn($tarefa) => $tarefa['status'] === 'concluída');
    if (count($concluidas) > 0) {
        $sugestoes[] = "Você concluiu " . count($concluidas) . " tarefa(s). Excelente trabalho! Reveja-as para ver seu
progresso.";
    }

    // Sugestão de tarefas repetidas
    $repetidas = array_filter($tarefas, fn($tarefa) => isset ($tarefa['repetir']) && $tarefa['repetir']);
    if (count($repetidas) > 0) {
        $sugestoes[] = "Você tem tarefas repetidas. Considere revisá-las para melhorar sua eficiência.";
    }

    // Sugestão de tarefas relacionadas
    foreach ($pendentes as $tarefa) {
        foreach ($pendentes as $comparar) {
            if ($tarefa['natureza'] === $comparar['natureza'] && $tarefa['id'] !== $comparar['id']) {
                $sugestoes[] = "Considere revisar as tarefas relacionadas: " . $tarefa['nome'] . " e " . $comparar['nome'] . ".";
            }
        }
    }

    // Sugestão para quebra de tarefas grandes
    foreach ($pendentes as $tarefa) {
        if (strlen($tarefa['descricao']) > 10) { // Considera longa se descrição > 100 caracteres
            $sugestoes[] = "A tarefa '" . $tarefa['nome'] . "' parece longa. Considere dividi-la em subtarefas.";
        }
    }

    // Sugestão para revisão de progresso
    if (date('N') == 1) { // Se for segunda-feira
        $sugestoes[] = "É início de semana! Revise suas tarefas e defina suas prioridades.";
    }

    return $sugestoes;
}

// Gerar sugestões
$sugestoes = gerarSugestoes($tarefas);
echo json_encode($sugestoes);
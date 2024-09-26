<?php
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

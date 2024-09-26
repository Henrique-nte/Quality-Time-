<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemas";

// Conexão ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o ID da tarefa foi passado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input
    $status = 'concluida'; // Novo status

    // Atualiza o status da tarefa
    $sql = "UPDATE tarefas SET status='$status', data_conclusao = NOW() WHERE id='$id'";




    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redireciona para a página inicial
        exit;
    } else {
        echo "Erro ao atualizar tarefa: " . $conn->error;
    }
} else {
    echo "ID da tarefa não fornecido.";
}

// Fechar a conexão
$conn->close();

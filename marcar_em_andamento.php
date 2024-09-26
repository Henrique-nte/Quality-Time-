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

// Obtendo o ID da tarefa a partir da URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Atualizando o status da tarefa
if ($id > 0) {
    $sql = "UPDATE tarefas SET status = 'em andamento' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a página de tarefas
        header("Location: index.php"); // Substitua pelo seu arquivo
        exit();
    } else {
        echo "Erro ao atualizar tarefa: " . $conn->error;
    }
} else {
    echo "ID da tarefa inválido.";
}

// Fechar a conexão
$conn->close();


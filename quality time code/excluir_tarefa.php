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
    $id = intval($_GET['id']);
    // Consulta para excluir a tarefa
    $sql = "DELETE FROM tarefas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Tarefa excluída com sucesso.";
    } else {
        echo "Erro ao excluir a tarefa: " . $conn->error;
    }
} else {
    echo "ID da tarefa não fornecido.";
}

// Fechar a conexão
$conn->close();
?>

<a href="index.php">Voltar para a lista de tarefas</a>
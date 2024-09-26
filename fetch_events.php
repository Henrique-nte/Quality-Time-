<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
$host = 'localhost'; // seu host
$db = 'sistemas'; // seu banco de dados
$user = 'root'; // seu usuário
$pass = ''; // sua senha

$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para pegar as tarefas
$sql = "SELECT nome AS title, dia AS start, descricao AS description FROM tarefas WHERE prioridade = 'Alta'";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// Fechar a conexão
$conn->close();

// Retornar os dados em JSON
echo json_encode($events);

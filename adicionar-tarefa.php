<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Tarefa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* Estilos existentes... */

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      position: relative;
      /* Adicionado para permitir posicionamento absoluto */
      background-color: #f4f7f6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url(img/bd1.png);
      background-size: cover;
      background-attachment: fixed;
    }



    .container {
      background-color: #fff;
      padding: 20px 25px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
      border: solid 3px #00ffbd;
    }

    h2 {
      text-align: center;
      color: #333;
      font-size: 22px;
      margin-bottom: 15px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      font-size: 13px;
      color: #333;
      margin-bottom: 5px;
      display: block;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      border-color: #01BF86;
    }

    .btn {
      width: 100%;
      background-color: #01BF86;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #018f66;
    }

    .success-message,
    .error-message {
      text-align: center;
      margin-top: 15px;
      padding: 10px;
      border-radius: 5px;
      font-size: 14px;
    }

    .success-message {
      color: #155724;
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
    }

    .error-message {
      color: #721c24;
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
    }

    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      text-decoration: none;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      display: flex;
      align-items: center;
    }

    .back-button:hover {
      color: #018f66;
    }

    .back-button svg {
      margin-right: 5px;
    }

    @media(max-width: 600px) {
      .container {
        padding: 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Botão de voltar -->
  <a href="index.php" class="back-button">
    <!-- Ícone opcional de seta -->
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
      <path fill-rule="evenodd"
        d="M15 8a.5.5 0 0 1-.5.5H3.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
    </svg>
    Voltar
  </a>

  <div class="container">
    <h2>ADICIONAR NOVA TAREFA</h2>
    <form id="taskForm" method="POST">

      <!-- Campos do formulário -->
      <div class="form-group">
        <label for="nome">Nome da Tarefa:</label>
        <input type="text" id="nome" name="nome" required>
      </div>

      <div class="form-group">
        <label for="natureza">Natureza:</label>
        <select id="natureza" name="natureza" required>
          <option value="">Selecione uma opção</option>
          <option value="trabalho">Trabalho</option>
          <option value="projeto">Projeto</option>
          <option value="estudo">Estudo</option>
        </select>
      </div>

      <div class="form-group">
        <label for="dia">Dia de Entrega:</label>
        <input type="date" id="dia" name="dia" required>
      </div>

      <div class="form-group">
        <label for="hora">Horário de Entrega:</label>
        <input type="time" id="hora" name="hora" required>
      </div>

      <div class="form-group">
        <label for="descricao">Descrição da Tarefa:</label>
        <textarea id="descricao" name="descricao" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="prioridade">Prioridade:</label>
        <select id="prioridade" name="prioridade" required>
          <option value="">Selecione uma prioridade</option>
          <option value="alta">Alta</option>
          <option value="media">Média</option>
          <option value="baixa">Baixa</option>
        </select>
      </div>

      <div class="form-group">
        <label for="status">Status:</label>
        <select id="status" name="status" required>
          <option value="">Selecione o status</option>
          <option value="em_andamento">Em Andamento</option>

          <option value="pendente">Pendente</option>
        </select>
      </div>


      <button type="submit" class="btn">Salvar Tarefa</button>

      <?php


      include('conect.php');

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se todos os campos obrigatórios foram preenchidos
        if (!empty($_POST['nome']) && !empty($_POST['natureza']) && !empty($_POST['dia']) && !empty($_POST['hora']) && !empty($_POST['descricao']) && !empty($_POST['prioridade'])) {
          // Captura os dados do formulário
          $nome = $_POST['nome'];
          $natureza = $_POST['natureza'];
          $dia = $_POST['dia'];
          $hora = $_POST['hora'];
          $descricao = $_POST['descricao'];
          $prioridade = $_POST['prioridade'];
          $status = $_POST['status'];

          // Pega o id do usuário logado da sessão
          $id_usuario = $_SESSION['id'];  // Certifique-se de que o ID do usuário está salvo na sessão
      
          // Insere os dados no banco de dados
          $sql = "INSERT INTO tarefas (nome, natureza, dia, hora, descricao, prioridade, status, id_usuario) 
                VALUES ('$nome', '$natureza', '$dia', '$hora', '$descricao', '$prioridade', '$status', '$id_usuario')";

          if ($conn->query($sql) === TRUE) {
            echo "<div class='success-message'>Nova tarefa adicionada com sucesso!</div>";
          } else {
            echo "<div class='error-message'>Erro ao adicionar tarefa: " . $conn->error . "</div>";
          }

          $conn->close();
        } else {
          // Exibe uma mensagem de erro se algum campo estiver vazio
          echo "<div class='error-message'>Por favor, preencha todos os campos!</div>";
        }
      }
      ?>

    </form>
  </div>

</body>

</html>
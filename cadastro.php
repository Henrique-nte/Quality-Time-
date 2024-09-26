<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de login</title>
  <style>
      body {
        font-family: Arial, Helvetica, sans-serif;
        background-image: url(img/bd2.png);
        background-size: cover;
        background-attachment: fixed;
  }

  .area-login {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    justify-content: center;
    align-items: center;
  }

  .login {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #1c0032;
    padding: 70px;
    border-radius: 30px;
    border: #925cb9 solid 4px;

  }

  .login form {
    display: flex;
    width: 107%;
    flex-direction: column;


  }

  .login input {
    margin-top: 14px;
    background-color: #351e4b;
    color: #CBD0F7;
    border: none;
    padding-left: 20px;
    outline: none;
    height: 55px;
    border-radius: 8px;
  }

  .login img {
    width: 200px;
    height: auto;
  }

  input::placeholder {
    color: #CBD0F7;
    font-size: 14px;

  }

  form [type='submit'] {
    display: block;
    background-color: #663399; /* Cor padrão do botão */
    font-size: 20px;
    text-transform: uppercase;
    font-weight: bold;
    cursor: pointer;
    border: none; /* Remove a borda padrão do botão */
    color: white; /* Cor do texto do botão */
    padding: 10px 20px; /* Adiciona algum preenchimento para melhorar a aparência */
    transition: background-color 0.3s ease; /* Adiciona uma transição suave */
}

form [type='submit']:hover {
    background-color: #b496cc; /* Nova cor quando o mouse passa sobre o botão */
}

  p {
    color: white;
  }

  a {
    color: blue;
    text-decoration: none;
    margin-left: 8px;
  }
  h1{
    display: flex;
    justify-content: center;
    color: white;
    font-size: 27px;
  }


    .erro {
      color: red;
    }
  .acerto{
    color: green;
  }
  .ja{
  color: #4cb9fa;
  }
  </style>
</head>

<body>
<section class="area-login">
        <div class="login">

            <div>
                <img src="img/usuario.png">
                
            </div>

            <form method="post">
            <h1>CADASTRO</h1>
                <input type="text" name="nome" placeholder="Nome de usuario" autofocus>
                <input type="password" name="senha" placeholder="Sua senha">

                <input type="submit" value="cadastrar">



                <p>Você ja tem uma conta? <a href="login.php">Entrar em uma conta</a></p>
                <?php
                  include('conexao.php');

                  if(isset($_POST['nome']) && isset($_POST['senha'])) {
                    
                    $nome = $_POST['nome'];
                    $senha = $_POST['senha'];

                    // Verifica se o e-mail já está cadastrado
                    $sql_verifica_nome = "SELECT * FROM usuarios WHERE nome = '$nome'";
                    $resultado_verifica_nome = $mysqli->query($sql_verifica_nome);

                    if($resultado_verifica_nome->num_rows > 0) {
                      echo "<p class='ja'>nome ja cadastrado</p>";
                    } else {
                        // Insere o novo usuário no banco de dados
                        $sql_code = "INSERT INTO usuarios (nome, senha) VALUES ('$nome', '$senha')";
                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

                        if($sql_query) {
                          echo "<p class='acerto'>Usuario cadastrado com sucesso!</p>";
                            // Aqui você pode redirecionar o usuário para a página desejada após o cadastro
                          } else {
                            echo "<p class='erro'>Falha! E-mail ou senha incorretos</p>";
                        }
                    }
                  }
                  ?>



            </form>
            
        </div>
    </section>

</body>

</html>
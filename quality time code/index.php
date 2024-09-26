<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="img/logoo.png">
  <title>Quality Time
  </title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/custom.css" rel="stylesheet">

  <!-- Page Loader -->
  <link href="css/loaders.css" rel="stylesheet">

  <!-- Font Awesome Style -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">




</head>
<style>
  .task-title {
    font-weight: bold;
    font-size: 24px;
    color: #2c444e;
    /* ou outra cor de sua preferência */
    text-align: center;
    margin-bottom: 10px;
  }

  .task-info {
    list-style-type: none;
    /* Remove os marcadores da lista */
    padding: 0;
    /* Remove o padding */
    margin: 10px 0;
    /* Espaço acima e abaixo da lista */
  }

  .task-info li {
    font-size: 20px;
    /* Tamanho da fonte */
    margin: 5px 0;
    /* Espaço entre os itens da lista */
    padding: 5px 10px;
    /* Espaçamento interno dos itens */
    border-bottom: 1px solid #ddd;
    /* Linha entre os itens (opcional) */
  }

  .task-info li:last-child {
    border-bottom: none;
    /* Remove a linha do último item */
  }

  .task-info li strong {
    color: #2c444e;
    font-size: 27px;
    /* Cor para os rótulos */
  }


  .service-icon {
    text-decoration: none;
    /* Remove o sublinhado do link */
    color: inherit;
    /* Herda a cor do texto do pai */
  }

  .service-icon:hover {
    color: inherit;
    /* Mantém a cor ao passar o mouse */
  }


  .card {
    border: none;
    /* Remove a borda padrão do card */
    box-shadow: none;
    /* Remove qualquer sombra do card */
  }

  .plan-block {
    border: none;
    /* Se houver alguma borda nos blocos de plano, remova */
    box-shadow: none;
    /* Remove qualquer sombra do bloco de plano */
  }

  .task-info {
    list-style: none;
    /* Remove marcadores da lista, se houver */
    padding: 0;
    /* Remove o padding da lista */
  }

  .row {
    margin: 0;
    /* Remove margens da linha */
  }

  .col-md-4 {
    padding: 10px;
    /* Adicione um pouco de padding se necessário */
  }



  #progressChart {
    max-width: 900px;
    margin: 20px auto;
  }
</style>

<body>
  <div class="loader loader-bg">
    <div class="loader-inner line-scale">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>

  <!-- Top Navigation 
    ================================================== -->



  <nav class="navbar top-bar navbar-static-top sps sps--abv">
    <div class="container relative-box "> <a class="navbar-brand" href="#">Quality Time</a>
      <button class="navbar-toggler hidden-lg-up collapsed" type="button" data-toggle="collapse"
        data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false"
        aria-label="Toggle navigation"> ☰ </button>
      <div class="navbar-toggleable-md collapse" id="exCollapsingNavbar2">
        <ul class="nav navbar-nav pull-xs-right">
          <li class="nav-item active"> <a class="nav-link" href="#myCarousel">Home <span
                class="sr-only">(current)</span></a> </li>
          <li class="nav-item"> <a class="nav-link" href="calendar.php">Calendário</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#services">Funcionalidades</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#price">Tarefas</a> </li>
          <li class="nav-item"> <a class="nav-link" href="login.php">Login</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#testimonials">Estudantes</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#contact"></a> </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Carousel
    ================================================== -->
  <!-- Carousel
================================================== -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">



      <?php
      include('conect.php'); // Conexão com o banco de dados
      
      // Consulta para buscar tarefas com prioridade alta
      $query = "SELECT * FROM tarefas WHERE prioridade = 'alta'";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        $isActive = true; // Para definir o primeiro item como ativo
        while ($row = $result->fetch_assoc()) {
          // Verifica se é o primeiro item para adicionar a classe "active"
          $activeClass = $isActive ? 'active' : '';
          $isActive = false; // Apenas o primeiro item deve ser ativo
          ?>
          <!-- Tarefa -->
          <div class="carousel-item <?php echo $activeClass; ?>">
            <div class="container">
              <div class="carousel-caption">
                <h1>
                  <?php echo htmlspecialchars($row['nome']); ?>
                </h1>
                <ul class="task-info">
                  <li><strong>Natureza:</strong>
                    <?php echo htmlspecialchars($row['natureza']); ?>
                  </li>
                  <li><strong>Dia:</strong>
                    <?php echo date('d/m/Y', strtotime($row['dia'])); ?>
                  </li>
                  <li><strong>Hora:</strong>
                    <?php echo htmlspecialchars($row['hora']); ?>
                  </li>
                  <li><strong>Descrição:</strong>
                    <?php echo htmlspecialchars($row['descricao']); ?>
                  </li>
                  <li><strong>Prioridade:</strong>
                    <?php echo htmlspecialchars($row['prioridade']); ?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <?php
        }
      } else {
        // Mensagem caso não haja tarefas com prioridade alta
        echo "<div class='carousel-item active'><div class='container'><div class='carousel-caption'><h1>Nenhuma tarefa com prioridade alta encontrada.</h1></div></div></div>";
      }
      $conn->close();
      ?>


      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>


    <!-- /.carousel -->

    <!-- Qucik Call to Action
    ================================================== -->
    <aside class="cta-block">
      <div class="container">
        <div class="row">
          <div class="col-md-9 text-md-left col-sm-12 text-xs-center text">
            <h4> Nós todos estamos trabalhando juntos, esse é o segredo.</h4>
            <p> Todos juntos para tornar a sua rotina cada vez melhor</p>
          </div>

        </div>
      </div>
    </aside>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <section class="about-home-block" id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-5 text-md-left push-md-7 col-sm-12 text-xs-center">
            <h2 class="featurette-heading"><small>Chatbot interativo</small>Tire suas dúvidas aqui</h2>
            <p class="lead">Chatbot eficiente com o intuito de trazer de forma rapida as respostas para as suas
              principais
              dúvidas, além de sugerir formas de estudos e organização do tempo</p>
            <a href="chat.html" class="btn btn-capsul btn-aqua">clique aqui</a>
          </div>
          <div class="col-md-7 pull-md-5"> <img class="featurette-image img-fluid m-x-auto" src="img/screen-01.jpg">
          </div>
        </div>
      </div>
    </section>
    <section class="service-sec" id="services">
      <div class="container">
        <div class="heading">
          <h2 class="text-xs-center"> Confira as funcionalidades do site <small>Tudo pensado para que seu tempo seja
              otimizado.</small> </h2>
        </div>
        <div class="row">
          <div class="col-lg-4 text-xs-center service-block">
            <a href="sugestoes.php" class="service-icon">
              <i class="fa fa-bug" aria-hidden="true"></i>
            </a>
            <h3>Sugestões inteligentes:</h3>
            <p>Uma ferramenta para ajudar os usuários a gerenciar suas tarefas. Com base nas tarefas registradas,
              oferece recomendações inteligentes que
              podem facilitar a priorização das atividades.
            </p>
          </div>
          <!-- /.col-lg-4 -->


          <div class="col-lg-4 text-xs-center service-block">
            <a href="calendar.php" class="service-icon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </a>
            <h3>Calendário implementado:</h3>
            <p>Quality Time Calendar é uma ferramenta do nosso site que facilita a visualização e gerenciamento de
              tarefas e compromissos. Proporciona organização e uma navegação
              fluida.</p>
          </div>

          <!-- /.col-lg-4 -->

          <div class="col-lg-4 text-xs-center service-block">
            <a href="chat.html" class="service-icon">
              <i class="fa fa-laptop" aria-hidden="true"></i>
            </a>
            <h3>Funcionalidades interativas:</h3>
            <p>Oferecemos um chatbot interativo que possa responder a perguntas sobre gerenciamento de tempo, fornecer
              dicas personalizadas e ajudar com a organização de tarefas.
            </p>
          </div>


          <!-- /.col-lg-4 -->

          <div class="col-lg-4 text-xs-center service-block">
            <a href="#here" class="service-icon">
              <i class="fa fa-diamond" aria-hidden="true"></i>
            </a>
            <h3>Gráfico de Produtividade:</h3>
            <p>O gráfico de progresso mostra quantas tarefas estão Concluídas, Pendentes e Em Andamento em diferentes
              períodos: hoje, esta semana, este mês e este ano. Essa visualização ajuda a gerenciar melhor seu tempo e
              priorizar atividades, facilitando o acompanhamento do seu desempenho.
            </p>
          </div>

          <!-- /.col-lg-4 -->

          <div class="col-lg-4 text-xs-center service-block">
            <a href="adicionar-tarefa.php" class="service-icon">
              <i class="fa fa-cloud-upload" aria-hidden="true"></i>
            </a>
            <h3>Agendamento e Organização de Tarefas:</h3>
            <p>Permita que os alunos criem e editem tarefas e eventos diretamente no assistente.
              Isso pode incluir prazos de trabalhos, exames, atividades extracurriculares e compromissos pessoais.</p>
          </div>

          <!-- /.col-lg-4 -->

          <div class="col-lg-4  text-xs-center service-block"> <i class="fa  fa-comments" aria-hidden="true"></i>
            <h3>Visualização de Tarefas em tempo real:</h3>
            <p>Permite aos usuários monitorar e acompanhar o progresso de suas atividades de maneira dinâmica e instantânea. Assim que uma nova tarefa é adicionada, alterada ou concluída, o sistema atualiza automaticamente a interface, exibindo a lista de tarefas atualizada.</p>
          </div>
          <!-- /.col-lg-4 -->

        </div>
        <!-- /.row -->
      </div>
    </section>






    <!--- Tarefas -->

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

    // Inicializando arrays
    $tarefas_em_andamento = [];
    $tarefas_pendentes = [];
    $tarefas_concluidas = [];

    // Consulta para tarefas pendentes
    $result = $conn->query("SELECT * FROM tarefas WHERE status = 'pendente'");
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $tarefas_pendentes[] = $row;
      }
    } else {
      die("Erro ao buscar tarefas pendentes: " . $conn->error);
    }

    // Consulta para tarefas em andamento
    $result = $conn->query("SELECT * FROM tarefas WHERE status = 'em andamento'");
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $tarefas_em_andamento[] = $row;
      }
    } else {
      die("Erro ao buscar tarefas em andamento: " . $conn->error);
    }

    // Consulta para tarefas concluídas
    $result = $conn->query("SELECT * FROM tarefas WHERE status = 'concluída'");
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $tarefas_concluidas[] = $row;
      }
    } else {
      die("Erro ao buscar tarefas concluídas: " . $conn->error);
    }

    // Fechar a conexão
    $conn->close();
    ?>

    <section class="price-sec" id="price">
      <div class="container">
        <div class="row">
          <h2>Tarefas<br>
            <small>Aqui você pode organizar suas tarefas diárias</small>
          </h2>

          <!-- Tarefas em andamento -->
          <div class="col-md-4">
            <div class="plan-block">
              <div class="heading">
                <span class="plan-type">Em Andamento</span>
              </div>
              <div class="detail-sec">
                <?php if (!empty($tarefas_em_andamento)): ?>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">
                        <?php echo $tarefas_em_andamento[0]['nome']; ?>
                      </h5>
                      <ul class="task-info">
                        <li><strong>Natureza:</strong>
                          <?php echo $tarefas_em_andamento[0]['natureza']; ?>
                        </li>
                        <li><strong>Dia:</strong>
                          <?php echo $tarefas_em_andamento[0]['dia']; ?>
                        </li>
                        <li><strong>Hora:</strong>
                          <?php echo $tarefas_em_andamento[0]['hora']; ?>
                        </li>
                        <li><strong>Prioridade:</strong>
                          <?php echo $tarefas_em_andamento[0]['prioridade']; ?>
                        </li>
                        <li><strong>Status:</strong>
                          <?php echo $tarefas_em_andamento[0]['status']; ?>
                        </li>
                      </ul>


                      <a class="btn btn-aqua"
                        href="marcar_concluida.php?id=<?php echo $tarefas_em_andamento[0]['id']; ?>#price"
                        role="button">Marcar como concluída</a>

                    </div>
                  </div>
                <?php else: ?>
                  <p>Nenhuma tarefa em andamento.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Tarefas pendentes -->
          <div class="col-md-4">
            <div class="plan-block">
              <div class="heading">
                <span class="plan-type">Tarefas Pendentes</span>
              </div>
              <div class="detail-sec">
                <?php if (!empty($tarefas_pendentes)): ?>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">
                        <?php echo $tarefas_pendentes[0]['nome']; ?>
                      </h5>
                      <ul class="task-info">
                        <li><strong>Natureza:</strong>
                          <?php echo $tarefas_pendentes[0]['natureza']; ?>
                        </li>
                        <li><strong>Dia:</strong>
                          <?php echo $tarefas_pendentes[0]['dia']; ?>
                        </li>
                        <li><strong>Hora:</strong>
                          <?php echo $tarefas_pendentes[0]['hora']; ?>
                        </li>
                        <li><strong>Prioridade:</strong>
                          <?php echo $tarefas_pendentes[0]['prioridade']; ?>
                        </li>
                        <li><strong>Status:</strong>
                          <?php echo $tarefas_pendentes[0]['status']; ?>
                        </li>
                      </ul>
                      <a class="btn btn-aqua" href="marcar_concluida.php?id=<?php echo $tarefas_pendentes[0]['id']; ?>
                        #price" role=" button">Marcar como concluída</a>


                      <a class="btn btn-info" style="margin: 5px; padding-left: 33px; padding-right: 33px;"
                        href="marcar_em_andamento.php?id=<?php echo $tarefas_pendentes[0]['id']; ?>#price"
                        role="button">Marcar como em andamento</a>
                      <!-- Botão para marcar como em andamento -->

                    </div>
                  </div>
                <?php else: ?>
                  <p>Nenhuma tarefa pendente.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Tarefas concluídas -->
          <div class="col-md-4">
            <div class="plan-block">
              <div class="heading">
                <span class="plan-type">Concluídas</span>
              </div>
              <div class="detail-sec">
                <?php if (!empty($tarefas_concluidas)): ?>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">
                        <?php echo $tarefas_concluidas[0]['nome']; ?>
                      </h5>
                      <ul class="task-info">
                        <li><strong>Natureza:</strong>
                          <?php echo $tarefas_concluidas[0]['natureza']; ?>
                        </li>
                        <li><strong>Dia:</strong>
                          <?php echo $tarefas_concluidas[0]['dia']; ?>
                        </li>
                        <li><strong>Hora:</strong>
                          <?php echo $tarefas_concluidas[0]['hora']; ?>
                        </li>
                        <li><strong>Prioridade:</strong>
                          <?php echo $tarefas_concluidas[0]['prioridade']; ?>
                        </li>
                        <li><strong>Status:</strong>
                          <?php echo $tarefas_concluidas[0]['status']; ?>
                        </li>
                      </ul>
                      <a class="btn btn-danger" href="excluir_tarefa.php?id=<?php echo $tarefas_concluidas[0]['id']; ?>"
                        role="button">Excluir Tarefa</a>
                    </div>
                  </div>
                <?php else: ?>
                  <p>Nenhuma tarefa concluída.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Botão para adicionar nova tarefa -->
          <div class="col-md-12" style="text-align:center; margin-top: 30px;">
            <a href="adicionar-tarefa.php" class="btn btn-dark-blue btn-capsul">Adicionar Nova Tarefa</a>
          </div>
        </div>
      </div>
    </section>

    <!---Tarefas -->



    <!-- Sugestões -->
    <!-- Sugestões -->
    <section id="sugestoes-section">
      <div class="sugestoes-container">
        <h2>Sugestões Personalizadas</h2>
        <p>Clique abaixo para obter recomendações baseadas em suas tarefas.</p>
        <a href="sugestoes.php" style="text-decoration: none;" class="sugestoes-btn">Ver Sugestões</a>
      </div>
    </section>
    <!-- Sugestões -->
    <!-- Sugestões -->











    <!-- GRAFICO -->
    <section class="price-ter" id="here">
      <div class="container">
        <div class="row">
          <h2>Acompanhe seu progesso!<br>
            <small style="font-size: 30px">Nesta área você pode acompanhar o seu progresso</small>
          </h2>

          <canvas id="progressChart" width="900" height="600" style="max-width: 100%; height: auto;"></canvas>

          <?php
          // Conexão com o banco de dados
          $conn = new mysqli("localhost", "root", "", "sistemas");

          if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
          }

          // Consultas para buscar as tarefas
          $tarefasStatus = [
            'concluida' => [],
            'pendente' => [],
            'em andamento' => []
          ];

          // Buscando dados por status
          foreach ($tarefasStatus as $st => &$data) {
            // Contando tarefas concluídas (com base na data de conclusão)
            $data['dia'] = $conn->query("SELECT COUNT(*) as total FROM tarefas WHERE status = '$st' AND DATE(data_conclusao) = CURDATE()")->fetch_assoc()['total'];

            // Contando tarefas pendentes e em andamento (com base na data no campo dia)
            if ($st !== 'concluida') {
              $data['dia'] = $conn->query("SELECT COUNT(*) as total FROM tarefas WHERE status = '$st' AND DATE(dia) = CURDATE()")->fetch_assoc()['total'];
            }

            // Contando tarefas na semana
            $data['semana'] = $conn->query("SELECT COUNT(*) as total FROM tarefas WHERE status = '$st' AND DATE(dia) BETWEEN DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) AND CURDATE()")->fetch_assoc()['total'];

            // Contando tarefas no mês
            $data['mes'] = $conn->query("SELECT COUNT(*) as total FROM tarefas WHERE status = '$st' AND MONTH(dia) = MONTH(CURDATE()) AND YEAR(dia) = YEAR(CURDATE())")->fetch_assoc()['total'];

            // Contando tarefas no ano
            $data['ano'] = $conn->query("SELECT COUNT(*) as total FROM tarefas WHERE status = '$st' AND YEAR(dia) = YEAR(CURDATE())")->fetch_assoc()['total'];
          }

          // Fechando a conexão
          $conn->close();
          ?>

          <script>
            // Dados do gráfico
            var tarefasStatus = <?php echo json_encode($tarefasStatus); ?>;

            // Configuração do gráfico
            var ctx = document.getElementById('progressChart').getContext('2d');
            var progressChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ['Hoje', 'Esta Semana', 'Este Mês', 'Este Ano'],
                datasets: [
                  {
                    label: 'Tarefas Concluídas',
                    data: [tarefasStatus.concluida.dia, tarefasStatus.concluida.semana, tarefasStatus.concluida.mes, tarefasStatus.concluida.ano],
                    backgroundColor: '#4CAF50',
                    borderColor: '#388E3C',
                    borderWidth: 1
                  },
                  {
                    label: 'Tarefas Pendentes',
                    data: [tarefasStatus.pendente.dia, tarefasStatus.pendente.semana, tarefasStatus.pendente.mes, tarefasStatus.pendente.ano],
                    backgroundColor: '#FFCA28',
                    borderColor: '#FFA000',
                    borderWidth: 1
                  },
                  {
                    label: 'Tarefas em Andamento',
                    data: [tarefasStatus['em andamento'].dia, tarefasStatus['em andamento'].semana, tarefasStatus['em andamento'].mes, tarefasStatus['em andamento'].ano],
                    backgroundColor: '#29B6F6',
                    borderColor: '#0288D1',
                    borderWidth: 1
                  }
                ]
              },
              options: {
                responsive: true,
                scales: {
                  y: {
                    beginAtZero: true,
                    max: 50,
                    ticks: {
                      stepSize: 1, // Mostrando ticks em cada unidade
                      font: {
                        size: 16 // Tamanho da fonte para o eixo Y
                      }
                    },
                    title: {
                      display: true,
                      text: 'Número de Tarefas',
                      font: {
                        size: 20 // Tamanho da fonte para o título do eixo Y
                      }
                    }
                  },
                  x: {
                    ticks: {
                      font: {
                        size: 16 // Tamanho da fonte para os rótulos do eixo X
                      }
                    },
                    title: {
                      display: true,
                      text: 'Período',
                      font: {
                        size: 20 // Tamanho da fonte para o título do eixo X
                      }
                    }
                  }
                },
                plugins: {
                  legend: {
                    labels: {
                      font: {
                        size: 16 // Tamanho da fonte para a legenda
                      }
                    }
                  },
                  title: {
                    display: true,

                    font: {
                      size: 24 // Tamanho da fonte para o título do gráfico
                    }
                  }
                }
              }
            });
          </script>


        </div>
      </div>
    </section>
    <!-- GRAFICO -->







    <section class="qa-section" id="custom-faq-section">
      <div class="containerr">
        <h2 class="text-xs-center">Suas perguntas & Nossas respostas <small>encontre as respostas para as suas
            principais dúvidas</small></h2>

        <div class="faq-item" id="faq-item-1">
          <h5 class="faq-question" onclick="toggleAnswer('faq-answer-1')">Qual o objetivo desse site?</h5>
          <div class="faq-answer" id="faq-answer-1">
            <p>Quality Time é um site criado inteiramente por alunos do Senai, com o objetivo de ajudar as pessoas a
              criar e organizar sua rotina. O site contém várias funcionalidades disponíveis para auxiliar o usuário a
              desenvolver sua rotina de tarefas. Temos como público-alvo alunos do ensino médio com dificuldades em
              conciliar seus compromissos; nosso site auxilia exatamente nessa dificuldade.</p>
          </div>
        </div>

        <div class="faq-item" id="faq-item-2">
          <h5 class="faq-question" onclick="toggleAnswer('faq-answer-2')">O site é pago? Eu preciso assinar algo para
            utilizar as funcionalidades?</h5>
          <div class="faq-answer" id="faq-answer-2">
            <p>Não, o site é 100% gratuito. Por ser de cunho estudantil, o site tem apenas como intuito ajudar os
              estudantes a se organizar e melhorar a rotina, sem fins lucrativos para nós. Todas as funcionalidades são
              gratuitas; a única coisa que você precisa fazer para ter acesso é criar um login e senha.</p>
          </div>
        </div>

        <div class="faq-item" id="faq-item-3">
          <h5 class="faq-question" onclick="toggleAnswer('faq-answer-3')">Como começar a criar a minha rotina?</h5>
          <div class="faq-answer" id="faq-answer-3">
            <p>Para começar a criar sua rotina, você deve se cadastrar no site e começar a adicionar suas tarefas e
              compromissos. O sistema irá ajudá-lo a organizá-los e priorizá-los de acordo com suas necessidades.</p>
          </div>
        </div>

        <div class="faq-item" id="faq-item-4">
          <h5 class="faq-question" onclick="toggleAnswer('faq-answer-4')">O que o site disponibiliza?</h5>
          <div class="faq-answer" id="faq-answer-4">
            <p>O site oferece uma série de funcionalidades, incluindo gerenciamento de tarefas, cronogramas
              personalizados e dicas de produtividade para ajudá-lo a melhorar sua rotina.</p>
          </div>
        </div>

      </div>
    </section>

    <style>
      .containerr {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;


        /* Fundo verde claro */
        border-radius: 10px;
      }

      .faq-item {
        margin-bottom: 15px;

        /* Bordas verdes */
        border-radius: 5px;
        overflow: hidden;
        transition: box-shadow 0.3s;
      }

      .faq-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Sombra ao passar o mouse */
      }

      .faq-question {
        background: black;
        /* Fundo verde para as perguntas */
        color: white;
        /* Texto branco */
        padding: 10px;
        cursor: pointer;
        margin: 0;
        border-radius: 5px;
      }

      .faq-answer {
        max-height: 0;
        /* Altura inicial zero para animação */
        overflow: hidden;
        padding: 0 10px;
        transition: max-height 0.3s ease-in-out;
        /* Transição suave */
      }

      .faq-answer p {
        margin: 10px 0;
      }
    </style>

    <script>
      function toggleAnswer(answerId) {
        const answer = document.getElementById(answerId);
        if (answer.style.maxHeight) {
          answer.style.maxHeight = null; // Fecha a resposta
        } else {
          answer.style.maxHeight = answer.scrollHeight + "px"; // Abre a resposta
        }
      }
    </script>










    <section class="testimonial-sec" id="testimonials">
      <div class="container">
        <h2 class="text-xs-center"> Estudantes <small>Veja como somos lindos</small> </h2>
        <div class="row">
          <div class="col-md-4 text-xs-center">
            <div class="card">
              <img class="card-img-top" src="img/analicy.jpeg" alt="Card image cap">
              <div class="card-block">
                <h3>Analicy<small> 16 anos </small></h3>
                <p class="card-text">Analicy não é programadora, não gosta da materia do curso, mas está aqui por pura e
                  espontânea pressão.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 text-xs-center">
            <div class="card">
              <img class="card-img-top" src="img/amanda.jpeg" alt="Card image cap">
              <div class="card-block">
                <h3>Amanda<small> 16 anos</small></h3>
                <p class="card-text">Amanda sabe mais que a Analicy, e se não sabe pelo menos tenta, e é a única que
                  ainda suporta o Bruno.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 text-xs-center">
            <div class="card">
              <img class="card-img-top" src="img/bruno.jpeg" alt="Card image cap">
              <div class="card-block">
                <h3>Bruno <small> 15 anos </small></h3>
                <p class="card-text">O Bruno existe para fazer a gente rir, se distrair do trabalho e ajudar a Analicy
                  com o teclado que ela não sabe mexer.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-xs-center">
              <div class="card">
                <img class="card-img-top" src="img/shelby.jpeg" alt="Card image cap">
                <div class="card-block">
                  <h3>Shelby<small> 17 anos </small></h3>
                  <p class="card-text">Shelby é a verdadeira inspiração da turma, sempre motivando a todos com suas
                    ideias.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>


    <footer>
      <div class="container">
        <div class="row">
          Feito por <i class="fa fa-love"></i><a href="#">Amanda, Shelby, analicy e Bruno</a>

        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"
      integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY"
      crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"
      integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB"
      crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scrollPosStyler.js"></script>
    <script src="js/core.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src='scripts.js'></script>



    <script>
  // Função para redirecionar
  function redirecionar(pagina) {
    window.location.href = pagina;
  }

  // Adiciona ouvintes de eventos aos links
  document.addEventListener("DOMContentLoaded", function() {
    const calendarLink = document.querySelector('a[href="calendar.php"]');
    const loginLink = document.querySelector('a[href="login.php"]');

    if (calendarLink) {
      calendarLink.addEventListener("click", function(event) {
        event.preventDefault(); // Previne o comportamento padrão do link
        redirecionar("calendar.php");
      });
    }

    if (loginLink) {
      loginLink.addEventListener("click", function(event) {
        event.preventDefault(); // Previne o comportamento padrão do link
        redirecionar("login.php");
      });
    }
  });
</script>

</body>

</html>
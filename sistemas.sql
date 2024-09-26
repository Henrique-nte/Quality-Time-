-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/09/2024 às 01:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `natureza` enum('trabalho', 'projeto', 'estudo', 'pessoal', 'lazer', 'social', 'desenvolvimento', 'saúde', 'culinária', 'financeiro') DEFAULT '',
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `descricao` text NOT NULL,
  `prioridade` varchar(10) NOT NULL,
  `status` enum('pendente','em andamento','concluida') DEFAULT 'pendente',
  `data_conclusao` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tarefas`
INSERT INTO `tarefas` (`id`, `nome`, `natureza`, `dia`, `hora`, `descricao`, `prioridade`, `status`, `id_usuario`) VALUES
(1, 'Preparar apresentação', 'trabalho', '2024-09-30', '14:00:00', 'Preparar slides e ensaiar', 'alta', 'pendente', 1),
(2, 'Estudar para a prova de matemática', 'estudo', '2024-09-28', '18:00:00', 'Revisar capítulos 3 a 5', 'alta', 'em andamento', 1),
(3, 'Reunião com o grupo', 'trabalho', '2024-09-25', '16:00:00', 'Discutir progresso do projeto', 'alta', 'em andamento', 1),
(4, 'Comprar materiais escolares', 'pessoal', '2024-09-29', '15:00:00', 'Listar e comprar o que falta', 'media', 'em andamento', 1),
(5, 'Planejar viagem de fim de semana', 'pessoal', '2024-10-01', '12:00:00', 'Definir destino e atividades', 'baixa', 'em andamento', 1),
(6, 'Finalizar Relatório de Vendas', 'Trabalho', '2024-09-25', '10:00:00', 'Relatório mensal sobre as vendas.', 'alta', 'pendente', 1),
(7, 'Desenvolver Apresentação do Projeto', 'Projeto', '2024-09-26', '14:00:00', 'Criar slides para a apresentação do projeto.', 'media', 'pendente', 1),
(8, 'Estudar para Prova de Matemática', 'estudo', '2024-09-27', '09:00:00', 'Revisar tópicos de álgebra e geometria.', 'alta', 'pendente', 1),
(9, 'Preparar Aula de História', 'Trabalho', '2024-09-28', '11:00:00', 'Preparar conteúdo e atividades para a aula.', 'baixa', 'pendente', 1),
(10, 'Atualizar Planilha de Controle de Projetos', 'Projeto', '2024-09-29', '16:00:00', 'Adicionar novos dados à planilha.', 'media', 'pendente', 1),
(11, 'Ler Livro sobre Marketing Digital', 'estudo', '2024-09-30', '08:00:00', 'Capítulo 3 e 4 do livro.', 'alta', 'pendente', 1),
(12, 'Revisar Documentos do Cliente', 'Trabalho', '2024-10-01', '12:00:00', 'Verificar se todos os documentos estão corretos.', 'baixa', 'pendente', 1),
(13, 'Criar Cronograma de Atividades', 'Projeto', '2024-10-02', '15:00:00', 'Organizar as atividades para o próximo mês.', 'media', 'pendente', 1),
(14, 'Participar da Reunião de Equipe', 'Trabalho', '2024-10-03', '10:30:00', 'Reunião para discutir o andamento dos projetos.', 'alta', 'pendente', 1),
(15, 'Finalizar Projeto de Desenvolvimento', 'Projeto', '2024-10-04', '09:15:00', 'Concluir o projeto antes da data limite.', 'baixa', 'pendente', 1),
(16, 'Analisar Resultados da Pesquisa', 'estudo', '2024-10-05', '14:45:00', 'Revisar dados coletados na pesquisa.', 'media', 'pendente', 1),
(17, 'Preparar Relatório de Atividades', 'Trabalho', '2024-10-06', '11:30:00', 'Relatório sobre as atividades do mês.', 'alta', 'pendente', 1),
(18, 'Enviar Proposta ao Cliente', 'Projeto', '2024-10-07', '13:00:00', 'Finalizar e enviar a proposta.', 'baixa', 'pendente', 1),
(19, 'Rever Planejamento de Marketing', 'Projeto', '2024-10-08', '15:00:00', 'Verificar se o planejamento está atualizado.', 'media', 'pendente', 1),
(21, 'Ir ao mercado', 'pessoal', '2024-10-10', '09:00:00', 'Comprar frutas e vegetais.', 'media', 'pendente', 1),
(22, 'Assistir a um filme', 'lazer', '2024-10-11', '20:00:00', 'Escolher um filme para a noite.', 'baixa', 'pendente', 1),
(23, 'Visitar amigos', 'social', '2024-10-12', '15:00:00', 'Encontrar amigos para um café.', 'alta', 'pendente', 1),
(24, 'Fazer exercício', 'saúde', '2024-10-13', '07:00:00', 'Caminhada no parque.', 'alta', 'pendente', 1),
(25, 'Ler um novo livro', 'estudo', '2024-10-14', '18:00:00', 'Começar a ler um romance.', 'media', 'pendente', 1),
(26, 'Cozinhar um jantar especial', 'pessoal', '2024-10-15', '19:00:00', 'Experimentar uma nova receita.', 'alta', 'pendente', 1),
(27, 'Participar de um workshop', 'desenvolvimento', '2024-10-16', '10:00:00', 'Aperfeiçoar habilidades em marketing.', 'alta', 'pendente', 1),
(28, 'Organizar a casa', 'pessoal', '2024-10-17', '14:00:00', 'Limpar e arrumar os cômodos.', 'media', 'pendente', 1),
(29, 'Fazer um diário', 'pessoal', '2024-10-18', '21:00:00', 'Registrar os acontecimentos do dia.', 'baixa', 'pendente', 1),
(30, 'Cuidar das plantas', 'pessoal', '2024-10-19', '16:00:00', 'Regar e podar as plantas.', 'baixa', 'pendente', 1),
(31, 'Planejar a próxima viagem', 'pessoal', '2024-10-20', '11:00:00', 'Pesquisar destinos e atividades.', 'media', 'pendente', 1),
(32, 'Fazer um jantar com a família', 'social', '2024-10-21', '18:30:00', 'Reunir a família para um jantar.', 'alta', 'pendente', 1),
(33, 'Testar uma nova receita de sobremesa', 'culinária', '2024-10-22', '15:00:00', 'Preparar um bolo de chocolate.', 'media', 'pendente', 1),
(34, 'Fazer uma caminhada ao ar livre', 'saúde', '2024-10-23', '08:00:00', 'Explorar novos trilhos no parque.', 'alta', 'pendente', 1),
(35, 'Estudar para a prova de história', 'estudo', '2024-10-24', '19:00:00', 'Revisar os principais eventos.', 'alta', 'pendente', 1),
(36, 'Participar de um evento cultural', 'social', '2024-10-25', '16:00:00', 'Visitar uma exposição de arte.', 'media', 'pendente', 1),
(37, 'Fazer um planejamento financeiro', 'financeiro', '2024-10-26', '10:00:00', 'Organizar gastos do mês.', 'alta', 'pendente', 1),
(38, 'Praticar meditação', 'saúde', '2024-10-27', '07:00:00', 'Dedicar 15 minutos para meditar.', 'baixa', 'pendente', 1),
(39, 'Escrever um artigo para o blog', 'trabalho', '2024-10-28', '14:00:00', 'Produzir conteúdo sobre produtividade.', 'alta', 'pendente', 1),
(40, 'Planejar uma festa de aniversário', 'social', '2024-10-29', '12:00:00', 'Definir data e convidados.', 'media', 'pendente', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `login`.`usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

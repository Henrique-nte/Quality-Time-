<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/pt-br.js'></script>

    <style>
        body {
            background-color: #f0fdf4;
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
            color: #388e3c;
            margin-bottom: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        #calendar-container {
            max-width: 900px;
            width: 100%;
            height: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 2px solid #ccc;
            /* Traços mais robustos */
            overflow: hidden;
            /* Evita que o calendário saia do container */
        }

        .fc-toolbar {
            background-color: #e8f5e9;
            color: #555;
            border-radius: 5px;
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            /* Traço simples para separar toolbar */
        }

        .fc-button {
            background-color: #66bb6a;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 7px 15px;
            /* Botão mais robusto */
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        .fc-button:hover {
            background-color: #388e3c;
        }

        .fc-day-number {
            color: #388e3c;
            font-weight: bold;
        }

        .fc-event {
            background-color: #66bb6a;
            color: #fff;
            border: 1px solid #388e3c;
            /* Borda ao redor do evento */
            border-radius: 5px;
            padding: 5px;
            transition: background-color 0.2s ease;
        }

        .fc-event:hover {
            background-color: #43a047;
        }

        .fc td,
        .fc th {
            border: 1px solid #ddd;
            /* Adiciona traços simples às células do calendário */
        }

        .fc-view-container {
            border: 2px solid #ddd;
            /* Contorno mais robusto em torno do calendário */
            border-radius: 10px;
        }

        .fc-widget-header {
            background-color: #e8f5e9;
            /* Cor de fundo nas áreas de cabeçalho */
            color: #555;
            font-weight: bold;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: #16c21d;
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
    <h1>Quality Time Calendar</h1>
    <div id='calendar-container'>
        <div id='calendar'></div>
    </div>

    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                locale: 'pt-br',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: 'fetch_events.php',
                eventRender: function (event, element) {
                    if (event.description) {
                        element.append(" <br /><span>" + event.description + "</span>");
                    }
                }
            });
        });
    </script>

</body>

</html>
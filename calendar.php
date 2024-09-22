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
            /* Impedir zoom via CSS */
            zoom: 100%;
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
            width: 900px;
            height: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .fc-toolbar {
            background-color: #e8f5e9;
            color: #555;
            border-radius: 5px;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        .fc-button {
            background-color: #66bb6a;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
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
            border: none;
            border-radius: 5px;
            padding: 5px;
            transition: background-color 0.2s ease;
        }

        .fc-event:hover {
            background-color: #43a047;
        }

        /* Impedir zoom */
        html {
            zoom: 100%;
        }
    </style>
</head>

<body>

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
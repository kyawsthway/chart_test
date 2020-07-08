<?php

    function GenerateChartUrl($data)
    {
        $chart_data = "{type: 'bar', data: {labels: ['Goal Setup', 'Biz Condition ', 'Advertise', 'Financial','Saving'], datasets: [{label: 'Users', data: [10, 20, 30, 40, 40], backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'], borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'], borderWidth: 1, }, ], }, options: {plugins: {datalabels: {anchor: 'end', align: 'top', color: 'black', backgroundColor: 'rgba(255, 99, 132, 0.2)', borderColor: 'rgba(255, 99, 132, 0.2)', borderWidth: 1, borderRadius: 5, formatter: (value) => { if(value == 10) return 'Bad'; else if(value == 20) return 'average'; else if(value == 30) return 'Good'; else if(value == 40) return 'Better'; else if(value == 50) return 'Best';}, }, }, scales: {yAxes: [{ticks: {min: 0, max: 50}}],}},}";
        $enc = urlencode($chart_data);

        return $enc;
    }

    function CallBackManyChat($url)
    {
        $message = [
            'version' => 'v2',
            'content' => [
                'messages' => [
                    [
                        'type' => 'image',
                        'url' => "https://quickchart.io/chart?c=".$url,
                        'buttons' => []
                    ]
                ],
                'actions' => [],
                'quick_replies' => []
            ]
        ];

        $encode_message = json_encode($message);

        return $encode_message;
    }

    $chart_url = GenerateChartUrl('something');

    echo CallBackManyChat($chart_url);

    // https://tom-testing-bot.000webhostapp.com/radar.php

?>

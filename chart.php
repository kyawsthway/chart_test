<?php

    function GenerateChartData($datas)
    {
        $chart_data = array();

        foreach ($datas as $data) {
            $chart_data[] = (int)$data;
        }

        $chart = [
            'type' => 'radar',
            'data' => [
                'labels' => ['Goal Setup', 'Biz Condition ', 'Advertise', 'Financial','Saving'],
                'datasets' => [
                        [
                            'label' => 'Users', 
                            'data' => $chart_data,
                            'backgroundColor' => [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            'borderColor' => [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            'borderWidth' => 1  
                        ]
                    ]
                ],
            'options' => [
                'plugins' => [
                    'datalabels' => [
                        'anchor' => 'end',
                        'align' => 'top',
                        'color' => 'black',
                        'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                        'borderColor' => 'rgba(34, 139, 34, 1.0)',
                        'borderWidth' => 1,
                        'borderRadius' => 5,
                    ]
                ],
                'scales' => [
                    
                ]
            ]
        ];

        $json_chart = json_encode(['chart' => $chart]);

        return $json_chart;
    }

    function GenerateChartUrl($data)
    {
        $chart_data = "{type: 'bar', data: {labels: ['Goal Setup', 'Biz Condition ', 'Advertise', 'Financial','Saving'], datasets: [{label: 'Users', data: [10, 20, 30, 40, 40], backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'], borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'], borderWidth: 1, }, ], }, options: {plugins: {datalabels: {anchor: 'end', align: 'top', color: 'black', backgroundColor: 'rgba(255, 99, 132, 0.2)', borderColor: 'rgba(255, 99, 132, 0.2)', borderWidth: 1, borderRadius: 5, formatter: (value) => { if(value == 10) return 'Bad'; else if(value == 20) return 'average'; else if(value == 30) return 'Good'; else if(value == 40) return 'Better'; else if(value == 50) return 'Best';}, }, }, scales: {yAxes: [{ticks: {min: 0, max: 50}}],}},}";
        $enc = urlencode($chart_data);

        return $enc;
    }

    function GenerateChart($chart_data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,"https://quickchart.io/chart/create");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $chart_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($curl);
        curl_close ($curl);

        return $server_output;
    }

    function CallBackManyChat($url)
    {
        $message = [
            'version' => 'v2',
            'content' => [
                'messages' => [
                    [
                        'type' => 'image',
                        'url' => $url,
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

    // $data = GenerateChartData($_POST);
    // $chart = GenerateChart($data);


    // if ($chart['success'] == true) {
    //     echo $chart['url'];
    // }


    echo "https://quickchart.io/chart?c=".GenerateChartUrl($_POST);

?>


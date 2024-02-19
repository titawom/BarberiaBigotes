<?php 

require ('connectDB.php');

$locations = [];
$timestamps = [];
$airQualityData = [];
foreach ($result as $item) {
    $locationIteration = '';
    foreach ($item as $i) {
        if (isset($i['location'])) {    
            if ($locationIteration != $i['location']['S']) {
                $locationIteration = $i['location']['S'];
                $timestamps[$i['location']['S']][] = $i['timestamp']['N'];
                $temperatura[$i['location']['S']][] = $i['temperature']['N'];
                $airQualityData[$i['location']['S']][] = $i['air_quality']['N'];
                $locations[] = $locationIteration;

            } else {
                $timestamps[$i['location']['S']][] = $i['timestamp']['N'];
                $temperatura[$i['location']['S']][] = $i['temperature']['N'];
                $airQualityData[$i['location']['S']][] = $i['air_quality']['N'];
            }
        }
    }
}

foreach ($locations as $item) {
        ?>
        
        <!DOCTYPE html>
        <html>
        <head>
            <title>Gráfico de Calidad del Aire</title>
            <!-- Incluir Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        </head>
        <body>
        <div style="margin: 0 auto; text-align: center;">
            <?php echo $item;?>
        <div>
            <div style="width: 80%; margin: 0 auto;">
                <canvas id="myChart<?php echo $item;?>"></canvas>
            </div>

            <script>
                // Datos de ejemplo
                var timestamps = <?php echo json_encode($timestamps[$item]); ?>;
                var airQualityData = <?php echo json_encode($airQualityData[$item]); ?>;
                var temperatureData = <?php echo json_encode($temperatura[$item]); ?>;

                // Crear contexto del gráfico
                var ctx = document.getElementById('myChart<?php echo $item; ?>').getContext('2d');

                // Configurar los datos del gráfico
                var chartData = {
                    labels: timestamps,
                    datasets: [{
                        label: 'Calidad del Aire',
                        data: airQualityData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                        borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                        borderWidth: 1,
                        pointRadius: 3,
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)' // Color de los puntos
                    },
                    {
                        label: 'Temperatura',
                        data: temperatureData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color de fondo
                        borderColor: 'rgba(255, 99, 132, 1)', // Color del borde
                        borderWidth: 1,
                        pointRadius: 3,
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)' // Color de los puntos
                    }]
                };

                // Configurar opciones del gráfico
                var chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            type: 'time',
                            time: {
                                unit: 'hour', // Puedes configurar la unidad de tiempo
                                displayFormats: {
                                    hour: 'h:mm a' // Formato de visualización de la hora
                                }
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Tiempo'
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Calidad del Aire'
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Temperatura'
                            }
                        }]
                    }
                };

                // Crear el gráfico
                var myChart<?php echo $item;?> = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: chartOptions
                });
            </script>
        </body>
        </html>

        <?php
}


?>

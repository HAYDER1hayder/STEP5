<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 50%;
            margin: 30px auto;
        }

        #bmiPieChart {
            width: 250px;
            height: 250px;
        }

        #bmiPieChart {
            width: 250px;
            height: 250px;
        }
    </style>
</head>

<body>
    <?php include '../../public/header.php'; ?>
    <h2 class="text-center mt-5">BMI Distribution for All Users</h2>
   
    <div class="chart-container" style="width:30%; margin:auto;padding-top:5px;">
        <canvas id="bmiPieChart" </canvas>
    </div>

    <script>
        const ctx = document.getElementById('bmiPieChart').getContext('2d');
        const bmiPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?= $labels ?>,
                datasets: [{
                    label: 'BMI Categories',
                    data: <?= $data ?>,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)', // Normal weight
                        'rgba(255, 206, 86, 0.6)', // Underweight
                        'rgba(255, 159, 64, 0.6)', // Overweight
                        'rgba(255, 99, 132, 0.6)' // Obesity
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' user(s)';
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>
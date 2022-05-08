
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
<head>
</head>
<body>
<div id="wrapper">
    <div class="container mt-5 mb-5">
        <div class="col-lg-12">
            <h5 style="text-align:center">Uber App Chart Generation</h5>
        </div>
        <div class="form-row">
            <!-- Chart 2 start -->
            <div class="form-group col-md-4">
                <div id="piechart-2" style="width: 430px;  height: 280px;"></div>
            </div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Status', 'Status' ],
                        // sql data fetch start......
                        <?php
                        $sql = "SELECT Status, count(Status) FROM federal group by Status";
                        $fire = mysqli_query($conn, $sql);
                        while ($result = mysqli_fetch_assoc($fire)){
                            echo "['".$result['Status']."',".$result['count(Status)']."],";
                        }
                        ?>
                        // sql data fetch end......
                    ]);
                    var options = {
                        title: 'Trip status:'
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart-2'));
                    chart.draw(data, options);
                }
            </script>
            <!-- Chart 2 ends -->
            <!-- Chart 3 start -->
            <div class="form-group col-md-4">
                <div id="piechart-3" style="width: 430px; height: 280px;"></div>
            </div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['DO_Address', 'DO_Address' ],
                        <?php
                        $sql = "SELECT DO_Address, count(DO_Address)  FROM federal  group by DO_Address having count(DO_Address) > 5";
                        $fire = mysqli_query($conn, $sql);
                        while ($result = mysqli_fetch_assoc($fire)){
                            echo "['".$result['DO_Address']."',".$result['count(DO_Address)']."],";
                        }
                        ?>
                    ]);
                    var options = {
                        title: 'Most popular places'
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart-3'));
                    chart.draw(data, options);
                }
            </script>
        </div>
        <!-- Chart 4 starts -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <div id="linechart" style="width: 600px; height: 400px;"></div>
            </div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Time', 'amount of booking' ],
                        // sql data fetch start......
                        <?php
                        $sql = "SELECT Time_, count(id) FROM federal group by Time_";
                        $fire = mysqli_query($conn, $sql);
                        while ($result = mysqli_fetch_assoc($fire)){
                            echo "['".$result['Time_']."',".$result['count(id)']."],";
                        }
                        ?>
                        // sql data fetch end......
                    ]);
                    var options = {
                        title: 'Traffic Time',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                    };
                    var chart = new google.visualization.AreaChart(document.getElementById('linechart'));
                    chart.draw(data, options);
                }
            </script>
            <!-- Chart 4 ends -->

            <!-- Chart 5 Start -->

            <?php
            $sql= "Select Distinct DO_Address from federal";
            $res= mysqli_query($conn ,$sql);
            ?>
            <script type="text/javascript" src="get.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

            <div class="form-group col-md-4">
                <div id="columnchart_values" style="width: 600px; height: 400px;"></div>

            </div>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Time', 'amount of booking ' ],
                        // sql data fetch start......

                        <?php
                        $sql = "SELECT Time_, count(id) FROM federal where DO_Address='John F Kennedy International Airport;' group by Time_";
                        $fire = mysqli_query($conn, $sql);
                        while ($result = mysqli_fetch_assoc($fire)){
                            echo "['".$result['Time_']."',".$result['count(id)']."],";
                        }
                        ?>
                        // sql data fetch end......
                    ]);
                    var options = {
                        title: ' Times for booking to John F Kennedy International Airport;'
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_values'));
                    chart.draw(data, options);
                }
            </script>

        </div>


        <!-- Chart 5 ends -->
        <!-- <script admin lte cdn for div row. you can use bootstrap start -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"/>
        <!-- <script cdn ends -->
</body>
</html>
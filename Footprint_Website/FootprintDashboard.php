 <?php
  class footprintAPI {
      private $db;

      // Constructor - open DB connection
      function __construct() {
          $this->db = new mysqli('localhost', 'YOURUSERNAME', 'YOURPASSWORD', 'footprint');
          $this->db->autocommit(TRUE);
      }
   
      // Destructor - close DB connection
      function __destruct() {
          $this->db->close();
      }

    public function getAllData(){
      //$appID = '1';

      $stmt = $this->db->prepare("SELECT * FROM fp_tracking");
          $stmt->execute();
          
          $stmt->bind_result($id, $fp_app_id, $name, $type, $view, $time);

         $data = array(); 
          while($stmt->fetch()){

              $row =  array (
                'id' => $id,
                'fp_app_id' => $fp_app_id,
                'name' => $name,
                'type' => $type,
                'view' => $view,
                'time' => $time
              );

              array_push($data,$row); 

          }

          $stmt->close();

          return $data;
    }

    public function getSessions(){
      $startController = "StartViewController";

      $stmt = $this->db->prepare("SELECT * FROM fp_tracking WHERE view=?");
          $stmt->bind_param("s", $startController);
          $stmt->execute();
          
          $stmt->bind_result($id, $fp_app_id, $name, $type, $view, $time);

         $data = array(); 
          while($stmt->fetch()){

              $row =  array (
                'id' => $id,
                'fp_app_id' => $fp_app_id,
                'name' => $name,
                'type' => $type,
                'view' => $view,
                'time' => $time
              );

              array_push($data,$row); 

          }

          $stmt->close();

          return $data;
    }
  }

  $api = new footprintAPI;
  $appData = $api->getAllData();
  $sessions = $api->getSessions(); 
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Footprint Analytics</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />


</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text">
                    Footprint Analytics
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="/FootprintDashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="/FootprintTable.php">
                        <i class="pe-7s-note2"></i>
                        <p>Table List</p>
                    </a>
                </li>
               
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Action Type</h4>
                            </div>
                            <div class="content">
                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Page Views</h4>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    
                </nav>
                <p class="copyright pull-right">
                    &copy; 2016 Renita
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>


    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> -->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script>
        $(function () {
                
                //on page load  
                getAjaxData();
                
                function getAjaxData(){
                
                //use getJSON to get the dynamic data via AJAX call
                $.getJSON('/Footprint_Website/myData.php', function(chartData) {
                    $('#chartHours').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        xAxis: {
                            categories: ['StartViewController', 'ListViewController', 'UniqueViewController']
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Value'
                            }
                        },
                        series: chartData
                    });
                });
            }
        });
    </script>

    <script>
        $(function () {
                
                //on page load  
                getAjaxData();
                
                function getAjaxData(){
                
                //use getJSON to get the dynamic data via AJAX call
                $.getJSON('/Footprint_Website/TypeData.php', function(chartData) {
                    $('#chartPreferences').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },                        
                        series: chartData
                    });
                });
            }
        });
    </script>

	

</html>

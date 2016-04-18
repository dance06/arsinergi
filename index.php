<?php
include 'init.php';
include 'function.php';

if($_SESSION['user'] == '')
{
    header("location: login.php");
}

if(1==1){
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ARSINERGI PROJECT MANAGER</title>

    <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="js/datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
    <script src="js/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="js/datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- <link href="css/datepicker.css" rel="stylesheet"> -->
	<script src="js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/function.js" type="text/javascript"></script>
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span></button> <a class="navbar-brand" href="setpage.php?page=menu">ARSINERGI PROJECT MANAGER</a>
                <a href="logout.php" style="text-decoration:none; cursor:pointer">
                    <img src="images/logout.png" style="max-width:30px; margin-top:10px; position:absolute; right:30px">
                </a>
            </div>

            <div class="navbar-collapse collapse">
            </div><!--/.navbar-collapse -->
        </div>
    </div>
    <div id="content" style="position:relative; margin-top:60px; clear:both; padding:20px;width:100%;">
    	<div style="border:2px solid black;">
    	<?php
			  switch($_SESSION['page']){
				case "menu": include('pages/menu.php'); break;
				case "projectlist": include('pages/project-list.php'); break;
				case "overview": include('pages/project-overview.php'); break;
				case "measurement": include('pages/meas-form.php'); break;
				case "rab": include('pages/rab-form.php'); break;
				case "rb": include('pages/rb-form.php'); break;

                // case "rbupah": include('pages/rbupah-form.php'); break;
				case "material": include('pages/material-form.php'); break;
				case "gudang": include('pages/supplier-form.php'); break;
                // case "supplier": include('pages/supplier-form.php'); break;
                case "mutation": include('pages/mutation-form.php'); break;
				case "item": include('pages/item-form.php'); break;
				// case "analysis": include('pages/analysis-form.php'); break;
				case "unit": include('pages/unit-form.php'); break;
				default: include('pages/menu.php'); break;
			}
    	?>
    	</div>
    </div>
</body>
</html>
<?php
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Añadir Venta</title>

	<!-- Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="../img/favicon-icon.ico">

	<!-- Load css bootstrap -->
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="css/dashboard.css">

    <!-- Load icon font-awesome -->
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

    <!-- Load google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Hanalei+Fill" rel="stylesheet">

    <!-- Load datepicker style -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<!-- Load css style -->
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> 
          <a class="navbar-brand logo" href="inventory.php">Sistema de Inventario</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span><?php echo $_SESSION["name"]; ?></span> - Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->

    <!-- container -->
    <div class="container-fluid">
      <div class="row">
      	
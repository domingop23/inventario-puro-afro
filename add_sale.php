<?php
    // initializing and validating the session to the user
    session_start();
    if($_SESSION["connected"] == false){
        header("Location: index.php");
    }

    // including the connection of the data
    include("conexion.php");

    if(isset($_POST["save"]) && $_POST["save"]){
        $date = $_POST["date"];
        $description = $_POST["description"];
        $quantity = $_POST["quantity"];
        
        $insert = "INSERT INTO sales (date, description, quantity) VALUES ('$date', '$description', '$quantity')"; 
        if(mysqli_query($conexion, $insert)){
            header('Location: sales.php');
        }
        mysql_close($conexion);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Añadir Venta</title>

	<!-- Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

	<!-- Load css bootstrap -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="css/dashboard.css">

    <!-- Load icon font-awesome -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <!-- Load google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Hanalei+Fill" rel="stylesheet">
	
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
            <li class"user"><a href="logout.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span><?php echo $_SESSION["name"]; ?></span> - Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->
    
    <!-- container -->
    <div class="container-fluid">
      <div class="row">
      	<!-- nav-sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="inventory.php">Inventario <span class="sr-only">(current)</span></a></li>
            <li><a href="sales.php">Ventas</a></li>
            <li><a href="purchases.php">Compras</a></li>
          </ul>
        </div>
        <!-- end nav-sidebar -->
        
        <!-- form add sale -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
            <h1 class="text-center page-header">Añadir Venta</h1>
          <form action="" method="post" class="form-producto custom-form">
            <div class="form-group">
              <label for="exampleInput1">Fecha</label>
              <input type="text" class="form-control" id="exampleInput1" name="date">
            </div>
            <div class="form-group">
              <label for="exampleInput2">Descripción</label>
              <input type="text" class="form-control" id="exampleInput2" name="description">
            </div>
            <div class="form-group">
              <label for="exampleInput3">Cantidad</label>
              <input type="text" class="form-control" id="exampleInput3" name="quantity">
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="save" value="1">Guardar</button>
          </form>
        </div>
        <!-- end form add sale -->
      </div>
    </div>
    <!-- end container -->

	<!-- Load script js -->
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
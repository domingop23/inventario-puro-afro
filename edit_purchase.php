<?php
    include("conexion.php");

    // Getting the data from the database
    if(isset($_GET["id"]) && $_GET["id"]){
        $id = $_GET["id"];

        // Setting utf8 data format
        mysqli_set_charset($conexion, "utf8");

        $get_data = "SELECT date, description, quantity FROM purchases WHERE num_invoice= '$id'";
        $result = mysqli_query($conexion, $get_data) or die(mysqli_error($conexion));
        $data = mysqli_fetch_array($result);

        $date = $data["date"];
        $description = $data["description"];
        $quantity = $data["quantity"];
    }

    // Saving the update of the data again
    if(isset($_POST["save"]) && $_POST["save"]){
        $id = $_GET["id"];
        $date = $_POST["date"];
        $description = $_POST["description"];
        $quantity = $_POST["quantity"];

        $update = "UPDATE purchases SET date= '$date', description= '$description', quantity= '$quantity' WHERE num_invoice= '$id'";
        if(mysqli_query($conexion, $update)){
            header("Location: purchases.php");
        }
        mysqli_close($conexion);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar Compra</title>

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
            <li class"user"><a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"> Log Out</i></a></li>
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
            <li class="active"><a href="inventario.php">Inventario <span class="sr-only">(current)</span></a></li>
            <li><a href="sales.php">Ventas</a></li>
            <li><a href="purchases.php">Compras</a></li>
          </ul>
        </div>
        <!-- end nav-sidebar -->
        
        <!-- form edit purchase -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
            <h1 class="text-center page-header">Editar Compra</h1>
          <form action="" method="post" class="custom-form">
            <div class="form-group">
              <label for="exampleInput1">Fecha</label>
              <input type="text" class="form-control" id="exampleInput1" name="date" value="<?php echo $date; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInput2">Descripción</label>
              <input type="text" class="form-control" id="exampleInput2" name="description" value="<?php echo $description; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInput3">Cantidad</label>
              <input type="text" class="form-control" id="exampleInput3" name="quantity" value="<?php echo $quantity; ?>">
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="save" value="1">Guardar</button>
          </form>
        </div>
        <!-- end form edit purchase -->
      </div>
    </div>
    <!-- end container -->

	<!-- Load script js -->
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
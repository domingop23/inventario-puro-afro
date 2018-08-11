<?php
    // initializing and validating the session to the user
    session_start();
    if($_SESSION["connected"] == false){
        header("Location: index.php");
    }

    // including the connection of the data
    include('conexion.php');

    // Getting the data from the database
    if(isset($_GET["id"]) && $_GET["id"]){
        $id = $_GET["id"];

        // Setting utf8 data format
        mysqli_set_charset($conexion, "utf8");

        $get_data = "SELECT description, initial_stocks FROM inventory WHERE product_id= '$id'";
        $result = mysqli_query($conexion, $get_data) or die(mysqli_error($conexion));
        $data = mysqli_fetch_array($result);

        $description = $data["description"];
        $initial_stocks = $data["initial_stocks"];
    }

    // Saving the update of the data again
    if(isset($_POST["save"]) && $_POST["save"]){
        $id = $_GET["id"];
        $description = $_POST["description"];
        $initial_stocks = $_POST["initial_stocks"];

        $update = "UPDATE inventory SET description= '$description', initial_stocks= '$initial_stocks' WHERE id_product= '$id'";
        if(mysqli_query($conexion, $update)){
            header("Location: inventory.php");
        }
        mysqli_close($conexion);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar Producto</title>

	<!-- Meta viewport -->
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
        
        <!-- form edit product -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
            <h1 class="text-center page-header">Editar Producto</h1>
          <form action="" method="post" class="form-producto custom-form">
            <div class="form-group">
              <label for="exampleInput1">Descripción</label>
              <input type="text" class="form-control" id="exampleInput1" name="description" value="<?php echo $description; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInput2">Existencias Iniciales</label>
              <input type="text" class="form-control" id="exampleInput2" name="initial_stocks" value="<?php echo $initial_stocks; ?>">
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="save" value="1">
            Guardar</button>
          </form>
        </div>
        <!-- end form edit product -->
      </div>
    </div>
    <!-- end container -->

	<!-- load jquery -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- load main js -->
    <script src="js/main.js"></script>
</body>
</html>
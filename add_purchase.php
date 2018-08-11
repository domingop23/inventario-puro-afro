<?php
    // Initializing and validating the session to the user
    session_start();
    if($_SESSION["connected"] == false){
        header("Location: index.php");
    }

    // Including the connection of the data
    include("conexion.php");

    if(isset($_POST["save"]) && $_POST["save"]){
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $date = $_POST["date"];

        // Selecting stock & purchases values from inventory table
        $select = "SELECT stock, purchases FROM inventory WHERE product_id= '$product_id' LIMIT 1";
        $result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));
        $data = mysqli_fetch_array($result);

        $stock = $data["stock"];
        $purchases = $data["purchases"];

        // Total stock & purchases
        $stock = $stock + $quantity;
        $purchases = $purchases + $quantity;

        // Updating stock & sales value from inventory table
        $update = "UPDATE inventory SET stock= '$stock', purchases= '$purchases' WHERE product_id= '$product_id'";
        mysqli_query($conexion, $update) or die(mysqli_error($conexion));

        // Inserting data from purchases table
        $insert = "INSERT INTO purchases (product_id, quantity, date) VALUES ('$product_id', '$quantity', '$date')";
        if(mysqli_query($conexion, $insert)){
            header("Location: purchases.php");
        }
        mysqli_close($conexion);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Añadir Compra</title>

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
        
        <!-- form add purchase -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
            <h1 class="text-center page-header">Añadir Compra</h1>
          <form action="" method="post" class="custom-form">
            <div class="form-group">
              <label for="exampleInput1">Producto</label>
              <select class="form-control" name="product_id">
                <option value="">Seleccionar producto</option>
                <?php
                    // Selecting product_id & description values from inventory table
                    $select = "SELECT product_id, description FROM inventory";
                    $result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));
                    while($data = mysqli_fetch_array($result)){
                ?>
                <option value="<?php echo $data["product_id"]; ?>"><?php echo $data["description"]; ?></option>
                <?php
                    }
                    mysqli_close($conexion);
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInput2">Cantidad</label>
              <input type="text" class="form-control" name="quantity">
            </div>
            <div class="form-group">
              <label for="exampleInput3">Fecha</label>
              <input type="text" class="form-control" id="datepicker" name="date">
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="save" value="1">Guardar</button>
          </form>
        </div>
        <!-- end form add purchase -->
      </div>
    </div>
    <!-- end container -->

	<!-- load jquery -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- load datepicker script-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- load main js -->
    <script src="js/main.js"></script>
</body>
</html>
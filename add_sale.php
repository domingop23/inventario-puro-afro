<?php
    // Initializing and validating the session to the user
    session_start();
    if($_SESSION["connected"] == false){
        header("Location: index.php");
    }

    // Including the connection of the database
    include("conexion.php");

    if(isset($_POST["save"]) && $_POST["save"]){
        $product_id = $_POST["product_id"];
        $unit_price = $_POST["unit_price"];
        $quantity = $_POST["quantity"];
        $payment_type = $_POST["payment_type"];
        $date = $_POST["date"];

        // Selecting stock & sales values from inventory table
        $select = "SELECT stock, sales FROM inventory WHERE product_id= '$product_id' LIMIT 1";
        $result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));
        $data = mysqli_fetch_array($result);

        $stock = $data["stock"];
        $sales = $data["sales"];

        // Total stock & sales
        $stock = $stock - $quantity;
        $sales = $sales + $quantity;

        // Updating stock & sales value from inventory table
        $update = "UPDATE inventory SET stock= '$stock', sales= '$sales' WHERE product_id= '$product_id'";
        mysqli_query($conexion, $update) or die(mysqli_error($conexion));

        // Inserting data from sales table
        $insert = "INSERT INTO sales (product_id, unit_price, quantity, payment_type, date) VALUES ('$product_id', '$unit_price', '$quantity', '$payment_type', '$date')"; 
        if(mysqli_query($conexion, $insert)){
            header('Location: sales.php');
        }
        mysql_close($conexion);
    }
?>

    <!-- Including header.php -->
    <?php include("layout/header.php"); ?>
        
        <!-- form add sale -->
        <div class="col-sm-9 col-sm-offset-2 col-md-8 col-md-offset-2">
            <h1 class="text-center page-header">Añadir Venta</h1>
          <form action="" method="post" class="custom-form">
            <div class="form-group">
              <label for="exampleSelect">Producto</label>
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
              <label for="exampleInput3">Precio Unitario</label>
              <input type="text" class="form-control" name="unit_price">
            </div>
            <div class="form-group">
              <label for="exampleInput3">Cantidad</label>
              <input type="text" class="form-control" name="quantity">
            </div>
            <div class="form-group">
              <label for="exampleSelect">Tipo de Pago</label>
              <select class="form-control" name="payment_type">
                <option value="">Seleccionar pago</option>
                <option value="Efectivo">Efectivo</option>
                <option value="Transferencia bancaria">Transferencia bancaria</option>
                <option value="Paypal">Paypal</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInput1">Fecha</label>
              <input type="text" class="form-control" id="datepicker" name="date">
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="save" value="1">Guardar</button>
          </form>
        </div>
        <!-- end form add sale -->
      </div>
    </div>
    <!-- end container -->

	<!-- Including footer.php -->
    <?php include("layout/footer.php"); ?>
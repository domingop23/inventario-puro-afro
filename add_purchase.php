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
    
<!-- Including header.php -->
<?php include("layout/header.php"); ?>
    
    <!-- form add purchase -->
    <div class="col-sm-9 col-sm-offset-2 col-md-8 col-md-offset-2">
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

<!-- Including footer.php -->
<?php include("layout/footer.php"); ?>
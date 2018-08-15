<?php

    // initializing and validating the session to the user
    session_start();
    if($_SESSION["connected"] == false){
        header("Location: index.php");
    }

    // including the connection of the data
    include("conexion.php");

    // Getting the data from the database
    if(isset($_GET["id"]) && $_GET["id"]){
        $id = $_GET["id"];

        // Setting utf8 data format
        mysqli_set_charset($conexion, "utf8");

        $get_data = "SELECT sales.date, sales.quantity, inventory.description 
            FROM sales
            INNER JOIN inventory ON sales.product_id = inventory.product_id
            WHERE sales.invoice_id= '$id'";
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
        $quantity = $_POST["quantity"];

        $update = "UPDATE sales SET date= '$date', quantity= '$quantity' WHERE invoice_id= '$id'";
        if(mysqli_query($conexion, $update)){
            header("Location: sales.php");
        }
        mysqli_close($conexion);
    }
?>

    <!-- Including header.php -->
    <?php include("layout/header.php"); ?>
        
        <!-- form edit sale -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
            <h1 class="text-center page-header">Editar Venta</h1>
          <form action="" method="post" class="form-producto custom-form">
            <div class="form-group">
              <label for="exampleInput1">Fecha</label>
              <input type="text" class="form-control" id="datepicker" name="date" value="<?php echo $date; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInput2">Descripción</label>
              <input type="text" class="form-control" id="exampleInput2" disabled name="description" value="<?php echo $description; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInput3">Cantidad</label>
              <input type="text" class="form-control" id="exampleInput3" name="quantity" value="<?php echo $quantity; ?>">
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="save" value="1">Guardar</button>
          </form>
        </div>
        <!-- end form edit sale -->
      </div>
    </div>
    <!-- end container -->

	<!-- Including footer.php -->
    <?php include("layout/footer.php"); ?>
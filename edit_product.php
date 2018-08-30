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

        $get_data = "SELECT description, unit_price FROM inventory WHERE product_id= '$id'";
        $result = mysqli_query($conexion, $get_data) or die(mysqli_error($conexion));
        $data = mysqli_fetch_array($result);

        $description = $data["description"];
        $unit_price = $data["unit_price"];
    }

    // Saving the update of the data again
    if(isset($_POST["save"]) && $_POST["save"]){
        $id = $_GET["id"];
        $description = $_POST["description"];
        $unit_price = $_POST["unit_price"];

        $update = "UPDATE inventory SET description= '$description', unit_price= '$unit_price' WHERE product_id= '$id'";
        if(mysqli_query($conexion, $update)){
            header("Location: inventory.php");
        }
        mysqli_close($conexion);
    }
?>

    <!-- Including header.php -->
    <?php include("layout/header.php"); ?>
        
        <!-- form edit product -->
        <div class="col-sm-9 col-sm-offset-2 col-md-8 col-md-offset-2">
            <h1 class="text-center page-header">Editar Producto</h1>
          <form action="" method="post" class="form-producto custom-form">
            <div class="form-group">
              <label for="exampleInput1">Descripción</label>
              <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInput1">Precio Unitario</label>
              <input type="text" class="form-control" name="unit_price" value="<?php echo $unit_price; ?>">
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="save" value="1">
            Guardar</button>
            <a class="btn btn-default btn-lg btn-cancel" href="inventory.php" role="button">Cancelar</a>
          </form>
        </div>
        <!-- end form edit product -->
      </div>
    </div>
    <!-- end container -->

	<!-- Including footer.php -->
    <?php include("layout/footer.php"); ?>
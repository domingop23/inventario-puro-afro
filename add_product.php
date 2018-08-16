<?php
    session_start();
    if($_SESSION["connected"] == false){
        header("Location: index.php");
    }

    // Including the connection of the data
    include("conexion.php");

    if(isset($_POST["save"]) && $_POST["save"]){
        $description = $_POST["description"];
        $unit_price = $_POST["unit_price"];
        $initial_stocks = $_POST["initial_stocks"];

        $insert = "INSERT INTO inventory (description, unit_price, initial_stocks, purchases, sales, stock) VALUES ('$description', '$unit_price', '$initial_stocks', 0, 0, '$initial_stocks')";
        if(mysqli_query($conexion, $insert)){
            header("Location: inventory.php");   
        }
        
        mysqli_close($conexion);
    }
?>

<!-- Including header.php -->
<?php include("layout/header.php"); ?>
    
    <!-- form add product -->
    <div class="col-sm-9 col-sm-offset-2 col-md-8 col-md-offset-2">
        <h1 class="text-center page-header">Añadir Producto</h1>
      <form action="" method="post" class="custom-form">
        <div class="form-group">
          <label for="exampleInput1">Descripción</label>
          <input type="text" class="form-control" name="description">
        </div>
        <div class="form-group">
          <label for="exampleInput1">Precio Unitario</label>
          <input type="text" class="form-control" name="unit_price">
        </div>
        <div class="form-group">
          <label for="exampleInput2">Existencias Iniciales</label>
          <input type="text" class="form-control"  name="initial_stocks">
        </div>
        <button type="submit" class="btn btn-success btn-lg" name="save" value="1">
        Guardar</button>
        <a class="btn btn-default btn-lg" href="inventory.php" role="button">Cancelar</a>
      </form>
    </div>
    <!-- end form add product -->
  </div>
</div>
<!-- end container -->

<!-- Including footer.php -->
<?php include("layout/footer.php"); ?>
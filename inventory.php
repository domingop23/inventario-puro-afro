<?php
    // initializing and validating the session to the user
    session_start();
    if($_SESSION["connected"] == false){
        header("Location: index.php");
    }

    // including the connection of the data
    include('conexion.php');
?>

    <!-- Including header -->
    <?php include("layout/header.php"); ?>

    <!-- Including nav-sidebar -->
    <?php include("layout/nav-sidebar.php"); ?>

		<!-- content -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="text-center page-header">Control de Inventario</h1>
          <h4 class="sub-header"><a class="pull-right" href="add_product.php"><i class="fa fa-plus" aria-hidden="true"> Añadir Producto</i></a></h4>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Código Producto</th>
                  <th>Descripción</th>
                  <th>Precio Unitario</th>
                  <th>Existencias Iniciales</th>
                  <th>Compras</th>
                  <th>Ventas</th>
                  <th>Stock</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <?php
                // Setting utf8 data format
                mysqli_set_charset($conexion, "utf8");

                $select = "SELECT * FROM inventory 
                ORDER BY product_id DESC";
                $result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));
                if(mysqli_num_rows($result) > 0 ){
                    while($data = mysqli_fetch_array($result)){   

              ?>
              <tbody>
                <tr>
                  <td><?php echo $data["product_id"]; ?></td>
                  <td><?php echo $data["description"]; ?></td>
                  <td><?php echo $data["unit_price"]; ?></td>
                  <td><?php echo $data["initial_stocks"]; ?></td>
                  <td><?php echo $data["purchases"]; ?></td>
                  <td><?php echo $data["sales"]; ?></td>
                  <td><?php echo $data["stock"]; ?></td>
                  <td>
                  	<a href="edit_product.php?id=<?php echo $data["product_id"]; ?>">Editar</a> -&nbsp;
                  	<a href="delete_product.php?id=<?php echo $data["product_id"]; ?>" class="delete_item">Borrar</a>
                  </td>
                </tr>
                <?php 
                    }
                   }else{

                ?>
                <tr>
                    <td align="center" colspan="8">No hay datos disponibles en la tabla</td>
                </tr>
                <?php 
                  }
                    mysqli_close($conexion);
                ?>
              </tbody>
            </table>
          </div>
          <i class="fa fa-angle-double-right fa-2x arrows" aria-hidden="true"></i>
          <i class="fa fa-angle-double-left fa-2x pull-right arrows" aria-hidden="true"></i>
        </div>
        <!-- end content -->
      </div>
    </div>
    <!-- end container -->

	<!-- Including footer.php -->
    <?php include("layout/footer.php"); ?>
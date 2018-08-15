<?php 
    // initializing and validating the session to the user
    session_start();
    if($_SESSION["connected"] == false){
        header("Location: index.php");
    }

    // including the connection of the data
    include("conexion.php");
?>

    <!-- Including header.php -->
    <?php include("layout/header.php"); ?>

    <!-- Including nav-sidebar -->
    <?php include("layout/nav-sidebar.php"); ?>

        <!-- content -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class=" text-center page-header">Control de Compras</h1>
          <h4 class="sub-header"><a class="pull-right" href="add_sale.php"><i class="fa fa-plus" aria-hidden="true"> Añadir Venta</i></a></h4>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th># de Factura</th>
                  <th>Descripción</th>
                  <th>Precio Unitario</th>
                  <th>Cantidad</th>
                  <th>Tipo de Pago</th>
                  <th>Fecha</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <?php 
                // Setting utf8 data format
                mysqli_set_charset($conexion, "utf8");

                $select = "SELECT sales.invoice_id, sales.unit_price, sales.quantity, sales.payment_type, sales.date, inventory.description 
                    FROM sales
                    INNER JOIN inventory ON sales.product_id = inventory.product_id
                    ORDER BY sales.invoice_id DESC";
                $result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));
                if(mysqli_num_rows($result) > 0){
                    while($data = mysqli_fetch_array($result)){

              ?>
              <tbody>
                <tr>
                  <td><?php echo $data["invoice_id"]; ?></td>
                  <td><?php echo $data["description"]; ?></td>
                  <td><?php echo $data["unit_price"]; ?></td>
                  <td><?php echo $data["quantity"]; ?></td>
                  <td><?php echo $data["payment_type"]; ?></td>
                  <td><?php echo $data["date"]; ?></td>
                  <td>
                  	<!-- <a href="edit_sale.php?id=<?php echo $data["invoice_id"]; ?>">Editar</a> -&nbsp; -->
                  	<a href="delete_sale.php?id=<?php echo $data["invoice_id"]; ?>" id="delete_sale">Borrar</a>
                  </td>
                </tr>
                <?php 
                    }
                  }else{
                ?>
                <tr>
                    <td align="center" colspan="5">No hay datos disponibles en la tabla</td>
                </tr>
                <?php 
                  }
                    mysqli_close($conexion);
                ?>
              </tbody>
            </table>
          </div>
        </div>
       <!--  end content -->
      </div>
    </div>
    <!-- end container -->

	<!-- Including footer.php -->
    <?php include("layout/footer.php"); ?>
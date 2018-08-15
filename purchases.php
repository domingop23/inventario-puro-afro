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
          <h4 class="sub-header"><a class="pull-right" href="add_purchase.php"><i class="fa fa-plus" aria-hidden="true"> Añadir Compra</i></a></h4>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th># de Factura</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Fecha</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <?php
                // Setting utf8 data format
                mysqli_set_charset($conexion, "utf8");

                $select = "SELECT purchases.invoice_id, purchases.date, inventory.description, purchases.quantity 
                    FROM purchases
                    INNER JOIN inventory ON purchases.product_id = inventory.product_id
                    ORDER BY purchases.invoice_id DESC";
                $result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));
                if(mysqli_num_rows($result) > 0){
                    while($data = mysqli_fetch_array($result)){
              ?>
              <tbody>
                <tr>
                  <td><?php echo $data["invoice_id"]; ?></td>
                  <td><?php echo $data["description"]; ?></td>
                  <td><?php echo $data["quantity"]; ?></td>
                  <td><?php echo $data["date"]; ?></td>
                  <td>
                    <!-- <a href="edit_purchase.php?id=<?php echo $data["invoice_id"]; ?>">Editar</a> -&nbsp; -->
                    <a href="delete_purchase.php?id=<?php echo $data["invoice_id"]; ?>" id="delete_purchase">Borrar</a>
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
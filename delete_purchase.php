<?php
	// Including the connection of the data
	include('conexion.php');

	if(isset($_GET["id"]) && $_GET["id"]){
		$id = $_GET["id"];

		// Getting the value from purchases & inventory tables
		$select = "SELECT purchases.quantity, inventory.stock, inventory.purchases, inventory.product_id
			FROM purchases
			INNER JOIN inventory ON purchases.product_id = inventory.product_id
			WHERE purchases.invoice_id = '$id'";
		$result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));
		$data = mysqli_fetch_array($result);

		$product_id = $data["product_id"];
		$quantity = $data["quantity"];
		$stock = $data["stock"];
		$purchases = $data["purchases"];

		// Total stock & purchases values
		$stock = $stock - $quantity;
		$purchases = $purchases - $quantity;

		// Updating the current value from inventory table 
		$update = "UPDATE inventory SET stock= '$stock', purchases= '$purchases' WHERE product_id= '$product_id'";
		mysqli_query($conexion, $update) or die(mysqli_error($conexion));

		// Erasing  the value selecting from invoice_id
		$delete = "DELETE FROM purchases WHERE invoice_id= '$id'";
		if(mysqli_query($conexion, $delete)){
			header("Location: purchases.php");
		}
		mysqli_close($conexion);
	}
?>
<?php
	// Including the connection of the data
	include('conexion.php');

	if(isset($_GET["id"]) && $_GET["id"]){
		$id = $_GET["id"];

		// Getting the value from sales & inventory tables
		$select = "SELECT sales.quantity, inventory.stock, inventory.sales, inventory.product_id
			FROM sales
			INNER JOIN inventory ON sales.product_id = inventory.product_id
			WHERE sales.invoice_id = '$id'";
		$result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));
		$data = mysqli_fetch_array($result);

		$product_id = $data["product_id"];
		$quantity = $data["quantity"];
		$stock = $data["stock"];
		$sales = $data["sales"];

		// Total stock & sales values
		$stock = $stock + $quantity;
		$sales = $sales - $quantity;

		// Updating the current value from inventory table 
		$update = "UPDATE inventory SET stock= '$stock', sales= '$sales' WHERE product_id= '$product_id'";
		mysqli_query($conexion, $update) or die(mysqli_error($conexion));

		// Erasing  the value selecting from invoice_id
		$delete = "DELETE FROM sales WHERE invoice_id= '$id'";
		if(mysqli_query($conexion, $delete)){
			header("Location: sales.php");
		}
		mysqli_close($conexion);
	}
?>
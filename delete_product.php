<?php
	include('conexion.php');

	if(isset($_GET["id"]) && $_GET["id"]){
		$id = $_GET["id"];

		$delete = "DELETE FROM inventory WHERE product_id= '$id'";
		if(mysqli_query($conexion, $delete)){
			header("Location: inventory.php");
		}
		mysqli_close($conexion);
	}
?>
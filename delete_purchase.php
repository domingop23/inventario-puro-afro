<?php
	include('conexion.php');

	if(isset($_GET["id"]) && $_GET["id"]){
		$id = $_GET["id"];

		$delete = "DELETE FROM purchases WHERE num_invoice= '$id'";
		if(mysqli_query($conexion, $delete)){
			header("Location: purchases.php");
		}
		mysqli_close($conexion);
	}
?>
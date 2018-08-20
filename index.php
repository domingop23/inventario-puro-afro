<?php
    // check if the user is already logged in
    session_start();
    if(isset($_SESSION["connected"]) && $_SESSION["connected"] == true){
        header("Location: inventory.php");
    }

    // Including the connection of the data
    include('conexion.php');

    $error = "";

    // Getting a md5 password value
    // echo md5('admin');

    if(isset($_POST["sign_in"]) && $_POST["sign_in"]){
        $user = $_POST["user"];
        $password = md5($_POST["password"]);

        // Setting utf8 data format
        mysqli_set_charset($conexion, "utf8");

        $select = "SELECT * FROM users WHERE user= '$user' AND password= '$password' LIMIT 1";
        $result = mysqli_query($conexion, $select) or die(mysqli_error($conexion));

        if(mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_array($result);

            $_SESSION["name"] = $data["name"];
            $_SESSION["connected"] = true;

            header("Location: inventory.php");
        }else{
            $error = "El Usuario o Contraseña no es correcto";
        }
        mysqli_close($conexion);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<!-- Meta viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon-icon.ico">

	<!-- Load css bootstrap -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
	
	<!-- Load css style -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="body-login">
    <!-- container -->
	<div class="container">
        <h2 class="form-signin-heading">Sistema de Inventario</h2>
        <span class="error"><?php echo $error; ?></span>
        <form class="form-signin" method="post">
            <input type="text" id="inputUser" class="form-control" name="user" placeholder="Usuario *" required autofocus>
            <input type="password" id="inputPassword" class="form-control password" name="password" placeholder="Contraseña *" required>
            <!-- <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Recuerdame
                </label>
            </div> -->
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="sign_in" value="2">Iniciar Sesión
            </button>
        </form>
    </div> <!-- end container -->
</body>
</html>
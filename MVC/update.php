<?php
	include_once 'conexion.php';

	if(isset($_GET['id']))
	{
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM clientes WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}
	else
	{
		header('Location: index.php');
	}
	if(isset($_POST['guardar']))
	{
		$nombre=$_POST['nombre'];
		$apellidos=$_POST['apellidos'];
		$empresa=$_POST['empresa'];
		$telefono=$_POST['telefono'];
		$ciudad=$_POST['ciudad'];
		$correo=$_POST['correo'];
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($empresa) && !empty($ciudad) && !empty($correo) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}
			else
			{
				$consulta_update=$con->prepare(' UPDATE clientes SET  
					nombre=:nombre,
					apellidos=:apellidos,
					empresa=:empresa,
					telefono=:telefono,
					ciudad=:ciudad,
					correo=:correo
					WHERE id=:id;'
			);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':apellidos' =>$apellidos,
					':empresa' =>$empresa,
					':telefono' =>$telefono,
					':ciudad' =>$ciudad,
					':correo' =>$correo,
					':id' =>$id
				));
				header('Location: ../index_editar.php');
			}
		}
		else
		{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
     
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
		<!-- Custom styles for this template-->
	   <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	   <!--Import Google Icon Font-->
	   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


	   <!-- Compiled and minified CSS -->
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	   <style>
	 body {   background-size: 100% 100%; position: fixed;    height: 120% ; width: 100%; overflow: hidden;   
		  margin: 0;
		  padding: 0;
		  font-family: Arial, Helvetica, sans-serif;}
		.navbar {   height: 92px; width: 100%;   background-color: #00a1fa; background-image: linear-gradient(#00a1fa,black);}
		.navbar b {
		 display: block;
	 
		 text-align: left;
		 font-size: 30px;
		 font-family: 'Arial', sans-serif;
		 font-weight: bold;
		 color:  rgb(255, 255, 255);
		 }
		  .dropdown {
		   float: left;
		   overflow: hidden;
		 }
		  .dropdown .dropbtn {
		  font-size: 16px;  
		  border: none;
		  outline: none;
		  color: white;
		  padding: 14px 16px;
		  background-color: inherit;
		  font-family: inherit;
		  margin: 0;
		  }
		  .navbar a:hover, .dropdown:hover .dropbtn {
		  background-color: white;
		  }
		  .dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: #f9f9f9;
		  min-width: 160px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		  }
		  .dropdown-content a {
		  display: block;
		  margin-top: 10px;
		  margin-bottom: 10px;
		  text-align: left;
		  font-size: 20px;
		  font-family: 'Arial', sans-serif;
		  font-weight: bold;
		  color:  rgb(255, 255, 255);
		  }
		  .dropdown-content a:hover {
		  background-color: #ddd;
		  }
		  .dropdown:hover .dropdown-content {
		  display: block;
		  }
		  h3{
		  font-size: 27px;
		  text-align: center;
		  font-family: 'Arial', sans-serif;
		  font-weight: bold;
		  color:   #148f77 ;
		  }
		  h4{
		  position: absolute;
		  bottom: -1px;
		  left: 58px;
		  margin-top: 10px;
		  margin-bottom: 10px;
		  text-align: left;
		  font-size: 20px;
		  font-weight: 500;
		  font-family: 'Arial', sans-serif;
		  font-style: italic;
		  color:   #117a65 ;
		  }
		  h5{
		  font-size: 15px;
		  font-family: 'Arial', sans-serif;
		  font-weight: bold;
		  color:   #45b39d ;
		  }

		  .container {
		  position: relative;
		  width: 50%;
		  }
		  .sidenav-trigger{
		  position: absolute;
		  bottom: 40px;
		  left: 10px;
		  }
		  .image {
		  display: block;
		  width: 100%;
		  height: auto;
		  }
		  .overlay {
		  position: absolute;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  right: 0;
		  height: 100%;
		  width: 100%;
		  opacity: 0;
		  transition: .5s ease;
		  background-color: #008CBA;
		  }
		  .container:hover .overlay {
		  opacity: 1;
		  }
		  .text {
		  color: black;
		  font-size: 10px;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  -webkit-transform: translate(-50%, -50%);
		  -ms-transform: translate(-50%, -50%);
		  transform: translate(-50%, -50%);
		  text-align: center;
		  }
		  input[type=text] {
		  border: 2px solid red;
		  border-radius: 4px;
		 }

		 input[type=text], select {
	      width: 100%;
	 	  padding: 12px 20px;
		  margin: 8px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		  }
  		  input[type=submit] {
		  background-color: #4CAF50;
		  color: white;
		  border: none;
	  	  cursor: pointer;
		  }
		  input[type=submit]:hover {
			color:   #1a5276  ;
		  background-color:    #58d68d   ;
	      }

		 .image-margin {
		 position: absolute;
		 bottom: -6px;
		 left: 11px;
		 border: 2px;
		 margin-top: 10px;
		 margin-bottom: 10px;
			}
		 .image-margin2 {
		 position: absolute;
		 bottom: -4px;
		 left: 310px;
		 border: 4px;
		 margin-top: 10px;
		 margin-bottom: 10px;
		 }
		
		 table{
				width: 100%;
		 }

		 table .head{
		   
		   font-weight: bold;
			background: rgb(45, 111, 255);
		 }
		 table .head td{
			 background-color: #008CBA;
			 color: #fff;
			 font-family: 'Arial',sans-serif;
			 font-weight: bold;
			 font-size: 32px;
			 text-align: left;
		 }
		 table tr td{   
			 text-align: left;
			 border:1px solid #ccc;
			 padding: 2px;
			 font-size: 12px;
			 color: #555;
		 }
		 table tr th{   
			 text-align: left;
			 border:1px solid #ccc;
			 padding: 3px;
			 font-size: 12px;
			 color: #555;
		 }
			

		 .btn__update{
			 display: inline-block;
			 font-size: 15px;
			 background: #1FAB3C;
			 color: #fff;
			 border-radius: 5px;
			 padding: 5px 10px;

		 }

		 .btn__delete{
			 display: inline-block;
			 font-size: 15px;
			 background:#BD2439;
			 color: #fff;
			 border-radius: 5px;
			 padding: 5px 10px;
		 }
		 .content {
		   position: relative;
		 }
		 #btx1 {
			 position: absolute;
			 font-family: 'Arial', sans-serif;
			 bottom: 5px;
			 left: 209px;
			 font-weight: bold;
			 background-color: #3997D3; 
			 display: inline-block;
			 font-size: 15px;
			 border-radius: 5px;
			 color: #fff;
			 border-radius: 3px;
		 }
		  #btx2 {
		   position: fixed;
		   top: 27%;
		   left: 57%;
		   margin-top: 10%;
		   margin-left: -140px;
		   width:209px;
		   height: 48px;
		   font-size: 26px;
		  }
		  #btx3 {
		   position: fixed;
		   top: 40%;
		   left: 57%;
		   margin-top: 10%;
		   margin-left: -140px;
		   width:209px;
		   height: 48px;
		   font-size: 26px;
		  }
	      input[type=text], select {
	      width: 100%;
	 	  padding: 12px 20px;
		  margin: 8px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		  }
  	

  		  div {
	 	  border-radius: 5px;
		  background-color: #f2f2f2;
		  padding: 20px;
		  }

	   </style>


</head>
<body>

<div class="contenedor">
	<h3>Editar Cliente</h3>

	<form action="" method="post">
	<br>

	<h5>Nombres</h5>

    <input type="text"  name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" >
	<br>
	<br>
	<h5>Apellidos</h5>

    <input type="text"  name="apellidos" value="<?php if($resultado) echo $resultado['apellidos'];?>">
	<br>
	<br>
	<h5>Empresa</h5>
    <input type="text" name="empresa" value="<?php if($resultado) echo $resultado['empresa'];?>">
	<br>
	<br>
	<h5>Telefono</h5>
    <input type="text"  name="telefono" value="<?php if($resultado) echo $resultado['telefono'];?>">
	<br>
	<br>
	<h5>Ciudad</h5>
    <input type="text" name="ciudad" value="<?php if($resultado) echo $resultado['ciudad'];?>">
	<br>
	<br>
	<h5>Correo</h5>
    <input type="text"  name="correo" value="<?php if($resultado) echo $resultado['correo'];?>">
	<br>

	
	     <div class="row">
				<div class="col">
				<a href="../index.php" class="btn btn__danger">Cancelar</a>
				</div>
				<div class="col">
				<input type="submit" name="guardar" value="Guardar" class="btn btn__danger"></div>
		 </div>

     


  </form>
</div>


</body>
</html>

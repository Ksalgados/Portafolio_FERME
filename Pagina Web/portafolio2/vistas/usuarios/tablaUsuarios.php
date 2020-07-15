<?php

	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	
	$sql="SELECT a.id_user,
					b.id_user,
					b.email,
					a.nombre,
					a.apellido,
					a.direccion,
					a.telefono,
					a.idcliente
				from usuarios b LEFT join cliente a 
				on b.id_user=a.id_user";
	$result=mysqli_query($conexion,$sql);	
	session_start();
	
?>

<?php while($ver=mysqli_fetch_row($result)): ?>

		<?php if($_SESSION['usuario']==$ver[2] && $ver[0]==$ver[1]){ ?>
				
				<form class="mx-sm-5" >
					<div class="form-row">
						<div class="form-group col-md-4 ">
							<label for="rut" name="rut">Email: </label>
							<input type="text" class="form-control" id="inputEmail4" name="nombre" value="<?php echo $ver[2]; ?>" disabled>
						</div>
						<div class="form-group col-md-4 ">
							<label for="rut" name="rut" style="visibility:hidden">Id_user: </label>
							<input type="hidden" class="form-control" name="id_user" id="id_user" value="<?php echo $ver[1]; ?>" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4 ">
							<label for="rut" name="rut">Nombre: </label>
							<input type="text" class="form-control" id="inputEmail4" name="nombre" value="<?php echo $ver[3]; ?>" disabled>
						</div>
						<div class="form-group col-md-4">
							<label for="Apellido">Apellido: </label>
							<input type="text" class="form-control" id="inputPassword4" name="apellido" value="<?php echo $ver[4]; ?>" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="inputAddress">Direccion: </label>
							<input type="text" class="form-control" id="inputAddress" name="user" value="<?php echo $ver[5]; ?>" disabled > 
						</div>
						<div class="form-group col-md-4">
							<label for="Apellido">telefono: </label>
							<input type="text" class="form-control" id="inputPassword4" name="apellido" value="<?php echo $ver[6]; ?>" disabled>
						</div>
					</div>
					<input type="button" 
						class="btn  btn-outline-success" 
						data-toggle="modal" 
						data-target="#actualizaClienteModal" 
						class="btn btn-warning btn-xs"
						onclick="agregaDatosCliente('<?php echo $ver[0]; ?>'); agregaDatosUsuario('<?php echo $ver[0]; ?>')"
						value="Actualizar" >
						<input type="button" 
						class="btn  btn-outline-danger" 
						onclick="eliminaUsuario('<?php echo $ver[1]; ?>')"
						value="Eliminar" >
				</form>
				<br>
				
				

        <?php }elseif($_SESSION['usuario']==$ver[2] && $ver[0]!==$ver[1]){ ?>
		
				<form class="mx-sm-5" >
					<div class="form-row">
						<div class="form-group col-md-4 ">
							<label for="rut" name="rut">Email: </label>
							<input type="text" class="form-control" id="inputEmail4" name="nombre" value="<?php echo $ver[2]; ?>" disabled>
						</div>
						<div class="form-group col-md-4 ">
							<label for="rut" name="rut" style="visibility:hidden">Id_user: </label>
							<input type="hidden" class="form-control" name="id_user" id="id_user" value="<?php echo $ver[1]; ?>" disabled>
						</div>
					</div>
					<input type="button" 
						class="btn  btn-outline-success"
						data-toggle="modal"
						data-target="#actualizaClienteModal2"
						class="btn btn-warning btn-xs"
						onclick="agregaDatosCliente('<?php echo $ver[0]; ?>'); agregaDatosUsuario('<?php echo $ver[0]; ?>')"
						value="Actualizar" >
						<input type="button"
						class="btn  btn-outline-danger" 
						onclick="eliminaUsuario('<?php echo $ver[1]; ?>')"
						value="Eliminar" >
				</form>
				
		<?php } ?>
		

<?php endwhile; ?>
<?php

	require_once "../../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	
	$sql="SELECT b.id_usurio,
					a.id_user,
					a.email,
					b.rut_prov,
					b.dv,
					b.nombre,
					b.direccion,
					b.telefono,
					b.rubro
				from usuarios a join proveedor b 
				on b.id_usurio=a.id_user";
	$result=mysqli_query($conexion,$sql);	
	session_start();
	
?>

<?php while($ver=mysqli_fetch_row($result)): ?>

		<?php if($_SESSION['usuario']==$ver[2] && $ver[0]==$ver[1]){ ?>
				
				
				<form class="mx-sm-5" >
					<div class="form-row ">
						<div class="form-group col-md-4">
							<label for="rut" name="rut">Usuario: 
							<input type="text" class="form-control" id="inputEmail4" name="nombre" value="<?php echo $ver[2]; ?>" disabled></label>
						</div>
						<div class="form-group col-md-4 ">
							<br>
							<input type="button" 
							class="btn  btn-outline-success" 
							data-toggle="modal" 
							data-target="#actualizaProveedorModal"
							class="btn btn-warning btn-xs"
							onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>'); alert('Al cambiar su nombre de usuario se cerrara su sesion.\nLuego vuelva a iniciar sesion con su nuevo Usuario.')"
							value="Cambiar Usuario">
						</div>
						<div class="form-group col-md-4 ">
							<label for="rut" name="rut" style="visibility:hidden">Id_user: </label>
							<input type="hidden" class="form-control" name="id_user" id="id_user" value="<?php echo $ver[1]; ?>" disabled>
						</div>
					</div>
					<br><br>
					<div class="form-row">
						<div class="form-group col-md-4 ">
							<label for="rut" name="rut">Nombre: 
							<input type="text" class="form-control" id="inputEmail4" name="nombre" value="<?php echo $ver[5]; ?>" disabled></label>
						</div>
						<div class="form-group col-md-4 ">
							<label for="rut" name="rut">Rut:
							<input type="text" class="form-control" id="inputEmail4" name="rut_empresa" value="<?php echo $ver[3]; ?>-<?php echo $ver[4]; ?>" disabled></label>
						</div>
						<div class="form-group col-md-4">
							<label for="Apellido">Rubro: 
							<input type="text" class="form-control" id="inputrubro4" name="rubro" value="<?php echo $ver[8]; ?>" disabled></label>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="inputAddress">Direccion: 
							<input type="text" class="form-control" id="inputAddress" name="user" value="<?php echo $ver[6]; ?>" disabled > </label>
						</div>
						<div class="form-group col-md-4">
							<label for="Apellido">telefono: 
							<input type="text" class="form-control" id="inputPassword4" name="telefono" value="<?php echo $ver[7]; ?>" disabled></label>
						</div>
					</div>
				</form>
				<br>
		<?php } ?>
<?php endwhile; ?>
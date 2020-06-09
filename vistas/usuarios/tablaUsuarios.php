<?php 
	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT id_user,
					nombre,
					apellido,
					email
			from usuarios";
	$result=mysqli_query($conexion,$sql);
    session_start();
 ?>

<?php while($ver=mysqli_fetch_row($result)): ?>
            <?php if($_SESSION['usuario']==$ver[3]){?>
<form class="mx-sm-5" >
        <div class="form-row">
            <div class="form-group col-md-4 ">
                <label for="rut" name="rut">Nombre: </label>
                <input type="text" class="form-control" id="inputEmail4" name="nombre" value="<?php echo $ver[1]; ?>" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="Apellido">Apellido: </label>
                <input type="text" class="form-control" id="inputPassword4" name="apellido" value="<?php echo $ver[2]; ?>" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputAddress">Usuario: </label>
                <input type="text" class="form-control" id="inputAddress" name="user" value="<?php echo $ver[3]; ?>" disabled > 
            </div>
        </div>
        <input type="button" 
            class="btn  btn-outline-success" 
            data-toggle="modal" 
            data-target="#actualizaUsuarioModal" 
            class="btn btn-warning btn-xs"
            onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')" 
            value="Actualizar" >
            <input type="button" 
            class="btn  btn-outline-danger" 
            onclick="eliminarUsuario('<?php echo $ver[0]; ?>')" 
            value="Eliminar" >
</form>
<?php }?>
<?php endwhile; ?>
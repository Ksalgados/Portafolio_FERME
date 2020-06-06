<?php
    include'../template/carrito.php';
    include'../clases/Conexion.php';
?>
<?php 
	require_once "../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();

	$sql="SELECT rut_cli,
				dv,
				nombre,
				apellido,
				usuario,
				pass,
				direccion,
				telefono
		from cliente";
	$result=mysqli_query($conexion,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ferreteria FERME</title>
    <?php
  include 'links_vist.php';
?>
</head>

<body>
    <?php
  include 'navbar_vist.php';
?>
<h2>MI CUENTA</h2>
<?php while($ver=mysqli_fetch_row($result)): ?>
  <?php if($ver[4]==$_SESSION['usuario']){?>
<form class="mx-sm-5" method="post" id="frmClientesU">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="rut">Rut: </label>
                <input type="text" class="form-control" value="<?php echo $ver[0]; ?>" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="inputPassword4">DV: </label>
                <input type="text" class="form-control"  value="<?php echo $ver[1]; ?>" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2 ">
                <label for="rut" name="rut">Nombre: </label>
                <input type="text" class="form-control"  value="<?php echo $ver[2]; ?>" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="Apellido">Apellido: </label>
                <input type="text" class="form-control"  value="<?php echo $ver[3]; ?>" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress">Dirección: </label>
                <input type="text" class="form-control"  value="<?php echo $ver[6]; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="inputAddress">Teléfono: </label>
                <input type="text" class="form-control" value="<?php echo $ver[7]; ?>" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 ">
                <label for="inputCity">Región</label>
                <input type="text" class="form-control" id="inputCity" disabled>
            </div>
            <div class="form-group col-md-4 ">
                <label for="inputCity">Ciudad</label>
                <input type="text" class="form-control" id="inputCity" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Comuna</label>
                <input type="text" class="form-control" id="inputZip" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputAddress">Usuario: </label>
                <input type="text" class="form-control" value="<?php echo $ver[4]; ?>" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="inputAddress">Contraseña: </label>
                <input type="password" class="form-control" value="<?php echo $ver[5]; ?>" disabled>
            </div>
        </div>
        <input class="btn btn-primary" type="button" onclick="agregaDatosCliente('<?php echo $ver[0]; ?>')" data-toggle="modal" data-target="#abremodalClientesUpdate" value="Actualizar">
        <?php }?>
        <?php endwhile; ?>
    </form>



    <div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
                </div>
                <div class="modal-body">
                    <form id="frmClientes">
                        <label>Rut</label>
                        <input type="text" class="form-control input-sm" id="rut" name="rut">
                        <label>Dv</label>
                        <input type="text" class="form-control input-sm" id="dv" name="dv">
                        <label>Nombre</label>
                        <input type="text" class="form-control input-sm" id="nombre" name="nombre">
                        <label>Apellido</label>
                        <input type="text" class="form-control input-sm" id="apellidos" name="apellidos">
                        <label>Direccion</label>
                        <input type="text" class="form-control input-sm" id="direccion" name="direccion">
                        <label>Ususario</label>
                        <input type="text" class="form-control input-sm" id="email" name="email">
                        <label>Telefono</label>
                        <input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnAgregarClienteU" type="button" class="btn btn-primary"
                        data-dismiss="modal">Actualizar</button>

                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
		function agregaDatosCliente(rut_cli){

			$.ajax({
				type:"POST",
				data:"rut=" + rut_cli,
				url:"../procesos/clientes/obtenDatosCliente.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#rut').val(dato['rut_cli']);
          $('#dv').val(dato['dv']);
					$('#nombre').val(dato['nombre']);
					$('#apellidos').val(dato['apellido']);
					$('#direccion').val(dato['direccion']);
					$('#email').val(dato['email']);
					$('#telefono').val(dato['telefono']);

				}
			});
		}

		function eliminarCliente(idcliente){
			alertify.confirm('¿Desea eliminar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procesos/clientes/eliminarCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaClientesLoad').load("../procesos/clientes/tablaClientes.php");

			$('#btnAgregarCliente').click(function(){

				vacios=validarFormVacio('frmClientes');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmClientes').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/agregaCliente.php",
					success:function(r){

						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("../procesos/clientes/tablaClientes.php");
							alertify.success("Cliente agregado con exito :D");
						}else{
							alertify.error("No se pudo agregar cliente");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarClienteU').click(function(){
				datos=$('#frmClientesU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaCliente.php",
					success:function(r){

						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("../procesos/clientes/tablaClientes.php");
							alertify.success("Cliente actualizado con exito :D");
						}else{
							alertify.error("No se pudo actualizar cliente");
						}
					}
				});
			})
		})
	</script>


<?php 
session_start();
if(isset($_SESSION['usuario'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Mi Cuenta - Ferme</title>
                <?php
            include 'links_vist.php';
            ?>
			<style>
			p.padding {
			  padding-top: 2cm;
			}

			p.padding2 {
			  padding-top: 5%;
			}
			p.padding3 {
				padding-left: 2%;
			}
			td.border2 {
				border-left: 3px double;
			}
			td.border3 {
				border-bottom: 3px double;
			}
			</style>
	</head>
	<body>
    <?php include 'navbar_vist.php'; ?>
		<div class="container">
			<h1>Mi Cuenta</h1>
			<div class="row">
				<div class="col-sm-12">
					<form id="frmRegistro">
					</form>
					<div id="tablaUsuariosLoad"></div>
				</div>
			</div>
		</div>
		
	<?php
	include '../clases/configuracion.php';
	
	require_once "../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
		$result=mysqli_query($conexion,"SELECT count(a.n_boleta) as total 
												FROM boleta a JOIN cliente b
												ON a.idcliente=b.idcliente
												JOIN usuarios c
												ON b.id_user=c.id_user");
		$data=mysqli_fetch_assoc($result);
		$count=$data['total'];
		
		if($count>0){ $mail= $_SESSION['usuario']; ?>
				
				<div  align="center" id="mainWrapper">
						<p>
							<table width="50%" cellspacing="0" cellpadding="10">
								<tr>
									<td class="border3 text-center"  width="50%" valign="top"><h3>Historial de compras</h3>
									
									</td>
								</tr>
							</table>
						</p>
					</div>
				<?php
				$sqlpdf="SELECT b.n_boleta,
								b.total,
								b.fecha_emision,
								b.id_pago
								FROM boleta b JOIN cliente a
								on  a.idcliente=b.idcliente
								JOIN usuarios c
								on a.id_user=c.id_user
								WHERE c.email='$mail'";
				$resultpdf=mysqli_query($conexion,$sqlpdf);
				while($ver4=mysqli_fetch_assoc($resultpdf)){?>
				
					
					<div  align="center" id="mainWrapper">
						<p>
							<table width="30%" cellspacing="0" cellpadding="10">
								<tr>
									<td class="border3 text-center" width="50%" valign="top">
									<p class="padding3">Boleta N°: <?php  echo $ver4['n_boleta'];?> - Fecha Compra: <?php  echo $ver4['fecha_emision'];?><br>Total: $<?php  echo $ver4['total'];?>
										<div style="width:100%;" align="center">
											<form action="imprimirBoleta.php?idVenta=<?php echo $ver4['id_pago']; ?>" method="post" target="_blank" type="hidden" >
												<button 
													type="submit" 
													name="imprimir" 
													value="Imprimir">Imprimir Boleta
												</button>
											</form>
										</div>
									</p>
									</td>
								</tr>
							</table>
						</p>
					</div>
							
			<?php	}
	 } ?>
		
	
		


		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="actualizaClienteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
							<label>Email</label>
							<input type="text" class="form-control input-sm" name="emailU" id="emailU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
							<label>Direccion (calle/pasaje + # + ciudad)</label>
							<input type="text" class="form-control input-sm" name="direccionU" id="direccionU">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" name="telefonoU" id="telefonoU">

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaCliente" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Cliente</button>

					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal 2 -->
		<div class="modal fade" id="actualizaClienteModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU2">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
							<label>Direccion</label>
							<input type="text" class="form-control input-sm" name="direccionU" id="direccionU">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" name="telefonoU" id="telefonoU">

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaCliente2" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Cliente</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosUsuario(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_user']);
					$('#emailU').val(dato['email']);
				}
			});
		}
	</script>
	
	<script type="text/javascript">
		function agregaDatosCliente(idusuario){
			
			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/clientes/obtenDatosCliente.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_user']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#direccionU').val(dato['direccion']);
					$('#telefonoU').val(dato['telefono']);
				}
			});
		}
	</script>
	
	<script>
		function eliminaUsuario(idusuario){
			alertify.confirm('¿Desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/eliminarUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Eliminado con exito!!");
							window.location.href = "../procesos/salir.php";	
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
	
	<script>
		function eliminarCliente(idusuario){
			alertify.confirm('¿Desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/clientes/eliminarCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
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
			$('#btnActualizaCliente').click(function(){

				datos=$('#frmRegistroU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaCliente.php",
					success:function(r){

						if(r==1){
							
							datos=$('#frmRegistroU').serialize();
							$.ajax({
								type:"POST",
								data:datos,
								url:"../procesos/usuarios/actualizaUsuario.php",
								success:function(r){

									if(r==1){
										
										$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
										alertify.success("Actualizado con exito :D");
									}else{
										alertify.error("No se pudo actualizar :(");
									}
								}
							});
						}else{
							alertify.error("No se pudo actualizar :(");
						}
					}
				});
			});
		});
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaCliente2').click(function(){
				
				vacios = validarFormVacio('frmRegistroU2');
				
				if(vacios > 0) {
					alert("Debes llenar todos los campos");
				} else {

				datos=$('#frmRegistroU2').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/agregaCliente.php",
					success:function(r){

						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Actualizado con exito :D");
									
						}else{
							alertify.error("No se pudo actualizar :(");
						}
					}
				});
				}
			});
		});
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');

			$('#registro').click(function(){

				vacios=validarFormVacio('frmRegistro');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/regLogin/registrarUsuario.php",
					success:function(r){
						//alert(r);

						if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Agregado con exito");
						}else{
							alertify.error("Fallo al agregar :(");
						}
					}
				});
			});
		});
	</script>
	<?php 
}else{
	header("location:../index.php");
}
?>
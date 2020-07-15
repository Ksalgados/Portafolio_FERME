<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>usuarios</title>
        <?php    include 'prov_links_vist.php'; ?>
            
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
			border-bottom: 2px double;
		}
		td.border3 {
			border-bottom: 3px double;
		}
		div.padding3 {
			padding-left: 2%;
		}
		div.padding6 {
			padding-left: 8%;
			padding-right: 8%;
		}
		div.padding4 {
			padding: 2%;
		}
		div.padding5 {
			padding-left: 10%;
			padding-right: 10%;
			padding-top: 3%;
		}
		article {
		  float: right;
		  padding: 20px;
		  width: 50%;
		  background-color: #f1f1f1;
		}
		article2 {
		  float: left;
		  width: 50%;
		  background: #ccc;
		  padding: 20px;
		}
		section:after {
		  content: "";
		  display: table;
		  clear: both;
		}
		div.principal {
		  background-color: #000000;
		  color: white;
		}
		div.principal2 {
		  background-color: #FFFFFF;
		   color: black;
		}
		article2.scroll {
			height: 585px;
			overflow-y: scroll;
		}
		</style>
	</head>
	<body>

	<?php include 'prov_navbar_vist.php'; ?>
		<div class="principal padding4" align="center" class="container">
			<h1>Proveedor <?php echo $_SESSION['usuario'] ?></h1>
			<div class="row padding6">
				<div class="col-sm-12 principal2">
					<form id="frmRegistro">
					</form>
					<div align="center" class="padding5" id="tablaUsuariosLoad"></div>
				</div>
			</div>
		</div>	
	<?php
	$mail= $_SESSION['usuario']; 
	// ORDENES PENDIENTES - MENU CON SCROLL LATERAL
	
	
	include '../../clases/configuracion.php';
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	$result=mysqli_query($conexion,"SELECT count(a.id_ordencompra) as total 
											FROM ordencompra a JOIN proveedor b
											ON a.id_prov=b.id_prov
											JOIN usuarios c
											ON b.id_usurio=c.id_user");
	$data=mysqli_fetch_assoc($result);
	$count=$data['total'];
		
		if($count>0){ ?>
			
			<article2 class="scroll">
				<div class="padding3" align="left"  id="mainWrapper">
					<p>
						<table width="100%" cellspacing="0" cellpadding="10">
							<tr>
								<td class="border3 text-center" width="50%" valign="top"><h3>Ordenes Pendientes</h3>
								</td>
							</tr>
						</table>
					</p>
				</div>
				<?php
				$sqlpdf="SELECT a.id_ordencompra,
								a.estado,
								a.fecha_emision
								FROM ordencompra a JOIN proveedor b
								ON a.id_prov=b.id_prov
								JOIN usuarios c
								ON b.id_usurio=c.id_user
								WHERE a.estado!='aceptado' AND a.estado!='rechazado' AND c.email='$mail'";
				$resultpdf=mysqli_query($conexion,$sqlpdf);
				while($ver4=mysqli_fetch_assoc($resultpdf)){?>
					
					<div  align="left" id="mainWrapper">
						<article2>
							<p>
								<table height= 150px; width="100%" cellspacing="0" cellpadding="10">
									<tr>
										<td class="border3 text-center" width="50%" valign="top">
											<p align="left" class="padding3">Orden de Compra N°: <?php  echo $ver4['id_ordencompra'];?><br>
											Fecha de Orden: <?php  echo $ver4['fecha_emision'];?><br>Estado de la Orden: <span style="color:tomato;"><b><?php echo $ver4['estado']; ?></b></span>
											<br>
											<input type="button" 
											data-toggle="modal" 
											data-target="#detallesModal<?php  echo $ver4['id_ordencompra'];?>" 
											style="color:Green;" 
											class="btn" 
											value="Ver Orden">
											</p>
										</td>
									</tr>
									
									<!-- Modal Ver Orden -->
									<div class="modal fade" id="detallesModal<?php  echo $ver4['id_ordencompra'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog " role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="myModalLabel">Detalle Orden N° <?php echo $ver4['id_ordencompra']; ?></h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-body">
													<form id="frmRegistroU">
														<label>Productos Solicitados:</label>
														<?php
														$ida=$ver4['id_ordencompra'];
														$sqlpdfa="SELECT a.id_ordencompra,
																		a.estado,
																		a.fecha_emision,
																		d.id_det_orden ,
																		d.descripcion,
																		d.cantidad
																		FROM detalleorden d JOIN ordencompra a
																		ON d.id_ordencompra = a.id_ordencompra
																		WHERE d.id_ordencompra='$ida'";
														$resultpdfa=mysqli_query($conexion,$sqlpdfa);
														while($ver5=mysqli_fetch_assoc($resultpdfa)){?>
														<input type="text" class="form-control" id="inputEmail4" name="nombre" value="<?php echo $ver5['descripcion']; ?> x<?php echo $ver5['cantidad']; ?>" disabled></label>
													</form>
														<?php } ?>
												</div>
												<div class="modal-footer">
													<h4 class="modal-title" id="myModalLabel">Estado: <span style="color:tomato;"><?php echo $ver4['estado']; ?></h4>
												</div>
											</div>
										</div>
									</div>
								</table>
							</p>
						</article2>
						
						<article>
							<p>
								<table height= 150px; width="100%" cellspacing="0" cellpadding="10">
									<tr>
										<td class="border3 text-center" width="50%" valign="top">
											<p align="left" class="padding3">
												<div style="width:100%;" align="center">
													<form onSubmit="return confirm('Esta seguro de cambiar el estado de la Orden?');" action="../../procesos/proveedores/actualizaProveedor.php">
													  <label for="status">Actualizar Orden:</label>
													  <select name="status" id="status">
														  <option value="aceptado">Aceptado</option>
														  <option value="rechazado">Rechazado</option>
													  </select>
													  <select name="orden" id="orden" hidden="">
														  <option value="<?php echo $ver4['id_ordencompra']; ?>" selected><?php echo $ver4['id_ordencompra']; ?></option>
													  </select>
													  <br><br>
													  <input type="submit" value="Actualizar">
													</form>
												</div>
											</p>
										</td>
									</tr>
								</table>
							</p>
						</article>
					</div>
	<?php	} ?>
			</article2>
  <?php } ?>
	
	<?php
	
	// ORDENES YA CONFIRMADAS O RECHAZADAS - CON SCROLL LATERAL MOMENTANEO
	$result=mysqli_query($conexion,"SELECT count(a.id_ordencompra) as total 
											FROM ordencompra a JOIN proveedor b
											ON a.id_prov=b.id_prov
											JOIN usuarios c
											ON b.id_usurio=c.id_user");
	$data=mysqli_fetch_assoc($result);
	$count=$data['total'];
		
		if($count>0){ ?>
			
			<article2 class="scroll">
				<div class="padding3" align="left"  id="mainWrapper">
					<p>
						<table width="100%" cellspacing="0" cellpadding="10">
							<tr>
								<td class="border3 text-center" width="50%" valign="top"><h3>Ordenes Procesadas</h3>
								</td>
							</tr>
						</table>
					</p>
				</div>
				<?php
				$sqlpdf="SELECT a.id_ordencompra,
								a.estado,
								a.fecha_emision
								FROM ordencompra a JOIN proveedor b
								ON a.id_prov=b.id_prov
								JOIN usuarios c
								ON b.id_usurio=c.id_user
								WHERE c.email='$mail' AND a.id_prov=b.id_prov";
				$resultpdf=mysqli_query($conexion,$sqlpdf);
				while($ver4=mysqli_fetch_assoc($resultpdf)){
					if($ver4['estado']=='rechazado' || $ver4['estado']=='aceptado' || $ver4['estado']=='recibido'){?>
					
					<div  align="left" id="mainWrapper">
						<article2>
							<p>
								<table height= 150px; width="100%" cellspacing="0" cellpadding="10">
									<tr>
										<td class="border3 text-center" width="50%" valign="top">
											<p align="left" class="padding3">Orden de Compra N°: <?php  echo $ver4['id_ordencompra'];?><br>
											Fecha de Orden: <?php  echo $ver4['fecha_emision'];?><br>Estado de la Orden: <span style="color:tomato;"><b><?php echo $ver4['estado']; ?></b></span>
											<br>
											<input type="button" 
											data-toggle="modal" 
											data-target="#detallesModal<?php  echo $ver4['id_ordencompra'];?>" 
											style="color:Green;" 
											class="btn" 
											value="Ver Orden">
											</p>
										</td>
									</tr>
									
									<!-- Modal Ver Orden -->
									<div class="modal fade" id="detallesModal<?php  echo $ver4['id_ordencompra'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog " role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="myModalLabel">Detalle Orden N° <?php echo $ver4['id_ordencompra']; ?></h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-body">
													<form id="frmRegistroU">
														<label>Productos Solicitados:</label>
														<?php
														$ida=$ver4['id_ordencompra'];
														$sqlpdfa="SELECT a.id_ordencompra,
																		a.estado,
																		a.fecha_emision,
																		d.id_det_orden ,
																		d.descripcion,
																		d.cantidad
																		FROM detalleorden d JOIN ordencompra a
																		ON d.id_ordencompra = a.id_ordencompra
																		WHERE d.id_ordencompra='$ida'";
														$resultpdfa=mysqli_query($conexion,$sqlpdfa);
														while($ver5=mysqli_fetch_assoc($resultpdfa)){?>
														<input type="text" class="form-control" id="inputEmail4" name="nombre" value="<?php echo $ver5['descripcion']; ?> x<?php echo $ver5['cantidad']; ?>" disabled></label>
													</form>
														<?php } ?>
												</div>
												<div class="modal-footer">
													<h4 class="modal-title" id="myModalLabel">Estado: <span style="color:tomato;"><?php echo $ver4['estado']; ?></h4>
												</div>
											</div>
										</div>
									</div>
								</table>
							</p>
						</article2>
					</div>
			<?php		}	
		} ?>
			</article2>
  <?php } ?>

		<!-- Modal Actualizar Usuario -->
		<div class="modal fade" id="actualizaProveedorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="emailU" id="emailU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaEmpresa" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Cliente</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>

	<!-- Script para agregar datos al Modal de Usuario -->
	<script type="text/javascript">
		function agregaDatosUsuario(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_user']);
					$('#emailU').val(dato['email']);
				}
			});
		}
	</script>
	
	<!-- Script para agregar datos al Modal de Detalles -->
	<script type="text/javascript">
		function agregaDatosDetalle(idorden){

			$.ajax({
				type:"POST",
				data:"idorden=" + idorden,
				url:"../../procesos/proveedores/obtenDatosProveedor.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idorden').val(dato['descripcion']);
				}
			});
		}
	</script>
	
	<!-- Script para actualizar cuenta de Proveedor (usuario) -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaEmpresa').click(function(){

				datos=$('#frmRegistroU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../../procesos/usuarios/actualizaUsuario.php",
					success:function(r){

						if(r==1){
									
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Actualizado con exito :D");
							window.location.href = "../../procesos/salir.php";
						}else{
							lertify.error("No se pudo actualizar :(");
						}
					}
				});
			});
		});
	</script>
	
	<!-- Script para mostrar los datos del Proveedor -->
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
					url:"../../procesos/regLogin/registrarUsuario.php",
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
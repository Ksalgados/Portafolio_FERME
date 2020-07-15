<?php 

	class clientes{

		public function agregaCliente($datos){
			session_start();
			$c= new conectar();
			$conexion=$c->conexion();
			
				
			$sql="SELECT id_user, 
							email 
						from usuarios";
			$result=mysqli_query($conexion,$sql);
			while($ver=mysqli_fetch_row($result)):
			if($_SESSION['usuario']==$ver[1]){
			$sql="INSERT into cliente (nombre,
										apellido,
										direccion,
										telefono,
										id_user)
							values ('$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$ver[0]'
									)";
			
			}
			endwhile;
			return mysqli_query($conexion,$sql);
		}

		public function obtenDatosCliente($idusuario){
			
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT    id_user,
							nombre,
							apellido,
							direccion,
							telefono
					from cliente
					where id_user='$idusuario'";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'id_user' => $ver[0],
					'nombre' => $ver[1],
					'apellido' => $ver[2],
					'direccion' => $ver[3],
					'telefono' => $ver[4],
						);
			return $datos;
		}

		public function actualizaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			
			$sql="UPDATE cliente set 	nombre='$datos[1]',
										apellido='$datos[2]',
										direccion='$datos[3]',
										telefono='$datos[4]'
								where id_user='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}

		public function eliminarCliente($idusuario){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from cliente where id_user='$idusuario'";

			return mysqli_query($conexion,$sql);
		}
	}

 ?>
<?php 

	class clientes{

		public function agregaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into clientes (rut_cli,
										nombre,
										apellido,
										usuario,
										pass,
										direccion,
										telefono,
										id_user,
										rut_admin,
										rut_vend)
							values ('',
									'$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'',
									'',
									'20',
									'12456123',
									'11256321')";
			return mysqli_query($conexion,$sql);	
		}

		public function obtenDatosCliente($idcliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT    rut_cli, 
							nombre,
							apellido,
							usuario,
							direccion,
							email,
							telefono,
							rfc 
				from clientes";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'rut_cli' => $ver[0], 
					'nombre' => $ver[1],
					'apellido' => $ver[2],
					'usuario' => $ver[3],
					'direccion' => $ver[4],
					'telefono' => $ver[5],
						);
			return $datos;
		}

		public function actualizaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE clientes set nombre='$datos[1]',
										apellido='$datos[2]',
										usuario='$datos[3]',
										direccion='$datos[4]',
										telefono='$datos[5]',
								where rut_cli='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}

		public function eliminaCliente($idcliente){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from clientes where rut_cli='$idcliente'";

			return mysqli_query($conexion,$sql);
		}
	}

 ?>
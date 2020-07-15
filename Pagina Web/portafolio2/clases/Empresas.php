<?php 

	class empresas{

		public function agregaEmpresa($datos){
			session_start();
			$c= new conectar();
			$conexion=$c->conexion();
			
				
			$sql="SELECT id_user, 
							email 
						from usuarios";
			$result=mysqli_query($conexion,$sql);
			while($ver=mysqli_fetch_row($result)):
			if($_SESSION['usuario']==$ver[1]){
			$sql="INSERT into empresa (rut_empresa,
										Nombre,
										direccion,
										telefono,
										email,
										rubro,
										id_user)
							values ('$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$ver[1]',
									'$datos[4]',
									'$ver[0]'
									)";
			
			}
			endwhile;
			return mysqli_query($conexion,$sql);
		}

		public function obtenDatosEmpresa($idusuario){
			
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT    id_user,
							rut_empresa,
							Nombre,
							direccion,
							telefono,
							email,
							rubro
					from empresa
					where id_user='$idusuario'";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'id_user' => $ver[0],
					'rut_empresa' => $ver[1],
					'Nombre' => $ver[2],
					'direccion' => $ver[3],
					'telefono' => $ver[4],
					'email' => $ver[5],
					'rubro' => $ver[6]
						);
			return $datos;
		}

		public function actualizaEmpresa($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			
			$sql="UPDATE empresa set 	Nombre='$datos[1]',
										direccion='$datos[2]',
										telefono='$datos[3]',
										email='$datos[4]',
										rubro='$datos[5]'
								where id_user='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}

		public function eliminarEmpresa($idusuario){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from empresa where id_user='$idusuario'";

			return mysqli_query($conexion,$sql);
		}
	}

 ?> 
<?php 

	class usuarios{
		public function registroUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$fecha=date('Y-m-d');

			$sql="INSERT into usuarios (nombre,
								apellido,
								email,
								password
								)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',
								'$datos[3]')";
			return mysqli_query($conexion,$sql);
		}
		public function loginUser($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			$password=sha1($datos[1]);

			$_SESSION['usuario']=$datos[0];
			$_SESSION['iduser']=self::traeID($datos);

			$sql="SELECT * 
					from usuarios 
				where email='$datos[0]'
				and password='$password'";
			$result=mysqli_query($conexion,$sql);

			if(mysqli_num_rows($result) > 0){
				return 1;
			}else{
				return 0;
			}
		}
		public function traeID($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$password=sha1($datos[1]);

			$sql="SELECT id_user 
					from usuarios 
					where email='$datos[0]'
					and password='$password'"; 
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_user,
							nombre,
							apellido,
							email,
							id_tip_user
					from usuarios 
					where id_user='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_user' => $ver[0],
							'nombre' => $ver[1],
							'apellido' => $ver[2],
							'email' => $ver[3],
							'id_tip_user' => $ver[4]
						);

			return $datos;
		}

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set nombre='$datos[1]',
									apellido='$datos[2]',
									email='$datos[3]'
								where id_user='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaUsuario($idusuario){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from usuarios 
					where id_user='$idusuario'";
			return mysqli_query($conexion,$sql);
		}
	}

 ?>
 <?php 
 class Empresa{
	public function registroUsuario($datos){
		$c=new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d');

		$sql="INSERT into usuarios (nombre,
							apellido,
							email,
							password,
							id_tip_user
							)
					values ('$datos[0]',
							'$datos[1]',
							'$datos[2]',
							'$datos[3]',
							'$datos[4]')";
		return mysqli_query($conexion,$sql);
	}
	public function loginUser($datos){
		$c=new conectar();
		$conexion=$c->conexion();
		$password=sha1($datos[1]);

		$_SESSION['usuario']=$datos[0];
		$_SESSION['iduser']=self::traeID($datos);

		$sql="SELECT * 
				from usuarios 
			where email='$datos[0]'
			and password='$password'";
		$result=mysqli_query($conexion,$sql);

		if(mysqli_num_rows($result) > 0){
			return 1;
		}else{
			return 0;
		}
	}
	public function traeID($datos){
		$c=new conectar();
		$conexion=$c->conexion();

		$password=sha1($datos[1]);

		$sql="SELECT id_user 
				from usuarios 
				where email='$datos[0]'
				and password='$password'"; 
		$result=mysqli_query($conexion,$sql);

		return mysqli_fetch_row($result)[0];
	}

	public function obtenDatosUsuario($idusuario){

		$c=new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_user,
						nombre,
						apellido,
						email,
						id_tip_user
				from usuarios 
				where id_user='$idusuario'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$datos=array(
					'id_user' => $ver[0],
						'nombre' => $ver[1],
						'apellido' => $ver[2],
						'email' => $ver[3],
						'id_tip_user' => $ver[4]
					);

		return $datos;
	}

	public function actualizaUsuario($datos){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="UPDATE usuarios set nombre='$datos[1]',
								apellido='$datos[2]',
								email='$datos[3]'
					where id_user='$datos[0]'";
		return mysqli_query($conexion,$sql);	
	}

	public function eliminaUsuario($idusuario){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="DELETE from usuarios 
				where id_user='$idusuario'";
		return mysqli_query($conexion,$sql);
	}
}
?>
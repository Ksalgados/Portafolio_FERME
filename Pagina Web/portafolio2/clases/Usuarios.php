<?php 

	class usuarios{
		public function registroUsuario($datos){
            $c=new conectar();
            $conexion=$c->conexion();
			
			$sqlc="select count(email) as total from usuarios where email='$datos[0]'";
			$resultc=mysqli_query($conexion,$sqlc);
			$data=mysqli_fetch_assoc($resultc);
			$count=$data['total'];
			
			if($count > 0){
				return 0;
			}else{
				$tipo=40;
            $sql="INSERT into usuarios(
                                email,
                                pass,
                                tip_user
                                )
                        values ('$datos[0]',
                                '$datos[1]',
                                '$tipo')";
			
            return mysqli_query($conexion,$sql);
			}
			
            
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
				and pass='$password'
				and tip_user=40";
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
					and pass='$password'"; 
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_user,
							email
					from usuarios 
					where id_user='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_user' => $ver[0],
							'email' => $ver[1]
						);

			return $datos;
		}

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set email='$datos[1]'
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
	class empresa{
		public function registroUsuario($datos){
            $c=new conectar();
            $conexion=$c->conexion();
			
			$sqlc="select count(email) as total from usuarios where email='$datos[0]'";
			$resultc=mysqli_query($conexion,$sqlc);
			$data=mysqli_fetch_assoc($resultc);
			$count=$data['total'];
			
			if($count > 0){
				return 0;
			}else{
				$tipo=50;
            $sql="INSERT into usuarios(
                                email,
                                pass,
                                tip_user
                                )
                        values ('$datos[0]',
                                '$datos[1]',
                                '$tipo')";
			
            return mysqli_query($conexion,$sql);
			}
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
				and pass='$password'
				and tip_user=50";
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
					and pass='$password'"; 
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_user,
							email
					from usuarios 
					where id_user='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_user' => $ver[0],
							'email' => $ver[1]
						);

			return $datos;
		}

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set email='$datos[1]'
								where id_user='$datos[0]'";
			$sql2="UPDATE empresa set email='$datos[1]'
								where id_user='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaUsuario($idusuario){
			
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE FROM usuarios WHERE id_user='$idusuario'";
			
			return mysqli_query($conexion,$sql);
		}
	}

 ?>
 
 <?php
	class proveedor{
		public function registroUsuario($datos){
            $c=new conectar();
            $conexion=$c->conexion();

            $tipo=60;
            $sql="INSERT into usuarios(
                                email,
                                pass,
                                tip_user
                                )
                        values ('$datos[0]',
                                '$datos[1]',
                                '$tipo')";
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
				and pass='$password'
				and tip_user=60";
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
					and pass='$password'"; 
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_user,
							email
					from usuarios 
					where id_user='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_user' => $ver[0],
							'email' => $ver[1]
						);

			return $datos;
		}

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set email='$datos[1]'
								where id_user='$datos[0]'";
			$sql2="UPDATE empresa set email='$datos[1]'
								where id_user='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaUsuario($idusuario){
			
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE FROM usuarios WHERE id_user='$idusuario'";
			
			return mysqli_query($conexion,$sql);
		}
	}

 ?>
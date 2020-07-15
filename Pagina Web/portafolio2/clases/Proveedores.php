<?php 

	class proveedores{

		public function actualizaProveedor($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			
			$sql="UPDATE ordencompra set 	estado='$datos[0]'
								where id_ordencompra='$datos[1]'";
			$return = mysqli_query($conexion,$sql);
			
			return header('Location: ../../vistas/prov/prov_micuenta.php');
		}
		
		public function obtenDatosProveedor($idorden){
			
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT    descripcion
					from detalleorden
					where id_ordencompra='$idorden'";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'descripcion' => $ver[0]
						);
			return $datos;
		}

	}

 ?> 
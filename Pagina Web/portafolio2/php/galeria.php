
<?php
	
	$c= new conectar();
	$conexion=$c->conexion();
	$sql="SELECT id, SUM(cantidad) as NUM FROM detalleboleta GROUP BY id ORDER BY NUM DESC LIMIT 4";
	$result=mysqli_query($conexion,$sql);
	?>
	<div class="container marketing">
		<div class="row">
	<?php
		while($ver=mysqli_fetch_row($result)){
			
			$sentencia=$pdo->prepare("SELECT * FROM producto where id_produc='$ver[0]'");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$dynamicList = "";
            //print_r($listaProductos);
			foreach($listaProductos as $producto){ 
				$id = $producto['id_produc'];
				$name = $producto['nombre'];
				$brand = $producto['marca'];
				$desc = $producto['descripcion'];
				$price = $producto['precio'];
				$stock = $producto['stock'];
				$stockc = $producto['stockCritico'];
				$image = $producto['imagen'];
				$idu = $producto['id_user'];
			
			
				echo	'<div class="col-lg-3">
						<svg class="bd-placeholder-img" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
							preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
							<title>'.$name.'</title>
							<img
							title=' .$name. '
							alt='.$name.'
							src="data:image/jpeg; base64,'. base64_encode($image).'"
							height="200"
							id="imagen"
							name="imagen"
							>
						</svg>
						<p><small>'.$brand.'</small>
							<h6>'.$name.'</h6>
							<small>SKU '.$id.'</small>
							<br>
							$'.number_format($price,0,",",".").'
						</p>
						<p><a class="btn btn-secondary" href="http://localhost/portafolio2/template/detalles.php?id='.$id.'" role="button">Ver Producto</a></p>
					</div>';
				
			
			} 
		} 
		?>
		</div>
	</div>
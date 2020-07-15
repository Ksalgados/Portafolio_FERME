<?php
  include '../clases/configuracion.php';
  include '../clases/conn.php';
  include '../template/carrito.php';
?>
<html>
<head>
    <title>Productos - FERME</title>
    <?php
  include '../php/links.php';
?>
</head>
<body>
    <?php
  include 'navbar_temp.php';
?>


<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 my-4 mx-auto text-center">
    <h1 class="display-4 mt-4">Lista de Productos</h1>
    <p class="lead">Selecciona uno de nuestros productos y accede a un descuento</p>
</div>

<div class="container">
        <?php if($mensaje!=""){?>
        <div class="alert alert-success">
            <?php echo $mensaje;?>
        </div>
        <?php }?>
    <div class="row">
        <?php
			
			
            $sentencia=$pdo->prepare("SELECT * FROM `producto`");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$dynamicList = "";
			
			$articulos_x_pagina = 8;
			$total_articulos_db = $sentencia->rowCount();
			$paginas = $total_articulos_db/8;
			$paginas = ceil($paginas);
			$iniciar=($_GET['pagina']-1)*$articulos_x_pagina;
			
			
		
				if(!$_GET){
					header('Location:productos.php?pagina=1');
					
				}
				if($_GET['pagina']>$paginas || $_GET['pagina']<= 0){
					header('Location:productos.php?pagina=1');
				}

			
            //print_r($listaProductos);
        ?>
		<?php
			
			$sql_articulos = "SELECT * FROM producto LIMIT :iniciar,:narticulos";
			$sentencia_articulos = $pdo->prepare($sql_articulos);
			$sentencia_articulos->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
			$sentencia_articulos->bindParam(':narticulos', $articulos_x_pagina, PDO::PARAM_INT);
			$sentencia_articulos->execute();
			
			$resultado_articulos = $sentencia_articulos->fetchAll();
		
		?>
        <?php foreach($resultado_articulos as $producto){ 
													$id = $producto['id_produc'];
													$name = $producto['nombre'];
													$brand = $producto['marca'];
													$desc = $producto['descripcion'];
													$price = $producto['precio'];
													$stock = $producto['stock'];
													$stockc = $producto['stockCritico'];
													$image = $producto['imagen'];
													$idu = $producto['id_user'];
            echo '<div class="col-3">
                <div class="card">
				<a href="http://localhost/portafolio2/template/detalles.php?id='.$id.'">
                    <img 
                    class="card-img-top" 
                    title=' .$name. '
                    alt='.$name.'
                    src="data:image/jpeg; base64,'. base64_encode($image).'"
                    data-toggle="popover"
                    data-trigger="hover"
                    data-content='.$desc.'
                    height="317px"
                    id="imagen"
                    name="imagen"
                    >
				</a>
                    <div class="card-body">
                        <small>'.$brand.'</small>
                        <br>
                        <span>'.$name.'</span>
                        <h5 class="card-title">$'.$price.'</h5>
                        <p class="card-text">cod: '.$id.'</p>
                        <small>stock: ';
                            if($stock>90){
                                echo "Disponible";
                            }else{
                                if($stock<10){
                                    echo "Limitado";
                                }else{
                                    echo "No Disponible";
                                }
                            }
							echo '</small>
                    </div>
                   <form action="" method="post">
                    <input type="hidden" name="id" id="id" value=' . openssl_encrypt($id,COD,KEY) . '>
                    <input type="hidden" name="nombre" id="nombre" value=' . openssl_encrypt($name,COD,KEY) . '>
                    <input type="hidden" name="precio" id="precio" value=' . openssl_encrypt($price,COD,KEY) . '>
					<input type="hidden" name="marca" id="marca" value=' . openssl_encrypt($brand,COD,KEY) . '>
					<input type="hidden" name="desc" id="desc" value=' . openssl_encrypt($desc,COD,KEY) . '>
                    <input type="hidden" name="cantidad" id="cantidad" value=' . openssl_encrypt(1,COD,KEY) . '>
                   <button class="btn btn-primary" 
                    name="btnAction" 
                    type="submit"
                    value="Agregar">
                    Agregar al carrito
                    </button>
                   </form>
                </div>
				<br>
            </div>';
         } ?>
    </div>
	
	
	
	<!-- Paginacion -->
	<nav aria-label="Page navigation example">
	  <ul class="pagination">
		<li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled':'' ?>"><a class="page-link" href="productos.php?pagina=<?php echo $_GET['pagina']-1 ?>">Anterior</a></li>
		
		<?php for($i=0;$i<$paginas;$i++): ?>
		<li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
			<a class="page-link" href="productos.php?pagina=<?php echo $i+1 ?>">
			<?php echo $i+1 ?>
			</a>
		</li>
		<?php endfor ?>
		
		<li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled':'' ?>"><a class="page-link" href="productos.php?pagina=<?php echo $_GET['pagina']+1 ?>">Siguiente</a></li>
	  </ul>
	</nav>
</div>
</body>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
            })
    </script>
</html>
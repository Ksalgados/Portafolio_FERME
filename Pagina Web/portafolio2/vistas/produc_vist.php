<?php
  include '../clases/configuracion.php';
  include '../clases/conn.php';
  include '../template/carrito.php';
?>
<html>
<head>
    <title>Ferreteria FERME</title>
    <?php
  include '../php/links.php';
?>
</head>
<body>
    <?php
  include 'navbar_vist.php';
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
            //print_r($listaProductos);
        ?>
        <?php foreach($listaProductos as $producto){ 
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
				<a href="detalles.php?id='.$id.'">
                    <img 
                    class="card-img-top" 
                    title=' .$name. '
                    alt='.$name.'
                    src="data:image/jpeg; base64,'. base64_encode($image).'"
                    data-toggle="popover"
                    data-trigger="hover"
                    data-content='.$desc.'
                    height="270px"
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
</div>
</body>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
            })
    </script>
</html>
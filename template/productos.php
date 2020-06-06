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
            //print_r($listaProductos);
        ?>
        <?php foreach($listaProductos as $producto){?>
            <div class="col-3">
                <div class="card">
                    <img 
                    class="card-img-top" 
                    title="<?php echo $producto['nombre']; ?>"
                    alt="<?php echo $producto['nombre']; ?>"
                    src="<?php echo $producto['imagen']; ?>" 
                    data-toggle="popover"
                    data-trigger="hover"
                    data-content="<?php echo $producto['descripcion']; ?>"
                    height="317px"
                    id="imagen"
                    name="imagen"
                    >
                    <div class="card-body">
                        <small><?php echo $producto['marca']; ?></small>
                        <br>
                        <span><?php echo $producto['nombre']; ?></span>
                        <h5 class="card-title">$<?php echo $producto['precio']; ?></h5>
                        <p class="card-text">cod: <?php echo $producto['id']; ?></p>
                        <small>stock:
                        <?php 
                            if($producto['stock']>90){
                                echo "Disponible";
                            }else{
                                if($producto['stock']<10){
                                    echo "Limitado";
                                }else{
                                    echo "No Disponible";
                                }
                            }
                        ?></small>
                    </div>
                   <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'],COD,KEY); ?>">
                    <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'],COD,KEY); ?>">
                    <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'],COD,KEY); ?>">
                    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY); ?>">
                    <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($producto['imagen'],COD,KEY); ?>">
                   <button class="btn btn-primary" 
                    name="btnAction" 
                    type="submit"
                    value="Agregar">
                    Agregar al carrito
                    </button>
                   </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
            })
    </script>
</html>
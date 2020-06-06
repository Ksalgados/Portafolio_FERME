<?php
  include '../clases/configuracion.php';
  include 'carrito.php';
?>

<!DOCTYPE html>
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

<br>
    <h3>Lista Del Carrito</h3>
    <?php
        if(!empty( $_SESSION['CARRITO'])){
    ?>
    <table class="table table-light table-border-dark">
        <tbody>
            <tr>
               <th width="40%">Descripcion</th>
               <th width="10%" class="text-center">Codigo</th>
               <th width="10%" class="text-center">Cantidad</th>
               <th width="20%" class="text-center">Precio</th>
               <th width="20%" class="text-center">Total</th>
               <th width="5%">--</th>
            </tr>
            <?php 
                $total=0;
            ?>
            <?php 
                foreach($_SESSION['CARRITO'] as $indice=>$producto){

            ?>
            <tr>
               <td width="40%"><?php echo $producto['NOMBRE'];?></td>
               <th width="10%" class="text-center"><?php echo $producto['ID'];?></th>
               <td width="10%" class="text-center"><?php echo $producto['CANTIDAD'];?></td>
               <td width="20%" class="text-center">$<?php echo $producto['PRECIO'];?></td>
               <td width="20%" class="text-center"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2);?></td>
               <td width="5%" >
                   <form action="" method="post">
                   <input type="hidden" 
                   name="id" 
                   id="id" 
                   value="<?php echo openssl_encrypt($producto['ID'],COD,KEY); ?>">

                   <button 
                   class="btn btn-danger" 
                   type="submit" 
                   name="btnAction" 
                   value="Eliminar">
                   Eliminar</button>
                   </form> 
                </td>
                   
            </tr>
            <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']); ?>
            <?php  } ?>
            <tr>
                <td colspan="3" class="text-right" ><h3>Total<h3></td>
                <td width="20%" class="text-center" ><h3><?php echo number_format($total,2)  ?></h3></td>
                <td></td>
            </tr>
            <tr>
               <td colspan="5">
                <form action="pagar.php" method="post">
                    <div class="alert alert-success" role="alert">
                    <div class="form-group">
                        <label for="my-input">Correo de Contacto</label>
                        <input id="email" class="form-control" 
                        type="email" 
                        name="email"
                        placeholder="Por Favor Escribir tu correo"
                        required>
                    </div>
                    <small id="emailHelp"
                    class="form-text text-muted">
                    Los Productos se enviaran a este correo
                    </small>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Realizar Pago >> </button>
                </form>
                
            </tr>
        </tbody>
    </table>
        <?php }else{?>
            <div class="alert alert-success" role="alert">
               No hay productos en el carrito
            </div>
        <?php } ?>
</body>
</html>
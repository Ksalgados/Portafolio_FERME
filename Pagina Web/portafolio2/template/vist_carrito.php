<?php
  include '../clases/configuracion.php';
  include 'carrito.php';
   require __DIR__ . '/../extensiones/vendor/autoload.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Carro de Compras - FERME</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php
  include '../php/links.php';
?>
</head>

<body>
    <?php
  include 'navbar_temp.php';
?>

<br>
    <h3 class="text-center">Lista Del Carrito</h3>
    <?php
        if(!empty( $_SESSION['CARRITO'])){
    ?>
    <table style="width:50%" align="center" class="table table-light table-border-dark">
        <tbody>
            <tr>
               <th width="40%">Descripcion</th>
               <th width="10%" class="text-center">Codigo</th>
               <th width="10%" class="text-center">Cantidad</th>
               <th width="20%" class="text-center">Precio</th>
               <th width="20%" class="text-center">Total</th>
               <th width="5%"></th>
            </tr>
            <?php 
                $total=0;
            ?>
            <?php 
                foreach($_SESSION['CARRITO'] as $indice=>$producto){

            ?>
            <tr>
				<th width="10%"><?php echo $producto['ID'];?></th>
				<td width="40%"><?php echo $producto['NOMBRE'];?></td>
				<td width="10%" class="text-center"><?php echo $producto['CANTIDAD'];?></td>
				<td width="20%" class="text-center">$<?php echo $producto['PRECIO'];?></td>
				<td width="20%" class="text-center">$<?php echo number_format($producto['PRECIO']*$producto['CANTIDAD']);?></td>
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
							Eliminar
						</button>
					</form> 
                </td>
				
            </tr>
            <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']); ?>			
            <?php  } ?>
            <tr>
                <td colspan="3" class="text-right" ><h3>Total<h3></td>
                <td width="20%" class="text-center" ><h3>$<?php echo number_format($total)  ?></h3></td>
                <td></td>
            </tr>
			
			
        </tbody>
    </table>
	
	
			
			<tr>

			<form action="<?php echo $preference->init_point; ?>" method="post" align="right" type="hidden" style="padding-right:25%;padding-top:2%">
				 <button class="btn btn-outline-success my-1 my-sm-0" type="submit"><a
                        href="Cliente_Empresa.php">Inicie sesion para poder comprar</a></button>
			</form> 
			</tr>
			
			
	<?php }else{?>
		<div class="alert alert-success" role="alert">
		   No hay productos en el carrito
		</div>
	<?php } ?>
	
</body>
</html>
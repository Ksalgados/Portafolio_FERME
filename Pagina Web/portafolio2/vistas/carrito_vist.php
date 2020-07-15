<?php
  include '../clases/configuracion.php';
  include '../clases/Conexion.php';
  include '../template/carrito.php';
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
  include 'navbar_vist.php';
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
	
	<?php
			// SDK de Mercado Pago
			require __DIR__ .  '/../extensiones/vendor/autoload.php';

			// Agrega credenciales
			MercadoPago\SDK::setAccessToken('TEST-6104542340264722-070220-b5d02fd58042110f7f22b6853644013d-178165279');

			// Crea un objeto de preferencia
			$preference = new MercadoPago\Preference();

			// Crea un ítem en la preferencia
			$item = new MercadoPago\Item();
			  $item->id = "1234";
			  $item->title = $producto['NOMBRE'];
			  $item->description = 'sadsad';
			  $item->category_id = "home";
			  $item->quantity = 1;
			  $item->currency_id = "CLP";
			  $item->unit_price = $total;
			$preference->items = array($item);
			$preference->back_urls = array(
				"success" => "http://localhost/portafolio2/vistas/post_pago.php",
				"failure" => "http://localhost/portafolio2/vistas/carrito_vist.php",
				"pending" => "http://localhost/portafolio2/vistas/post_pago.php"
			);
			$preference->save();
			?>
			<head>
			
			<tr>
			
			<?php 
				
				$mail=$_SESSION['usuario'];
				$c=new conectar();
				$conexion=$c->conexion();
				$sqlc="select count(a.email) as total from usuarios a JOIN cliente b where a.email='$mail' AND a.id_user=b.id_user";
				$resultc=mysqli_query($conexion,$sqlc);
				$data=mysqli_fetch_assoc($resultc);
				$count=$data['total'];
					if($count>0){ ?>
						<form action="<?php echo $preference->init_point; ?>" method="post" align="right" type="hidden" style="padding-right:25%;padding-top:2%">
							<button 
								class="btn btn-danger" 
								type="submit">
								Pagar con Mercado Pago
							</button>
						</form> 
				<?php	}else{
			?>
			<form action="micuenta.php" method="post" align="right" type="hidden" style="padding-right:25%;padding-top:2%">
				<button 
					class="btn btn-danger" 
					type="submit">
					Actualiza tus Datos para proceder a la compra
				</button>
			</form> 
			</tr>
			<?php	} ?>
			
        <?php }else{?>
            <div class="alert alert-success" role="alert">
               No hay productos en el carrito
            </div>
        <?php } ?>
		
		
</body>
</html>


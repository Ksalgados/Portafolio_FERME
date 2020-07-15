<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$mensaje="";

    if(isset($_POST['btnAction'])){

        switch($_POST['btnAction']){

            case 'Agregar':
                if(is_string( openssl_encrypt($_POST['id'],COD,KEY))){
                    $ID=openssl_decrypt($_POST['id'],COD,KEY);
                }else{
                    $mensaje.="Upss codigo Error".$ID."<BR>";

                }
                if(is_string( openssl_encrypt($_POST['nombre'],COD,KEY))){
                    $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                }else{
                    $mensaje.="Upss nombre Error".$NOMBRE."<BR>";

                }
                if(is_string( openssl_encrypt($_POST['precio'],COD,KEY))){
                    $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                }else{
                    $mensaje.="Upss precio Error".$PRECIO."<BR>";

                }
                if(is_string( openssl_encrypt($_POST['cantidad'],COD,KEY))){
                    $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
                }else{
                    $mensaje.="Upss cantidad Error".$CANTIDAD."<BR>";

                }
				// Productos que se agregaran a boleta
				if(is_string( openssl_encrypt($_POST['marca'],COD,KEY))){
                    $MARCA=openssl_decrypt($_POST['marca'],COD,KEY);
                }else{
                    $mensaje.="Upss marca Error".$MARCA."<BR>";

                }
				if(is_string( openssl_encrypt($_POST['desc'],COD,KEY))){
                    $DESC=openssl_decrypt($_POST['desc'],COD,KEY);
                }else{
                    $mensaje.="Upss desc Error".$DESC."<BR>";

                }
                
				// Fin de productos que se agregaran a boleta
                if (!isset($_SESSION['CARRITO'])){
                    $producto=array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'PRECIO'=>$PRECIO,
                        'CANTIDAD'=>$CANTIDAD,
						'MARCA'=>$MARCA,
						'DESC'=>$DESC
                        );

                    $_SESSION['CARRITO'][0]=$producto;
                    $mensaje= print_r('Producto Agregado al Carrito');
                }else{
                    $idProductos=array_column($_SESSION['CARRITO'],"ID");

                if(in_array($ID,$idProductos)){
					foreach ($_SESSION['CARRITO'] as $indice=>$producto){
                        if($producto['ID']==$ID){
                            $_SESSION['CARRITO'][$indice]['CANTIDAD']=$_SESSION['CARRITO'][$indice]['CANTIDAD']+1;
                        }

                    }
                                $mensaje= 'Producto Agregado al Carrito';
                                
                            }else{
                                $NumeroProductos=count($_SESSION['CARRITO']);
                                $producto=array(
                                    'ID'=>$ID,
                                    'NOMBRE'=>$NOMBRE,
                                    'PRECIO'=>$PRECIO,
                                    'CANTIDAD'=>$CANTIDAD,
									'MARCA'=>$MARCA,
									'DESC'=>$DESC
                                    );

                            $_SESSION['CARRITO'][$NumeroProductos]=$producto;
                            $mensaje= 'Producto Agregado al Carrito';
                        }
                    
                }
            break;
            case'Eliminar':
                if(is_string( openssl_encrypt($_POST['id'],COD,KEY))){
                    $ID=openssl_decrypt($_POST['id'],COD,KEY);
                    
                    foreach ($_SESSION['CARRITO'] as $indice=>$producto){
                        if($producto['ID']==$ID){
                            unset($_SESSION['CARRITO'][$indice]);
                            echo "<script>alert(Producto Eliminado....);</script>";
                        }

                    }

                }else{
                    $mensaje.="Upss codigo Error".$ID."<BR>";

                }

            break;
			case 'Empty':
				unset($_SESSION["CARRITO"]);
					break;

        }

    }


?>
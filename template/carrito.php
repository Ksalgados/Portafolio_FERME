<?php
session_start();
$mensaje="";

    if(isset($_POST['btnAction'])){

        switch($_POST['btnAction']){

            case 'Agregar':
                if(is_string( openssl_encrypt($_POST['id'],COD,KEY))){
                    $ID=openssl_decrypt($_POST['id'],COD,KEY);
                    $mensaje.="OK codigo correcto".$ID."<BR>";
                }else{
                    $mensaje.="Upss codigo Error".$ID."<BR>";

                }
                if(is_string( openssl_encrypt($_POST['nombre'],COD,KEY))){
                    $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                    $mensaje.="OK nombre correcto".$NOMBRE."<BR>";
                }else{
                    $mensaje.="Upss nombre Error".$NOMBRE."<BR>";

                }
                if(is_string( openssl_encrypt($_POST['precio'],COD,KEY))){
                    $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                    $mensaje.="OK precio correcto".$PRECIO."<BR>";
                }else{
                    $mensaje.="Upss precio Error".$PRECIO."<BR>";

                }
                if(is_string( openssl_encrypt($_POST['cantidad'],COD,KEY))){
                    $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
                    $mensaje.="OK cantidad correcto".$CANTIDAD."<BR>";
                }else{
                    $mensaje.="Upss cantidad Error".$CANTIDAD."<BR>";

                }

                if (!isset($_SESSION['CARRITO'])){
                    $producto=array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'PRECIO'=>$PRECIO,
                        'CANTIDAD'=>$CANTIDAD
                        );

                    $_SESSION['CARRITO'][0]=$producto;
                    $mensaje= print_r('Producto Agregado al Carrito');
                }else{
                    $idProductos=array_column($_SESSION['CARRITO'],"ID");

                if(in_array($ID,$idProductos)){
                                echo "<script>alert('El Producto ya ha sido seleccionado..'); </script>";
                                
                            }else{
                                $NumeroProductos=count($_SESSION['CARRITO']);
                                $producto=array(
                                    'ID'=>$ID,
                                    'NOMBRE'=>$NOMBRE,
                                    'PRECIO'=>$PRECIO,
                                    'CANTIDAD'=>$CANTIDAD
                                    );

                            $_SESSION['CARRITO'][$NumeroProductos]=$producto;
                            $mensaje= print_r('Producto Agregado al Carrito');
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

        }

    }


?>
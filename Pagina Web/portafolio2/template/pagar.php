<?php
  include '../clases/configuracion.php';
  include 'carrito.php';
  include '../clases/Conexion.php'
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

<?php
if($_POST){
    $total=0;
    $SID=session_id();
    
    foreach ($_SESSION['CARRITO'] as $indice=>$producto){

        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
    }
    echo "<h3>$total</h3>";
}

?>


</body>
</html>
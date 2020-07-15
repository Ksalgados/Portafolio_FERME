<?php
include '../../clases/configuracion.php';
  include '../../clases/Conexion.php';
  include '../../clases/conn.php';
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Ferreteria FERME</title>
    <?php
  include 'emp_links_vist.php';
?>
</head>

<body>
    <?php
  include 'emp_navbar_vist.php';
?>
    <?php
  include 'emp_carrusel_vist.php';
?>
<br><br>
<?php
  include '../../php/destacados.php';
?>
<hr class="featurette-divider">
<div class="col-lg-15">
<center><h2>Lo más vendido</h2></center>
</div>
<br>

    <?php
  include '../../php/galeria.php';
?>
<img src="https://www.sodimac.cl/static/MEJORAS/2020/images/banner-especial-seguridad.jpg" class="img-fluid" alt="Responsive image">

<?php
  include 'emp_footer.php';
?>
</body>

</html>
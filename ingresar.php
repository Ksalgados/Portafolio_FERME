<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'meta.php'; ?>
    <title>Ferreteria FERME</title>
    <?php include 'estilos.php'; ?>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="col-md-5">
        <H2>Ingresar</H2>
    </div>
    <form class="mx-sm-5" method="post">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="rut">Usuario: </label>
                <input type="text" class="form-control" id="inputEmail4" name="user">
            </div>
            <div class="form-group col-md-2">
                <label for="inputPassword4">Contraseña: </label>
                <input type="text" class="form-control" id="inputPassword4" name="contraseña">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="registrar">Ingresar</button>
    </form>
    <?php
        if (isset($_POST['registrar'])){
            $user = $_POST['user'];
            $contraseña = $_POST['contraseña'];
            $Oracle = oci_connect("portafolio", "1234", "localhost/XE");
            $sql = "INSERT INTO cliente VALUES('$rut','$dv','$nom','$ape','$user','$contraseña','$direccion','$telefono','12498326','12520632')";
            $unir = oci_parse($Oracle,$sql);
            oci_execute($unir);
        }
    ?>
</body>

</html>
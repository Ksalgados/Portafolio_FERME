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
        <H2>Registrar Cliente</H2>
    </div>
    <form class="mx-sm-5" method="post">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="rut">Rut: </label>
                <input type="text" class="form-control" id="inputEmail4" name="rut">
            </div>
            <div class="form-group col-md-2">
                <label for="inputPassword4">DV: </label>
                <input type="text" class="form-control" id="inputPassword4" name="dv">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2 ">
                <label for="rut" name="rut">Nombre: </label>
                <input type="text" class="form-control" id="inputEmail4" name="nombre">
            </div>
            <div class="form-group col-md-2">
                <label for="Apellido">Apellido: </label>
                <input type="text" class="form-control" id="inputPassword4" name="apellido">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress">Dirección: </label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="direccion">
            </div>
            <div class="form-group">
                <label for="inputAddress">Teléfono: </label>
                <input type="text" class="form-control" id="inputPassword4" name="telefono">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 ">
                <label for="inputCity">Región</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4 ">
                <label for="inputCity">Ciudad</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Comuna</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputAddress">Usuario: </label>
                <input type="text" class="form-control" id="inputAddress" name="user">
            </div>
            <div class="form-group col-md-2">
                <label for="inputAddress">Contraseña: </label>
                <input type="password" class="form-control" id="inputPassword4" name="contraseña">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
    </form>
    <?php
        if (isset($_POST['registrar'])){
            $rut = $_POST['rut'];
            $dv = $_POST['dv'];
            $nom = $_POST['nombre'];
            $ape = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $user = $_POST['user'];
            $contraseña = $_POST['contraseña'];
            $Oracle = oci_connect("portafolio", "1234", "localhost/XE");
            $sql = "INSERT INTO cliente VALUES('$rut','$dv','$nom','$ape','$user','$contraseña','$direccion','$telefono','12498326','12520632')";
            $unir = oci_parse($Oracle,$sql);
            oci_execute($unir);
            include "creado.php";
        }
    ?>
</body>

</html>
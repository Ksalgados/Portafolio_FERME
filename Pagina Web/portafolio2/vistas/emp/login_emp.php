

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Login Empresa - FERME</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <link href="../../assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="../../css/signin.css" rel="stylesheet">
    <script>
        window.jQuery || document.write('<script src="../../js/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="../../js/modernizr.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
	<script src="../../librerias/jquery-3.2.1.min.js"></script>
	<script src="../../js/funciones.js"></script>
</head>

<body class="text-center">
    <form class="form-signin" id="frmLogin">
        <img class="mb-4" src="https://icon-icons.com/icons2/1090/PNG/72/settings_78352.png" alt="" width="72"
            height="72">
        <h1 class="h3 mb-3 font-weight-normal">Ingreso Empresa</h1>
        <label for="inputEmail" class="sr-only">Usuario</label>
        <input type="text" class="form-control" placeholder="Email" name="usuario" id="user" required autofocus>
        <BR>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" class="form-control" placeholder="Contraseña" name="password" id="pass" required>
        <button class="btn btn-lg btn-primary btn-block" id="entrarSistema">Ingresar</button>
		<button class="btn btn-lg btn-block" type="submit"><a href="emp_registroEmp.php">Registrarse</a></button>
        <br>
        <a href="../../template/Cliente_Empresa.php">Volver</a>
    </form>
</body>

</html>

<script type="text/javascript">
$(document).ready(function() {
    $('#entrarSistema').click(function() {
        vacios = validarFormVacio('frmLogin');
        if (vacios > 0) {
            alert("Debes llenar todos los campos!!");
            return false;
        }
        datos = $('#frmLogin').serialize();
        $.ajax({
            type: "POST",
            data: datos,
            url: "../../procesos/regLogEmp/login.php",
            success: function(r) {
                if (r == 1) {
                    window.location = "emp_inicio.php";
                } else {
                    alert("No se pudo acceder :(");
                }
            }
        });
    });
});
</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="inicio.php">Ferreteria FERME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="ini.php">Productos<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Nosotros
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Quienes Somos</a>
                    <a class="dropdown-item" href="#">Nuestras Tiendas</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Servicio al cliente</a>
                    <a class="dropdown-item" href="#">Preguntas Frecuentes</a>
                </div>
            </li>
            <li class="nav-item">
                <input class="form-control mr-sm-5" type="search" placeholder="Search" aria-label="Search">
            </li>
            <li class="nav-item">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </li>
        </ul>
        <ul class="navbar-nav mr-4">
        <li class="nav-item">
        <form class="form-inline my-1 my-lg-1">
        <a>(<?php
                echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
            ?>)
        </a>
        <a class="btn btn-outline-success my-1 my-sm-0" href="carrito_vist.php" style="background:url(../img/carrito.png) no-repeat; border:none; width:32px; height:32px;" ></a>
        </form>
        </li>
        <li class="nav-item">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['usuario']; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="micuenta.php">Mi Cuenta</a>
                    <a class="dropdown-item" href="../procesos/salir.php">Cerrar Sesion</a>
                </div>
            </div>
        </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" >Ferreteria FERME</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            </li>
        </ul>
        <ul class="navbar-nav mr-4">
        <li class="nav-item">
        </li>
        <li class="nav-item">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['usuario']; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="../../procesos/salir.php">Cerrar Sesion</a>
                </div>
            </div>
        </li>
        </ul>
    </div>
</nav>
<?php session_start();?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">

    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- Encabezado -->
    <nav class="row navbar navbar-expand-md bg-dark text-white p-4">
        <!-- <div class="row justify-content-between border-light"> -->
        <div class="col-sm-12 col-lg-3 col-md-3">
            <a href="index.php" class="text-center">
                <img class="mx-auto d-block" src="images/logo.png" height="100px" alt="">
            </a>
        </div>
        <div class="col-sm-12 col-lg-9 col-md-9">
            <div class="row">
                <div class="col-12">
                    <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars h1 text-info"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <div class="form-inline my-2 mr-auto">
                            <form action="index.php" method="POST">
                                <input class="form-control mr-2" type="text" name="busqueda" placeholder="Ingrese nueva busqueda">
                                <button class="btn btn-outline-light my-2" type="submit">Buscar</button>
                            </form>
                        </div>
                        <div class="mx-5">
                            <a href="carrito.php"><i class="fas fa-shopping-cart h3 mx-3 my-0"></i></a>
                            <?php if(!isset($_SESSION['usuario'])):?>
                                <a href="login.php" class="mr-3 text-white">Iniciar</a>
                                <a href="#" class="mr-3 text-white">Olvide mi contraseña</a>
                                <a href="registro.php" class="text-white">Registrarse</a>
                            <?php else:?>
                            <?php if($_SESSION['usuario']=="admin"):?>
                                <a class="mr-3 text-white" href="administrador.php">Administrar</a>
                            <?php endif?>
                                <a href="perfil.php" class="mr-3 text-white"><?=$_SESSION['usuario']?></a>
                                <a href="cerrar.php" class="text-white">Cerrar sesión</a>
                            <?php endif?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </nav>

    <nav class="row px-4 navbar navbar-expand-md navbar-light bg-info">
        <div class="col-12">
            <!-- <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId2" aria-controls="collapsibleNavId2"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars h1 text-dark"></i>
            </button> -->
            <div class="" id="collapsibleNavId2">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="catalogo.php">Catalogo</a>
                            <a class="dropdown-item" href="contactenos.php">Contactenos</a>
                            <a class="dropdown-item" href="ayuda.php">Ayuda</a>
                            <a class="dropdown-item" href="politica_cambios.php">Politica de cambios</a>
                            <a class="dropdown-item" href="quienes_somos.php">Quienes somos</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
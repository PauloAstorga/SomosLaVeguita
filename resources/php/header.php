<header>
    <div class=" me-0" >
        <nav class="navbar navbar-expand-sm navbar-dark " style="background-color: rgb(111,132,55)" id="navbar">
            <div class="container-fluid">
                 <!-- Logo -->
                <a href="#" class="navbar-brand" style="background-color: rgb(111,132,55)">
                    <img src="resources/images/logo.png" width="150" alt="La Veguita"> 
                </a>
                
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                 <!-- menu  -->
                <div class=" collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">             
                        <a href="index.php" class= "  nav-item nav-link"> Inicio</a></li>
                        <a href="locales.php" class= "  nav-item nav-link"> Locales</a></li>
                        <a href="despacho.php" class= "  nav-item nav-link"> Despacho</a></li>
                        <a href="nosotros.php" class= "  nav-item nav-link"> Nosotros</a></li>
                        <a href="mi-cuenta.php" class= "  nav-item nav-link"> Mi Cuenta</a></li>
                        <?php if(isset($_SESSION['ActiveUser'])) {
                            $persona = $_SESSION['ActiveUser'];
                            if ($persona['id']==35) {
                                echo '<a href="gestion-usuarios.php" class="nav-item nav-link"> Administración</a> ';
                            } else {
                                echo '<a href="carrito.php" class="nav-item nav-link"> <img src="resources/images/carro.png" id="carro" alt="carro"  width="45" height="30" > Carrito</a> ';
                            }
                        } else {
                            echo '<a href="carrito.php" class="nav-item nav-link"> <img src="resources/images/carro.png" id="carro" alt="carro"  width="45" height="30" > Carrito</a> ';
                        }
                        
                        ?>
                        
                    </div>   
                </div>
                
            </div>
        </nav>
    </div> 
</header>
<?php
if (!isset($_SESSION)) {
    session_start();
}
$autenticacion = $_SESSION['login'] ?? false;

if (!isset($inicio)) {
    $inicio = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices MVC</title>
    <link rel="stylesheet" href="/BienesRaicesMVC/public/build/css/app.css">
</head>

<body>
    <!-- con (isset), verificamos si nuetsra variable esta inicializada-->
    <!-- <header class="header <?php echo isset($inicio) ? 'inicio' : ''; ?>" > -->
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/BienesRaicesMVC/public/index.php/">
                    <img src="/BienesRaices/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/BienesRaices/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/BienesRaices/build/img/dark-mode.svg" class="dark-mode-boton">
                    <nav data-cy="navegacion-header" class="navegacion">
                        <a href="nosotros">Nosotros</a>
                        <a href="propiedades">Propiedades</a>
                        <a href="blog">Blog</a>
                        <a href="contacto">Contacto</a>
                        <?php if ($autenticacion) : ?>
                            <a href="logout">Cerrar Sesión</a>
                        <?php endif; ?>
                        <?php if (!$autenticacion) : ?>
                            <a href="login">Iniciar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <!-- Cierre de la barra -->
            <?php echo $inicio ? "<h1 data-cy='heading-site'>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : '' ?>
        </div>
    </header>


    <?php
    echo $contenido;
    ?>


    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav data-cy="navegacion-footer" class="navegacion">
                <a href="nosotros">Nosotros</a>
                <a href="propiedades">Propiedades</a>
                <a href="blog">Blog</a>
                <a href="contacto">Contacto</a>
            </nav>
        </div>

        <?php
        //$fecha = date('d-m-Y');
        // $fecha = date('d-m-y');
        ?>

        <p data-cy="copy-right" class="copyright">Todos los derechos Reservados <?php echo date('Y') ?> &copy;</p>
    </footer>

    <script src="/BienesRaicesMVC/public/build/js/bundle.min.js"></script>
</body>

</html>
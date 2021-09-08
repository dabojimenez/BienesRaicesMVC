<main class="contenedor seccion">
    <h1>Administradro de Bienes Raicess</h1>

    <?php
        if ($resultado) {
            $mensaje = mostrarNotificacion( intval($resultado) );
            if ($mensaje) { ?>
                <p class="alerta exito"> <?php echo sanitizar($mensaje); ?> </p>
            <?php }
        }
    ?>
        
    <a href="../index.php/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="vendedores/crear.php" class="boton boton-amarillo">Nueva Vendedor</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Mostrar los resultados -->
            <?php foreach ($propiedades as $propiedad) :  ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td> <img src="/BienesRaices/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="../index.php/propiedades/eliminar">
                            <!-- el type (hidden), quiere decir que esta oculto, y en este caso ocultaremos el ID -->
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>

                        <a href="../index.php/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
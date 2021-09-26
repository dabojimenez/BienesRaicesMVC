<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>
    <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form method="POST" class="formulario" action="">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>

</main>
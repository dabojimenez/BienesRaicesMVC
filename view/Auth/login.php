<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="head-login">Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div data-cy="alerta-login" class="alerta error"><?php echo $error;?></div>
    <?php endforeach; ?>

    <form data-cy="formulario-login" method="POST" class="formulario" action="">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="Tu E-mail" require>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Tu Password" require>

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>
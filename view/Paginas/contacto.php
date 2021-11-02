<main class="contenedor seccion">
    <h1>Contacto</h1>
<!-- Mostrarmos si el mensaje fue enviado correctamente -->
    <?php if ($mensaje) { ?>
      <p class='alerta exito'> <?php echo $mensaje; ?> </p>
    <?php } ?>

    <picture>
        <source srcset="../build/img/destacada3.webp" type="image/webp">
        <source srcset="../build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="../build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form class="formulario" action="contacto" method="POST">
        <fieldset>
            <legend>Informaicon personal</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" require>

            <!-- <label for="email">E-mail:</label>
            <input type="email" id="email" placeholder="Tu E-mail" name="contacto[email]" require> -->

            <!-- <label for="telefono">Telefono:</label>
            <input type="tel" id="telefono" placeholder="Tu Telefono" name="contacto[telefono]" require> -->

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" require></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre Propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select name="contacto[tipo]" id="opciones" require>
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Venta">Venta</option>
            </select>

            <label for="precio">Precio o Presipuesto:</label>
            <input type="number" id="precio" placeholder="Tu Precio o Presupuesto" name="contacto[precio]" require>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>

            <div>
                <label for="contactar-telefono">Telefono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" require>
                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" require>
            </div>

            <div id="contacto"></div>

            <!-- <p>Si eligio telefono, elija la fecha y la hora</p>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]"> -->
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>
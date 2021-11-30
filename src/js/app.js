document.addEventListener('DOMContentLoaded', function () {

    evenListeners();

    darkMode();

    // //Eliminar texto de confirmación de CRUD en admin/index.php
    // setInterval(function () {
    //     const mensajeConfirm = document.querySelector('.alerta.exito');
    //     const padre = mensajeConfirm.parentElement;
    //     padre.removeChild(mensajeConfirm);
    // }, 3500);
});

function darkMode() {
    //Preferencias del sistema si un tema OSCURO o un tema CLARO
    const prefireDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    //console.log(prefireDarkMode.matches); //Validamos si prefiere un modo OSCURO, nos retorna un booleano

    if (prefireDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    //De manera automatica si tiene hablitado esa opcion
    prefireDarkMode.addEventListener('change', function () {
        if (prefireDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function () {
        //document.body.classList.toggle('dark-mode');
        document.body.classList.toggle('dark-mode');
    });

}

function evenListeners() {

    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click',mostratMetodosContacto));

}

function navegacionResponsive() {

    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar')
    }
    //Este codigo es igual al usar los condicionales if()else
    //navegacion.classList.toggle('mostrar');
}

function mostratMetodosContacto(evento) {
    const contactoDiv = document.querySelector('#contacto');
    if (evento.target.value === 'telefono') {
        contactoDiv.innerHTML = `<br>
            <label for="telefono">Número de Teléfono:</label>
            <input data-cy="input-telefono" type="tel" id="telefono" placeholder="Tu Telefono" name="contacto[telefono]" require>

            <p>Elija la fecha y la hora para la llamada</p>
            <label for="fecha">Fecha:</label>
            <input data-cy="input-fecha" type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input data-cy="input-hora" type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    }else{
        contactoDiv.innerHTML = `
            <label for="email">E-mail:</label>
            <input data-cy="input-email" type="email" id="email" placeholder="Tu E-mail" name="contacto[email]" require>
        `;
    }
    console.log(evento);
}
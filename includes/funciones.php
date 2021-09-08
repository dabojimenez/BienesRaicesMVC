<?php


define('TEMPLATES_URL', __DIR__ . '/templates'); //con (__DIR__),es una super global, tomamos la direccion de nuestro archivo (funciones.php) y lo incluimos en nuestra URL
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
// define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');   // Antigua ruta
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/BienesRaicesMVC/public/imagenes/'); // Desde el servidor, directo del servidro apache o nginx
// define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'] . '/imagenes/'); // cuando lo sirvo desde servidor de php

function includeTemplate(string $nombre, bool $inicio = false)
{

    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(): bool
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /BienesRaices/');
    }
    return false;
}

function debugear($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}
// Escapa   -   Sanitizar el HTML
function sanitizar($html): string
{
    // Sanitizamos ocn la funcion (htmlspecialchars)
    $sanitizado = htmlspecialchars($html);
    return $sanitizado;
}

// Validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    /**Con (in_array()), lo que hacemos e sbuscar un array dentro de un string, toma dos parametros:
     * 1)   LO que vamos a buscar dentro del arreglo
     * 2)   El arreglo sobre el cual vamos a buscar
     * */
    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $URL)
{
    //  Validamos que sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${URL}");
    }

    return $id;
}

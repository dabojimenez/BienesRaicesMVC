<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{

    public static function index(Router $router)
    {

        $propiedades = Propiedad::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('Propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /**Crear una nueva instanci */
            $propiedad = new Propiedad($_POST['propiedad']);

            // $carpetaImagenes = '../../imagenes/';

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // debugear($_FILES['propiedad']['tmp_name']['imagen']);
            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // debugear(CARPETA_IMAGENES);

            // Validar
            $errores = $propiedad->validar();

            if (empty($errores)) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                // debugear(CARPETA_IMAGENES . $nombreImagen);
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                // debugear('HOLA');
                $resultado = $propiedad->guardar();
            }
        }

        $router->render('Propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/BienesRaicesMVC/public/index.php/admin');
        $propiedad = Propiedad::find($id);

        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();
        // Metodo POST para actualizar
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            // NOmbre de la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                // debugear('Cambio de imagen');
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar
            $errores = $propiedad->validar();

            // Ejecutamos el codigo despues de que el usuario envie el formulario
            if (empty($errores)) {
                // ALmacenar la imagen
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('Propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores,
        ]);
    }

    public static function eliminar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //  Obtenemos el valor de nuestra variable, para validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}

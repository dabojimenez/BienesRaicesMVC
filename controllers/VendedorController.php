<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;


class VendedorController
{

    public static function crear(Router $router)
    {
        $vendedor = new Vendedor;

        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Creamos una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);
            // Validamos que no existan campos vacios
            $errores = $vendedor->validar();
            // Si no hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('Vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = Vendedor::getErrores();

        $id = validarORedireccionar('/BienesRaicesMVC/public/index.php/admin');
        // Obtener datos del vendedor a Actualizar
        $vendedor = Vendedor::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['vendedor'];
            // Sincronizar objeto en memoria ocn lo escrito por el usuario
            $vendedor->sincronizar($args);
            // Validar
            $errores = $vendedor->validar();
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('Vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores,
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                // Validar el tipo a eliminar
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}

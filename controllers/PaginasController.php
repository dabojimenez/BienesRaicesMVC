<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;

class PaginasController {

    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('Paginas/index',[
            'propiedades' => $propiedades,
            'inicio'  => $inicio,
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('Paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('Paginas/propiedades',[
            'propiedades' => $propiedades,
        ]);
    }

    public static function propiedad(Router $router)
    {
        // Redireccionamos a la URL, que pasamos como aprametro en el metodo validarORedireccionar
        $id = validarORedireccionar('/BienesRaicesMVC/public/index.php/propiedades');
        // Buscar la propiedad por id
        $propiedad = Propiedad::find($id);
        $router->render('Paginas/propiedad',[
            'propiedad' => $propiedad,
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('Paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('Paginas/entrada');
    }

    public static function contacto(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            debugear($_POST);
        }
        $router->render('Paginas/contacto',[

        ]);
    }
}
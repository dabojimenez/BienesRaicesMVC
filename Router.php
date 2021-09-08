<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $funcion)
    {
        $this->rutasGET[$url] = $funcion;
    }

    public function post($url, $funcion)
    {
        $this->rutasPOST[$url] = $funcion;
    }

    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        
        if ($fn) {
            // Existe la URL y contiene una funcion asociada
            // Usaremos la funcion llamada ( call_user_func ), la cual nos va a pemritir llamar a una función, cuanod no sabemos como se llama la función.
            // Estas fucniones DEBEN ESTAR DEFINIDAS EN EL CONTROLADOR
            call_user_func($fn,$this);
        }else{
            echo "Pagina no encontrada";
        }
    }

    // Muetsra una vista
    public function render($view, $datos = [])
    {
        // Accedemos a los datos, de un arreglo asociativo
        foreach($datos as $key => $value){
            // Este dobe signo de ($$), significa variable de variable, quiere decir que genera variables con el nombre del key del arrrreglo sin perder su valor
            $$key = $value;
        }
        
        // Con (ob_start), inicializamos un almacenamiento en memoria durante un momento, para guardar los datos o vistas que le pasamos a continuacion del metodo
        ob_start();
        include __DIR__ . "/view/$view.php";
        // con (ob_get_clean), limpiamos la memoria, pero debemos incluir depsues del metodo, nuestra MASTERPAGE
        // limpiamos el buffer
        $contenido = ob_get_clean();
        include __DIR__ . "/view/layout.php";
    }
}
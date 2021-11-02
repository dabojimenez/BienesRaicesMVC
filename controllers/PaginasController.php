<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

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

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $respuestas = $_POST['contacto'];
            

            // Crear una nueva isntancia de PHPMailer
            $mail = new PHPMailer();
            // Configurar SMTP
            $mail->isSMTP();//Declaramso que usaremos SMTP para el envio de correos
            $mail->Host = 'smtp.mailtrap.io';// Colocamos el host que tomamos de la configuracion se nuestro servidor de correo
            $mail->SMTPAuth = true;//   Cambiandole al estado (true), mencioanmos que nos vamos a autenticar
            $mail->Port = 2525;
            $mail->Username = '9ed69977202438';
            $mail->Password = '7f072daa9b1ffd';
            $mail->SMTPSecure = 'tls';//    Ahora le agregamos seguridad, no encriptados pero van por un tunel seguro, (Transport Layer Security), antes se usaba el (ssl)
            

            // Configurar el contenido del e-mail
            $mail->setFrom('admin@bienesraices.com');// Colocamos el email de quien nos esta contactando
            $mail->addAddress('admin@bienesraices.com','BienesRaices.com');//    La direccion donde se va a resibir
            $mail->Subject = "Tienes un Nuevo Mensaje";//  Lo primero que el usuario va a leer cuando le llegue el mail

            // Habilitamos HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el Contendio
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo Mensaje </p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';

            // Enviar de forma condicional el email o telefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por teléfono:</p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora contacto: ' . $respuestas['hora'] . '</p>';
            }else {
                // Es email, agregamos los campos del email
                $contenido .= '<p>Eligió ser contactado por email:</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }            
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';            
            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = "Este es contenido alterno pero sin HTML";
            // debugear($mail->send());

            // Enviar el email
            if($mail->send()){// El metodo ( send ), retorna true o false
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar...";
            }
        }
        
        $router->render('Paginas/contacto',[
            'mensaje' => $mensaje,
        ]);
        
    }
}
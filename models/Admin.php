<?php

namespace Model;

class Admin extends ActiveRecord {
    // Base de datos
    protected static $tabla = "usuarios";
    protected static $columnasBD = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($argumentos = [])
    {
        $this->id = $argumentos['id'] ?? null;
        $this->email = $argumentos['email'] ?? "";
        $this->password = $argumentos['password'] ?? "";
    }

    public function validar (){
        if (!$this->email) {
            self::$errores[] = "El email es Obligatorio";
        }

        if (!$this->password) {
            self::$errores[] = "El password es Obligatorio";
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        // Revisamos si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email. "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'El Usuario no existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object();
        /**Con ( password_verify ), comporbamos si un password esta bien , toma dos parametros
         * 1) Passwor a comparar
         * 2) EL password almacenado en la base de datos
         * Y retorna un booleano
         * */ 
        $autenticado = password_verify($this->password, $usuario->password);
        if (!$autenticado) {
            self::$errores[] = "El Password es incorrecto";
        }
        return $autenticado;
    }

    public function autenticarUsuario()
    {
        session_start();
        
        // Llenamos el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /BienesRaicesMVC/public/index.php/admin');
    }
}
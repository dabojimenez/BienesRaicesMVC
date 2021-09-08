<?php

require __DIR__ . '/funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//  Conectar a la base de datos
$db = coneccionBD();

use Model\ActiveRecord;

ActiveRecord::setDB($db);
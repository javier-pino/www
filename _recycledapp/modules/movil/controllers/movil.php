<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: movil.php
 * Descripción del archivo :
 *
 * Autor:
 * Fecha: 02/08/2012
 */

class Movil extends TD_Login_Controller {

    /** Función de prueba */
    public function index() {

        //Valida que el usuario esté logueado
        //$this->need_login();
        var_dump('Usuario Logueado', $this->get_login_user());
        echo $this->alternative_url;
    }
}

/* Fin de archivo movil.php */
/* Ubicación: */

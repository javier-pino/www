<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: Php_session.php
 *
 * Descripción del archivo :
 * Esta clase se creó con el fin de acceder a la variable session de php,
 * con el solo fin de modificar variables en  tudescuenton
 *
 * Obtenido en:
 * http://www.moreofless.co.uk/using-native-php-sessions-with-codeigniter/#comment-1343
 * 
 * Autor: Javier Pino
 * Fecha: 27/07/2012
 * 
 */
class Php_session
{
    public function __construct()
    {
        session_start();
    }

    public function set( $key, $value )
    {
        $_SESSION[$key] = $value;
    }

    public function get( $key )
    {
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : false;
    }

    public function regenerateId( $delOld = false )
    {
        session_regenerate_id( $delOld );
    }

    public function delete( $key )
    {
        unset( $_SESSION[$key] );
    }
}

/* Fin de archivo Php_session.php */

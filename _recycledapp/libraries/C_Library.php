<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: C_Library.php
 *
 * Descripción del archivo : 
 * Esta clase carga por feceto el objeto codeigniter y los asigna a la variable
 * CId
 *
 * Esta clase genera los métodos mágicos de php
 * para evitar llamadas muy complicadas a lo largo de las clases, a elementos
 * como doctrine
 *
 * Sustituye invocaciones de tipo $this->CI-> por simples $this->
 * Así mismo, hace los set, con $this->CI->doctrine =
 *
 * Este archivo no debe ser modificado, en caso de requerir funcionalidades
 * adicionales, implementar otra.
 * 
 * Autor: Javier Pino
 * Fecha: 25/07/2012
 */

class C_Library {

    //Instancia de CodeIgniter necesaria para esta libreria
    private $CI;

    //Se enumeran las propiedades para tenerlas por tipos

    /** Constructor de esta clase */
    function __construct()
    {       
        $this->CI =& get_instance();
    }

    /**
     * Alias de función, creada para agilizar las llamadas a cualquier elemento
     * de la instancia de CI,
     *
     * Evita el uso de cosas como: $this->CI-> y los sustituye por la sintaxis
     * de los controladores
     */
    public function __get($k=null) {
        if (isset($this->CI->$k))
            return $this->CI->$k;
        return null;
    }

}

/* Fin de archivo C_Library.php */

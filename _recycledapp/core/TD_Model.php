<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: TD_Model.php
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

/** Esta clase permite crear modelos que carguen las variables de la base de datos  */
class TD_Model extends CI_Model {

    //Actualmente esta vacia, puesto que aqui se sobrescribió y se deshicieron los cambios
    
}
/* Fin de archivo TD_Model.php */

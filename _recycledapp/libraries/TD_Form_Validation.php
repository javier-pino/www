<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: FormValidation.php
 * Descripción del archivo :
 *
 * Autor:
 * Fecha: 08/08/2012
 */

class TD_Form_validation extends CI_Form_validation{
    
    function run($module = '', $group = ''){
        (is_object($module)) AND $this->CI = &$module;
            return parent::run($group);
    }

    /** Esta función agrega al formulario, una validacion adicional además de
     * entregar un mensaje formateado
     */
    public function is_date($str)
    {
        $date = explode('/', $str);

        $day = isset ($date[0]) && is_numeric($date[0]) ? $date[0] : 0;
        $month = isset($date[1]) && is_numeric($date[1]) ? $date[1] : 0;
        $year = isset ($date[2]) && is_numeric($date[2]) ? $date[2] : 0;
        $valid_date = checkdate($month, $day, $year);
        if (!$valid_date) {            
            return FALSE;
        }
        return TRUE;
    }
    
}

/* Fin de archivo FormValidation.php */
/* Ubicación: */

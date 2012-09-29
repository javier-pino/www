<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: category.php
 * Descripción del archivo :
 * Este archivo maneja algunas de las operaciones relacionadas con las categorias
 * de tudescuenton
 *
 * Autor: Javier Pino
 * Fecha: 08/08/2012
 */
class Municipio extends TD_Model {

    /** Listar las ciudades disponibles */
    public function get_municipios_caracas() {

        //Buscar las ciudades
        $query_cities = $this->qb
                ->select('m,e')
                ->from('models\Municipio', 'm')
                ->join('m.idestado', 'e')
                ->where("e.idestado in (24, 14)")
                ->orderBy('e.idestado', 'desc')
                ->addOrderBy('m.nombre', 'asc')
                ->getQuery();

        //Arreglo de resultados
        $result = array();
        try {                
            $result = $query_cities->getResult();   
        } catch (Exception $e) {
            var_dump($e);
        }
        return $result;
    }
    
}

/* Fin de archivo category.php */
/* Ubicación: */



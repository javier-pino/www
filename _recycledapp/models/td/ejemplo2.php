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
class Category extends TD_Model {

    /** Listar las ciudades disponibles */
    public function get_all_cities() {

        //Buscar las ciudades
        $query_cities = $this->qb
                ->select('c')
                ->from('models\Category', 'c')
                ->where("c.zone = 'city'")
                ->orderBy('c.id')
                ->getQuery();

        //Arreglo de resultados
        $result = array();
        try {
            $result = $query_cities->getResult();
        } catch (Exception $e) { }
        return $result;
    }  
}

/* Fin de archivo category.php */
/* Ubicación: */

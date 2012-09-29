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

    //Declaro las propiedades con tipo, para que sea el tipo adecuado y netbeans
    //pueda detectarlas

    /**
     * @var Doctrine\ORM\EntityManager
     */
    public $em = null;

    /**
     * @var \Doctrine\ORM\QueryBuilder
     */
    public $qb = null;

    /** Contruye el objeto con las funciones de base de datos ya cargadas,
     * ademas de haber determinado el dispositivo */
    public function  __construct()
    {
        parent::__construct();
        
        //Instantiate a Doctrine Entity Manager, Querybuilder, Database
        $this->load->database();
        $this->em = $this->doctrine->em;
        $this->qb = $this->em->createQueryBuilder();
    }
}
/* Fin de archivo TD_Model.php */

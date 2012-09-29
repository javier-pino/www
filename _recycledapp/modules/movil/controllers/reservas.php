<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Archivo: reservas.php
 *
 * Descripción del archivo :
 * Controlador de móvil para reservas
 *
 * Implementando: https://github.com/philsturgeon/codeigniter-restserver#responses
 * Autor: Javier Pino
 * Fecha: 27/07/2012
 */
class Reservas extends TD_Device_Controller {

    public function index() {
    var_dump($this->alternative_url);
    var_dump($this->device_storage->retrieveDeviceInfo());
    var_dump('Preferencia', $this->device_storage->retrieveDevicePreference());

    $this->load->helper('url');
    $this->load->library('user_agent');
    echo 'Referer '.anchor($this->agent->referrer());

    echo 'Alternativa  '.anchor($this->alternative_url);
    echo anchor ($this->session->flashdata('previous_url'));
    die;
    }
}
/* Fin de archivo reservas.php */
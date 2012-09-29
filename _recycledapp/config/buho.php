<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: buho.php
 * Descripción del archivo:
 * Archivo de configuración del buho para tudescuentón
 *
 * Autor: Javier Pino
 * Fecha: 23/07/2012
 */

//Link para conectarse con elBuho
$config['url'] = '184.72.213.236';

//Cliente tu descuenton para el buho
$config['client_name'] = 'TUDESCUENTON';

//Clave a utilizar por el cliente
$config['client_password'] = 'ue7mv1nh3ajkd';

//Método de conexión con el buho
$config['method'] = 'post';

// A continuación, los métodos y sus direcciones
$config['address_login'] = 'http://'.$config['url'].'/elbuho/index.php/elbuho_api/loging/login';
$config['address_create'] = 'http://'.$config['url'].'/elbuho/index.php/elbuho_api/creation/create';



/* Fin de archivo buho.php */
/* Ubicación: */

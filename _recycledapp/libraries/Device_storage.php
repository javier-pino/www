<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Descripción de la clase : Maneja el almacenamiento en sesión de la información
 * del dispositivo seleccionado
 *
 * Autor: Javier Pino
 * Fecha: 25/04/2012
 */

class Device_Storage extends C_Library {

    /** Inicializa esta clase*/
    public function  __construct() {
        
        parent::__construct();
        $this->config->load('device'); //Cargar la configuracion
    }


    /** Devuelve la información del dispositivo, desde caché */
    public function retrieveDeviceInfo ()
    {        
        $device_info = $this->session->userdata('device_info');
        if ($device_info === FALSE || !$device_info instanceof Device_detect) {

            //Calcular el user agent
            $agent = $this->load->library('user_agent');
            $agent = $this->agent->agent_string();

            //Crear o traerse la información del dispositivo
            $device_info = $this->load->library('device_detect', array('user_agent' => $agent));

            //Almacenar en cache la información            
            self::storeDeviceInfo($device_info);         
        }        
        return $device_info;
    }

    /** Almacena en caché la información del dispositivo*/
    private function storeDeviceInfo(Device_detect $device_info)
    {
        $device_info = $this->session->set_userdata('device_info', $device_info);
    }

    /** Almacena la preferencia del usuario en un cookie */
    public function storeDevicePreference($mobile) {
        
        $next_day = 86400;

        //Debe expirar al mes siguiente        
        $cookie = array(
            'name'   => '421a_device_preference',
            'value'  => $mobile,
            'expire' => $next_day,
            'path'   => '/',
        );        
        $this->input->set_cookie($cookie);
    }


    /** Devuelve la preferencia del usuario del tipo de dispositivo*/
    public function retrieveDevicePreference() {

        //Buscar en la variable de sesión
        $device_info = $this->input->cookie('421a_device_preference');
        if ($device_info === FALSE) //En caso de que aun no se haya determinada
        {
            $device_info = $this->config->item('NO_PREFERENCE');
        } else
        {
            if ($device_info != $this->config->item('NO_PREFERENCE')
                   &&  $device_info != $this->config->item('MOBILE_PREFERENCE')
                    && $device_info != $this->config->item('DESKTOP_PREFERENCE')
            ) $device_info = $this->config->item('NO_PREFERENCE');
        }

        //Guardar la preferencia del usuario
        self::storeDevicePreference($device_info);
        return $device_info;
    }

    /**
     * Indica si debe usarse o no, la versión móvil de la aplicación
     * Tomando en cuenta el resultado de retrieveDevicePreference y RetriveDevicePreference*/
    public function useMobile() {

        //Obtener la información para tomar la decisión
        $device_preference = self::retrieveDevicePreference();
        $device_info = self::retrieveDeviceInfo();

        //Determinar cual utilizar
        if ($device_info->is_mobile())  {
            if ($device_preference == $this->config->item('DESKTOP_PREFERENCE')) {
                return false;
            } else {
                return true;
            }
        } else {
            if ($device_preference == $this->config->item('MOBILE_PREFERENCE')) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    } 
}

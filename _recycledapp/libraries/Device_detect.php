<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH. 'libraries/TeraWurfl/TeraWurfl.php');

/**
 * Utilizando Terawulf determina el dispositivo del usuario
 */
class Device_Detect {

    public $is_mobile = FALSE;
    public $is_desktop = TRUE;


    /** Constructor de la clase
     * Donde params debe ser un arreglo que contenga user_agent
     */
    public function __construct($params)
    {
        // instantiate the Tera-WURFL object
        $tera =  new TeraWurfl();
       
        /* Get the capabilities of the current client. Here the available capabilities
        // http://wurfl.sourceforge.net/help_doc.php */
        
        $tera->getDeviceCapabilitiesFromAgent($params['user_agent']);
        if ($tera->getDeviceCapability("is_wireless_device")
                || $tera->getDeviceCapability("is_tablet")) {
            $this->is_mobile = TRUE;
            $this->is_desktop = FALSE;
        } else {
            $this->is_mobile = FALSE;
            $this->is_desktop = TRUE;
        }
    }

    /** Indica si el dispositivo es móvil */
    public function is_mobile() {
        return $this->is_mobile;        
    }

    /** Indica si el dispositivo el desktop*/
    public function is_desktop() {
        return $this->is_desktop;
    }



    
}
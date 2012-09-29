<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
  Documento   : error
  Creado en : 29/09/2012, 03:21:48 PM
  Autor     : Javier Pino
  Descripción: Sirve para manejar los mensajes de manera más efectiva
 */
class Session_Messages extends C_Library {

    /** Esta función almacena mensajes de informacion para mostrarlos correctamente */
    public function set_message($message) {
        
        if ($message == '') return;
        
        $this->session->set_userdata(
            'flash_message',                   
            '<h3><span class="ui-icon ui-icon-info" style="float: left; margin: 0 10px 0 10px;"></span>'
            .$message
            .'</h3>'                 
        );
        
    }

    /** Esta función almacena mensajes de error para mostrarlos correctamente */
    public function set_error($error) {
        
        if ($error == '') return;
        $this->session->set_userdata(
            'flash_error',                   
            '<h3><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 10px 0 10px;"></span>'
            .$error
            .'</h3>'                 
        );        
    }

    /** Esta función trae los mensajes de informacion que están seteados en el sistema */
    public function get_message () {
        
        
        $message = $this->session->userdata('flash_message');
        $this->session->unset_userdata('flash_message');
        return $message;
    }

    /** Esta función trae los mensajes de error que están seteados en el sistema */
    public function get_error() {
        
        $message = $this->session->userdata('flash_error');
        $this->session->unset_userdata('flash_error');
        return $message;
    }
}








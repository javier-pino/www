<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Escritorio extends TD_Role_Controller {
	
    public function index() {     
        
        //Se garantiza que el usuario esté logueado
        $this->need_login();                
        $this->data['title'] = $this->client_name . ' - Escritorio';
        $this->data['header'] = 'Escritorio';
        
        $this->load_as_content('escritorio');        
        
    }
}

/* End of file welcome.php */


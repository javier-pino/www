<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
  Documento   : sesion
  Creado en : 15/09/2012, 09:45:08 PM
  Autor     : Javier Pino
  Descripción: Este controlador maneja lo referente al inicio de sesión
 */
class Sesion extends TD_Controller {
         
    /** Esta función inicia la sesión del usuario */
    public function iniciar () {
        
        //Si el usuario ha iniciado sesión previamente, entonces no hace falta
        $login_user_id = $this->session->userdata('login_user_id');
        if ($login_user_id)
            redirect (base_url ('escritorio'));
        
        //En caso contrario seguir el proceso
        
        //Cargar las variables de la vista                
        $this->data['client_name'] = $this->client_name;
        $this->data['title'] = $this->client_name . ' - Iniciar Sesión';

        //Cargar el formulario y sus atributos
        $this->load->helper('form');
        $this->data['form_info'] = array(
            'class' => 'ui-body ui-body-b ui-corner-all',
            'id' => 'registrar_usuario');
 
        $this->data['form_action'] = 'usuarios/sesion/iniciar';
        
        $this->data['form_input'] = array(         
            'login' => array(
                'type' => "text",
                'name' => "login",
                'id' => "login",                
                'value' => set_value('login'),
                'placeholder' => "Identificador (Login)",
                'required' => true,
                'style' => "width:99%;height:25px"
            ),            
            'password' => array(
                'type' => "password",
                'name' => "password",
                'id' => "password",
                'value' => set_value('password'),
                'placeholder' => "Ingrese su contraseña",                
                'required' => true,
                'style' => "width:99%;height:25px",                
            ),            
            'remember_me' => array(
                'type' => "checkbox",
                'name' => "remember_me",
                'id' => "remember_me",
                'value' => "1",
                'checked' => set_value('remember_me') == '1' ? TRUE : FALSE,
            ),
            'submit' => array(
                'type' => "submit",                
                'content' => "Registrarme"
            ),
            'reset' => array(
                'type' => "reset",                
                'content' => "Limpiar Formulario"
            )
        );

        //Validar el formulario, en caso de que no pase la prueba o no exista mostrarlo
        $this->load->library('form_validation');

        //Crear las reglas        
        $this->form_validation->set_rules("login", '"Identificador"', "required|max_length[60]");       
        $this->form_validation->set_rules("password", '"Contraseña"', "required|min_length[8]|max_length[32]");
        $this->form_validation->set_rules('submit',  '"Iniciar Sesión"', 'callback_login_check');               
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        
        //Verificar el seguimiento de las reglas
        if ($this->form_validation->run($this) == FALSE)
        {
            //En caso de fracaso mostrar el formulario nuevamente                        
            $data = array();
            $data['title'] = $this->client_name . ' - Iniciar Sesión';
            $this->load->view('sesion/iniciar', $this->data);                       
        }
        else
        {
            //Inicia la cuenta del usuario
            $this->load->model('Cadena/user');            
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');   
            $this->user->Login($login, $password, $remember_me);
            
            //Envia al usuario a su escritorio
            redirect(base_url('escritorio'));
            
        }        
    }
    
    /** 
     * Esta función agrega al formulario, una validacion adicional además de
     * entregar un mensaje formateado
     */
    public function login_check($str)
    {
        $login = $this->input->post('login');
        $password = $this->input->post('password');                
        $this->load->model('Cadena/user');        
        if (!$this->user->verifyLogin($login, $password)) {
            $this->form_validation->set_message('login_check', 
            'Error en el ingreso: Verifique el usuario y contraseña especificado');
            return FALSE;
        }
        return TRUE;
    }    
        
    /** Esta función cierra la sesión del usuario */
    public function cerrar () {        
        $this->load->model('Cadena/user');        
        $this->user->Logout();            
        $this->user->forgetLogin();            
        redirect (base_url ('usuarios/sesion/iniciar'));        
    }
}


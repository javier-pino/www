<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
  Documento   : usuarios
  Creado en : 21/09/2012, 01:25:29 AM
  Autor     : Javier Pino
  Descripción: Esta clase mantiene los controladores y las acciones que refieren a los
  roles
 */
class Roles extends TD_Role_Controller {

    /** Función encargada de listar roles de usuario dando un link para su edición*/
    public function index() {
        
        
    }
    
    /** Función encargada de crear roles de usuario */
    public function crear() {
        
        $this->need_role_authorization();

        //Cargar las variables de la vista                
        $this->data['title'] = $this->client_name . ' - Crear Rol';
        $this->data['header'] = 'Crear Rol';

        //Cargar el formulario y sus atributos
        $this->load->helper('form');
        $this->data['form_info'] = array(
            'id' => 'crear_usuario');

        $this->data['form_action'] = 'usuarios/roles/crear';

        $this->data['form_input'] = array(
            'finder' => array(
                'type' => "text",
                'name' => "finder",
                'id' => "finder",
                'value' => set_value('finder'),
                'placeholder' => "Ej: asistente_ventas",
                'required' => true,  
                'max_length' => '60'
            ),
            'name' => array(
                'type' => "text",
                'name' => "name",
                'id' => "name",
                'value' => set_value('name'),
                'placeholder' => "Ej: Asistente de Ventas",
                'required' => true,  
                'max_length' => '60'
            ),
            'description' => array(                
                'name' => "description",
                'id' => "description",
                'value' => set_value('description'),
                'placeholder' => "Ej: Este rol se encarga de la creación de órdenes de venta",
                'required' => true,  
                'rows' => 20,
                'cols' => 20                
            ),                 
            'submit' => array(
                'type' => "submit",
                'content' => "Registrar",
                'name' => "Registrar"
            ),
            'reset' => array(
                'type' => "reset",
                'content' => "Limpiar Formulario",
                'name' => "Limpiar Formulario"
                
            )
        );        
        
        //Listar los permisos posibles
        $this->load->model('Cadena/role');
        $windows = $this->role->get_all_windows();

        //Agregar al arreglo de los inputs, la información a mostrar
        foreach ($windows as $window) {
            
            $name = str_replace('/', '_', $window->getDocumentdir());            
            
            $this->data["form_input"]["window"][] =                                        
                    array(
                        'row' => $window,
                        'input' =>                 
                            array(                                
                                'name' => "window[{$name}]",
                                'id' => "window[{$name}]",                                
                                'value'=> $window->getAdWindowId(),
                                'checked' => ( isset( $_POST["window"][$name] ) ? TRUE : FALSE),
                            )
                    );                   
        }
        
        //Validar el formulario, en caso de que no pase la prueba o no exista mostrarlo
        $this->load->library('form_validation');

        //Crear las reglas                
        $this->form_validation->set_rules("finder",'"Clave de Búsqueda"', "required|max_length[60]|is_unique[ad_role.finder]");
        $this->form_validation->set_rules("name",'"Nombre del rol"', "required|max_length[60]");
        $this->form_validation->set_rules("description",'"Descripción del rol"', "required|max_length[255]");
        $this->form_validation->set_error_delimiters('<p>', '</p>');
                
        //Verificar el seguimiento de las reglas
        if ($this->form_validation->run($this) == FALSE ) {
            
            //Almacenar los errores                   
            $this->session_messages->set_error(validation_errors());
            
            //En caso de fracaso mostrar el formulario nuevamente                        
            $data = array();
            $data['title'] = $this->client_name . ' - Crear Rol';
            $this->load_as_content('roles/crear');
            
        } else {            
            
            //Aquí debe registrarse el rol                        
            $this->load->model('Cadena/role');
            $success = $this->role->create_role_with_permissions($this->login_user_id);            
            if ($success) {
                redirect(base_url('usuarios/roles/editar'));
            } else {
                redirect(base_url('escritorio'));
            }            
        }        
    }
    
}


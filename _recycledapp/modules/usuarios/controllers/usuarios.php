<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
  Documento   : usuarios
  Creado en : 14/09/2012, 01:25:29 AM
  Autor     : Javier Pino
  Descripción: Esta clase mantiene los controladores y las acciones que refieren a los
  usuarios
 */
class Usuarios extends TD_Role_Controller {
 
    public function index() {
        
        //Nivel de seguridad
        $this->need_role_authorization();
        
        //Setear variables
        $this->data['title'] = $this->client_name . ' - Listar Usuarios';        
        $this->data['header'] = 'Listar Usuarios';
        
        $this->qb = $this->em->createQueryBuilder();
        $query = $this->qb->select('ur, u, r')
                ->from('Entities\ADUserRoles', 'ur')
                ->join('ur.adUser', 'u')
                ->join('ur.adRole', 'r')
                ->orderBy('r.name, u.name')
                ->getQuery();
        
       //Procesar el resultado
       $this->data['listar'] = array(); 
       try {        
           $users_roles = $query->getResult();           
           foreach ($users_roles as $one) {
                $rol = $one->getAdRole();
                $user = $one->getAdUser();
                $this->data['listar'][$rol->getName()][] = $user;                                
           }
       } catch (Exception $e) {}                     
       $this->load_as_content('usuarios/listar');
    }
    
    /** Función encargada de crear roles de usuario */
    public function crear() {
        
        $this->need_role_authorization();

        //Cargar las variables de la vista                
        $this->data['title'] = $this->client_name . ' - Crear Usuario';
        $this->data['header'] = 'Crear Usuario';

        //Cargar el formulario y sus atributos
        $this->load->helper('form');
        $this->data['form_info'] = array(
            'id' => 'crear_usuario'
        );

        $this->data['form_action'] = 'usuarios/usuarios/crear';
        
        
        //Precargar la información de los roles preexistentes
        $this->load->model('Cadena/role');
        $roles = $this->role->get_all_roles();
        die;
        
        $this->data['form_input'] = array(
            'login' => array(
                'type' => "text",
                'name' => "login",
                'id' => "login",
                'value' => set_value('login'),
                'placeholder' => "Ej: jpino, cvillanueva",
                'required' => true,  
                'max_length' => '60'
            ),
            'name' => array(
                'type' => "text",
                'name' => "name",
                'id' => "name",
                'value' => set_value('name'),
                'placeholder' => "Ej: Javier Pino, Carlos Villanueva",
                'required' => true,  
                'max_length' => '60'
            ),
            'password' => array(
                'type' => "password",
                'name' => "password",
                'id' => "password",
                'value' => set_value('password'),                
                'required' => true,  
                'max_length' => '10'
            ),            
            'description' => array(                
                'name' => "description",
                'id' => "description",
                'value' => set_value('description'),
                'placeholder' => "Ej: Texto descriptivo del usuario",
                'required' => true,  
                'rows' => 20,
                'cols' => 20                
            ),                 
            'comments' => array(                
                'name' => "comments",
                'id' => "comments",
                'value' => set_value('comments'),
                'placeholder' => "Ej: El usuario fue ascendido de cargo, y se modificó su acceso a un nuevo rol",
                'required' => false,  
                'rows' => 20,
                'cols' => 20                
            ),                             
            'email' => array(
                'type' => "email",
                'name' => "email",
                'id' => "email",
                'value' => set_value('email'),
                'placeholder' => "Ej: j.pinobetancourt@gmail.com, cvillanueva@gmail.com",
                'required' => true,  
                'max_length' => '255'
            ),                                   
            'birthday' => array(
                'class' => 'text',
                'type' => "text",
                'name' => "birthday",
                'id' => "birthday",
                'value' => set_value('birthday'),
                'placeholder' => "Ej: 23/08/1984",
                'required' => true,  
                'max_length' => '10'
            ),                 
            'phone' => array(
                'class' => 'text',
                'type' => "text",
                'name' => "phone",
                'id' => "phone",
                'value' => set_value('phone'),
                'placeholder' => "Ej: (0416) 010 72 83",
                'required' => true,  
                'max_length' => '20'
            ),
            'phone2' => array(
                'class' => 'text',
                'type' => "text",
                'name' => "phone2",
                'id' => "phone2",
                'value' => set_value('phone2'),
                'placeholder' => "Ej: (0416) 000-0000",
                'required' => true,  
                'max_length' => '20'
            ),            
            'submit' => array(
                'type' => "submit",
                'content' => "Registrarme",
                'name' => "Registrarme"
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
        $this->form_validation->set_rules("login",'"Usuario"', "required|max_length[60]|is_unique[ad_user.login]");
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
    
    /** 
     * Esta función verifica que el rol creado, tenga acceso a al menos una ventana
     */
    public function municipio_check($str)
    {
        $city_id = $this->input->post('permisssion');
        $city_input = $this->input->post('city_input');
        $city_select = $this->input->post('city_select');
                
        if ($city_id != '1' && $city_input == '') {
            $this->form_validation->set_message('municipio_check', 'El campo "Municipio" es obligatorio');
            return FALSE;
        }        
        return TRUE;        
    }

}


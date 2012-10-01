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

        $this->load->model('Cadena/user');
        $all_users = $this->user->list_all_users();

        //Procesar el resultado
        $this->data['listar'] = array();                   
        foreach ($all_users as $one) {                
             $this->data['listar'][$one->Name_role][] = $one ;                                
        }                
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
                'rows' => 20,
                'cols' => 20                
            ),                 
            'comments' => array(                
                'name' => "comments",
                'id' => "comments",
                'value' => set_value('comments'),
                'placeholder' => "Ej: El usuario fue ascendido de cargo, y se modificó su acceso a un nuevo rol",                
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
                'class' => 'date',
                'type' => "text",
                'name' => "birthday",
                'id' => "birthday",
                'value' => set_value('birthday'),
                'placeholder' => "Ej: 23/08/1974",
                'required' => true,  
                'max_length' => '10'
            ),                 
            'phone' => array(                
                'type' => "text",
                'name' => "phone",
                'id' => "phone",
                'value' => set_value('phone'),
                'placeholder' => "Ej: (0416) 000 00 00",
                'required' => true,  
                'max_length' => '20'
            ),
            'phone2' => array(                
                'type' => "text",
                'name' => "phone2",
                'id' => "phone2",
                'value' => set_value('phone2'),
                'placeholder' => "Ej: (0416) 000-0000",
                'required' => true,  
                'max_length' => '20'
            ),            
            'roles' => $roles,
            'selected_id_hidden' => array (
                'type' => 'hidden',
                'name' => "selected_id_hidden",
                'id' => "selected_id_hidden",
                'value' => set_value('selected_id_hidden')
            ),
            'selected_value_hidden' => array (
                'type' => 'hidden',
                'name' => "selected_value_hidden",
                'id' => "selected_value_hidden",
                'value' => set_value('selected_value_hidden')
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
        
        //Validar el formulario, en caso de que no pase la prueba o no exista mostrarlo
        $this->load->library('form_validation');

        //Crear las reglas                       
        $this->form_validation->set_rules("login",'"Usuario"', "required|min_length[5]|max_length[60]|is_unique[ad_user.login]");
        $this->form_validation->set_rules("name",'"Nombre Completo"', "required|max_length[60]");
        $this->form_validation->set_rules("password",'"Contraseña"', "required|min_lenght[5]|max_length[10]");
        $this->form_validation->set_rules("description",'"Descripción"', "max_length[255]");
        $this->form_validation->set_rules("email",'"Correo Electrónico"', "max_length[255]|valid_email");
        $this->form_validation->set_rules("phone",'"Teléfono"', "max_length[20]");
        $this->form_validation->set_rules("phone2",'"Teléfono Adicional"', "max_length[20]");
        $this->form_validation->set_rules("birthday",'"Fecha de Nacimiento"', "max_length[10]|is_date");
        $this->form_validation->set_rules("selected_value_hidden",'"Rol de Acceso"', "required");                
        $this->form_validation->set_error_delimiters('<p>', '</p>');
                
        //Verificar el seguimiento de las reglas
        if ($this->form_validation->run($this) == FALSE ) {
            
            //Almacenar los errores                   
            $this->session_messages->set_error(validation_errors());
            
            //En caso de fracaso mostrar el formulario nuevamente                                    
            $this->load_as_content('usuario/crear');
            
        } else {            
                       
            //Aquí debe registrarse el rol                        
            $this->load->model('Cadena/user');                        
            $success = $this->user->create_user_with_role($this->login_user_id);            
            
            if ($success) {
                redirect(base_url('escritorio'));
            } else {
                redirect(base_url('escritorio'));
            }            
        }        
    }
    
    /** Función encargada de crear roles de usuario */
    public function editar($ad_user_id = NULL) {
                
        $this->need_role_authorization();
        
        if (!$ad_user_id) {            
            $this->session_messages->set_error('Operación incorrecta. No se indicó el usuario a editar');
            redirect(base_url('usuarios/usuarios/'));
        }
        
        //Precargar la información de los roles preexistentes
        $this->load->model('Cadena/role');
        $roles = $this->role->get_all_roles();
        
        //Precargar la información
        $this->load->model('Cadena/user');
        $user = $this->user->find_user_and_role($ad_user_id);
                        
        //Si la accion a realizar es eliminar al usuario, proceder sin validar        
        if ($this->input->post('delete'))  {            
            
            $success = $this->user->delete_user($this->login_user_id);            
            if ($success) {
                redirect(base_url('usuarios/usuarios/'));
            } else {
                redirect(base_url('usuarios/usuarios/editar/' . $ad_user_id));
            }            
            
        }
        
        //Cargar las variables de la vista                
        $this->data['title'] = $this->client_name . ' - Editar Usuario';
        $this->data['header'] = 'Editar Usuario';

        //Cargar el formulario y sus atributos
        $this->load->helper('form');
        $this->data['form_info'] = array(
            'id' => 'editar_usuario'
        );

        $this->data['form_action'] = 'usuarios/usuarios/editar/' . $ad_user_id;
                
        //Preformat birthday
        if (!set_value('birthday')) {
            $birthday = $user->Birthday;
            $date = explode('-', $birthday);
            $birthday = $date[2] .'/'.$date[1]. '/' .$date[0];            
        } else {
            $birthday = set_value('birthday');
        }
        
        $this->data['form_input'] = array(
            'id' => array (
                'type' => 'hidden',
                'name' => "id",
                'id' => "id",
                'value' => (set_value('id') ? set_value('id') : $user->ID)
            ),
            'login' => array(
                'type' => "text",
                'name' => "login",
                'id' => "login",
                'value' => (set_value('login') ? set_value('login') : $user->Login),
                'placeholder' => "Ej: jpino, cvillanueva",
                'required' => true,  
                'max_length' => '60',                
            ),
            'name' => array(
                'type' => "text",
                'name' => "name",
                'id' => "name",
                'value' => (set_value('name') ? set_value('name') : $user->Name_user),
                'placeholder' => "Ej: Javier Pino, Carlos Villanueva",
                'required' => true,  
                'max_length' => '60'
            ),
            'password' => array(
                'type' => "password",
                'name' => "password",
                'id' => "password",
                
                'max_length' => '10'
            ),                        
            'password' => array(
                'type' => "password",
                'name' => "password",
                'id' => "password",
                'value' => (set_value('password') ? set_value('password') : ''),                                
                'placeholder' => "Ingrese la contraseña si desea modificarla",        
            ),
            'password2' => array(
                'type' => "password",
                'name' => "password2",
                'id' => "password2",
                'value' => (set_value('password2') ? set_value('password2') : ''),                                
                'placeholder' => "Confirme el cambio de contraseña",
        
            ),            
            'description' => array(                
                'name' => "description",
                'id' => "description",
                'value' => (set_value('description') ? set_value('description') : $user->Desc_user),
                'placeholder' => "Ej: Texto descriptivo del usuario",                
                'rows' => 20,
                'cols' => 20                
            ),                 
            'comments' => array(                
                'name' => "comments",
                'id' => "comments",
                'value' => (set_value('comments') ? set_value('comments') : $user->Comments),
                'placeholder' => "Ej: El usuario fue ascendido de cargo, y se modificó su acceso a un nuevo rol",                
                'rows' => 20,
                'cols' => 20                
            ),                             
            'email' => array(
                'type' => "email",
                'name' => "email",
                'id' => "email",
                'value' => (set_value('email') ? set_value('email') : $user->Email),
                'placeholder' => "Ej: j.pinobetancourt@gmail.com, cvillanueva@gmail.com",
                'required' => true,  
                'max_length' => '255'
            ),                                   
            'birthday' => array(
                'class' => 'date',
                'type' => "text",
                'name' => "birthday",
                'id' => "birthday",
                'value' => $birthday,
                'placeholder' => "Ej: 23/08/1974",
                'required' => true,  
                'max_length' => '10'
            ),                 
            'phone' => array(                
                'type' => "text",
                'name' => "phone",
                'id' => "phone",
                'value' => (set_value('phone') ? set_value('phone') : $user->Phone),
                'placeholder' => "Ej: (0416) 000 00 00",
                'required' => true,  
                'max_length' => '20'
            ),
            'phone2' => array(                
                'type' => "text",
                'name' => "phone2",
                'id' => "phone2",
                'value' => (set_value('phone2') ? set_value('phone2') : $user->Phone2),
                'placeholder' => "Ej: (0416) 000-0000",
                'required' => true,  
                'max_length' => '20'
            ),            
            'roles' => $roles,
            'selected_id_hidden' => array (
                'type' => 'hidden',
                'name' => "selected_id_hidden",
                'id' => "selected_id_hidden",
                'value' => (set_value('selected_id_hidden') ? 
                    set_value('selected_id_hidden') : 'selectable_'.$user->AD_Role_ID),
            ),
            'selected_value_hidden' => array (
                'type' => 'hidden',
                'name' => "selected_value_hidden",
                'id' => "selected_value_hidden",
                'value' => (set_value('selected_value_hidden') ? set_value('selected_value_hidden') : $user->AD_Role_ID),
            ),
            'submit' => array(
                'type' => "submit",
                'content' => "Actualizar Usuario",
                'name' => "Actualizar Usuario"
            ),
            'reset' => array(
                'type' => "reset",
                'content' => "Limpiar Formulario",
                'name' => "Limpiar Formulario"
                
            ),
            'delete' => array(
                'type' => "submit",
                'class' => 'delete',                
                'content' => "Eliminar Usuario",
                'name' => "delete",                
                'value' => TRUE
            )
        );                        
        
        //Validar el formulario, en caso de que no pase la prueba o no exista mostrarlo
        $this->load->library('form_validation');

        //Crear las reglas                       
        $this->form_validation->set_rules("login",'"Usuario"', "required|min_length[5]|max_length[60]|callback_login_check[$ad_user_id]");
        $this->form_validation->set_rules("name",'"Nombre Completo"', "required|max_length[60]");
        $this->form_validation->set_rules("password",'"Contraseña"', "min_lenght[5]|max_length[10]|callback_password_check");                
        $this->form_validation->set_rules("password2",  '"Confirme Contraseña"', "matches[password]");       
        $this->form_validation->set_rules("description",'"Descripción"', "max_length[255]");
        $this->form_validation->set_rules("email",'"Correo Electrónico"', "max_length[255]|valid_email");
        $this->form_validation->set_rules("phone",'"Teléfono"', "max_length[20]");
        $this->form_validation->set_rules("phone2",'"Teléfono Adicional"', "max_length[20]");
        $this->form_validation->set_rules("birthday",'"Fecha de Nacimiento"', "max_length[10]|is_date");
        $this->form_validation->set_rules("selected_value_hidden",'"Rol de Acceso"', "required");                        
        $this->form_validation->set_error_delimiters('<p>', '</p>');
                        
        //Verificar el seguimiento de las reglas
        if ($this->form_validation->run($this) == FALSE ) {
            
            //Almacenar los errores                   
            $this->session_messages->set_error(validation_errors());
            
            //En caso de fracaso mostrar el formulario nuevamente                                    
            $this->load_as_content('usuario/editar');
            
        } else {            
                       
            //Aquí debe registrarse el rol                        
            $this->load->model('Cadena/user');                        
            $success = $this->user->update_user_with_role($this->login_user_id);            
            
            if ($success) {
                redirect(base_url('usuarios/usuarios/editar/' . $ad_user_id ));
            } else {
                redirect(base_url('usuarios/usuarios/editar/' . $ad_user_id ));
            }
        }        
    }    
    
    /** 
     * Esta función agrega al formulario, una validacion adicional además de
     * entregar un mensaje formateado
     */
    public function login_check($str, $ad_user_id)
    {                
        //Validar que no haya otro usuario con el mismo login
        $this->load->model('Cadena/user');
        $repetition = $this->user->is_repeated_login ($str, $ad_user_id);        
        if ($repetition) {
            $this->form_validation->set_message('login_check', 
                    'Ya existe un registro en el sistema con el valor: "' . $str . '" en el campo: "Usuario"');
            return FALSE;
        }
        return TRUE;        
    }
    
    /** 
     * Esta función agrega al formulario, una validacion adicional además de
     * entregar un mensaje formateado
     */
    public function password_check($str)
    {                
        //Validar que no haya otro usuario con el mismo login\
        $p = $this->input->post('password');
        $p2 = $this->input->post('password2');
        
        if ($p || $p2) {            
            if ((strlen($p) < 5) || (strlen($p) > 10)) {
                $this->form_validation->set_message('password_check', 
                    'El campo "Contraseña" debe tener entre 5 y 10 caracteres');
                return FALSE;
            }
            
            if ($p != $p2 ) {
                $this->form_validation->set_message('password_check', 
                    'El campo "Contraseña"  y "Confirmar Contraseña" deben coincidir');
                return FALSE;
            }
        }        
        return TRUE;        
    }
    
}

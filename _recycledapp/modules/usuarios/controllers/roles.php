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
        
        //Nivel de seguridad
        $this->need_role_authorization();

        //Setear variables
        $this->data['title'] = $this->client_name . ' - Listar Roles';        
        $this->data['header'] = 'Listar Roles';
        
        $this->load->model('Cadena/role');
        $all_users = $this->role->get_all_roles();

        //Procesar el resultado
        $this->data['listar'] = array();                   
        foreach ($all_users as $one) {                            
            
             //Para cada rol, obtener los módulos a los que tiene acceso
             $windows = $this->role->get_allowed_ad_windows($one);
             foreach ($windows as $module => $window) {
                 $one->Modules .= $module . ' - ';                 
             }
             
             $one->Users = array();
             $users = $this->role->get_users_with_role($one->AD_Role_ID);
             foreach ($users as $user) {
                 $one->Users[] = $user;                 
             }
             $this->data['listar'][] = $one ;                                            
        }                
        $this->load_as_content('roles/listar');        
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
            
            $name = str_replace('/', '_', $window->DocumentDir);
            
            $this->data["form_input"]["window"][] =                                        
                    array(
                        'row' => $window,
                        'input' =>                 
                            array(                                
                                'name' => "window[{$name}]",
                                'id' => "window[{$name}]",                                
                                'value'=> $window->AD_Window_ID,
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
                redirect(base_url('usuarios/roles/'));
            } else {
                redirect(base_url('escritorio'));
            }            
        }        
    }
    
    /** Función encargada de editar roles de usuario */
    public function editar($ad_role_id = NULL) {
        
        $this->need_role_authorization();

        if (!$ad_role_id) {            
            $this->session_messages->set_error('Operación incorrecta. No se indicó el rol a editar');
            redirect(base_url('usuarios/roles/'));
        }
        
        //Precargar la información
        $this->load->model('Cadena/role');
        $user = $this->role->find_role($ad_role_id);
        
        if (!$user) {            
            $this->session_messages->set_error('Operación incorrecta. No se encontró el rol a editar');
            redirect(base_url('usuarios/roles/'));
        }        
                        
        //Si la accion a realizar es eliminar al usuario, proceder sin validar        
        if ($this->input->post('delete'))  {                        
            redirect(base_url('usuarios/roles/eliminar/' . $ad_role_id));            
        }
               
        //Cargar las variables de la vista                
        $this->data['title'] = $this->client_name . ' - Editar Rol de Usuario';
        $this->data['header'] = 'Editar Rol de Usuario';

        //Cargar el formulario y sus atributos
        $this->load->helper('form');
        $this->data['form_info'] = array(
            'id' => 'editar_rol');

        $this->data['form_action'] = 'usuarios/roles/editar/' . $ad_role_id;
                        
        $this->data['form_input'] = array(
            'id' => array (
                'type' => 'hidden',
                'name' => "id",
                'id' => "id",
                'value' => (set_value('id') ? set_value('id') : $user->AD_Role_ID)
            ),
            'finder' => array(
                'type' => "text",
                'name' => "finder",
                'id' => "finder",
                'value' => (set_value('finder') ? set_value('finder') : $user->Finder),
                'placeholder' => "Ej: asistente_ventas",
                'required' => true,  
                'max_length' => '60'
            ),
            'name' => array(
                'type' => "text",
                'name' => "name",
                'id' => "name",
                'value' => (set_value('name') ? set_value('name') : $user->Name),
                'placeholder' => "Ej: Asistente de Ventas",
                'required' => true,  
                'max_length' => '60'
            ),
            'description' => array(                
                'name' => "description",
                'id' => "description",                
                'value' => (set_value('description') ? set_value('description') : $user->Description),
                'placeholder' => "Ej: Este rol se encarga de la creación de órdenes de venta",
                'required' => true,  
                'rows' => 20,
                'cols' => 20                
            ),                 
            'submit' => array(
                'type' => "submit",
                'content' => "Actualizar Rol",
                'name' => "Registrar"
            ),
            'reset' => array(
                'type' => "reset",
                'content' => "Limpiar Formulario",
                'name' => "Limpiar Formulario"                
            ),
            'delete' => array(
                'type' => "submit",
                'class' => 'delete',                
                'content' => "Eliminar Rol",
                'name' => "delete",                
                'value' => TRUE
            )
        );        
        
        //Listar los permisos posibles
        $this->load->model('Cadena/role');
        $windows_allowed = $this->role->get_all_windows_for_role($ad_role_id);
        $windows = $this->role->get_all_windows();
        
        //Agregar al arreglo de los inputs, la información a mostrar        
        foreach ($windows as $id => $window) {            
            $name = str_replace('/', '_', $window->DocumentDir);            
            
            $checked = FALSE;                        
            if (isset( $_POST["window"])) {                
                if (isset( $_POST["window"][$name])) {
                    $checked = TRUE;
                }
            } else {
                if (isset($windows_allowed[$id])) {
                    $checked = TRUE;
                }
            }            
            $this->data["form_input"]["window"][] =                                        
                    array(
                        'row' => $window,
                        'input' =>                 
                            array(                                
                                'name' => "window[{$name}]",
                                'id' => "window[{$name}]",                                
                                'value'=> $window->AD_Window_ID,
                                'checked' => $checked,
                            )
                    );                   
        }
                        
        //Validar el formulario, en caso de que no pase la prueba o no exista mostrarlo
        $this->load->library('form_validation');

        //Crear las reglas                
        $this->form_validation->set_rules("finder",'"Clave de Búsqueda"', "required|max_length[60]|callback_finder_check[$ad_role_id]");
        $this->form_validation->set_rules("name",'"Nombre del rol"', "required|max_length[60]");
        $this->form_validation->set_rules("description",'"Descripción del rol"', "required|max_length[255]");
        $this->form_validation->set_error_delimiters('<p>', '</p>');
                
        //Verificar el seguimiento de las reglas
        if ($this->form_validation->run($this) == FALSE ) {
            
            //Almacenar los errores                   
            $this->session_messages->set_error(validation_errors());
            
            //En caso de fracaso mostrar el formulario nuevamente                                                
            $this->load_as_content('roles/editar');
            
        } else {            
            
            //Aquí debe registrarse el rol                                    
            $success = $this->role->update_role_with_permissions($this->login_user_id);                        
            if ($success) {
                redirect(base_url('usuarios/roles/editar/' . $ad_role_id ));
            } else {
                redirect(base_url('usuarios/roles/editar/' . $ad_role_id ));
            }            
        }        
    }
    
    /** 
     * Esta función agrega al formulario, una validacion adicional además de
     * entregar un mensaje formateado
     */
    public function finder_check($str, $ad_role_id)
    {                
        //Validar que no haya otro usuario con el mismo login
        $this->load->model('Cadena/role');
        $repetition = $this->role->is_repeated_finder ($str, $ad_role_id);        
        if ($repetition) {
            $this->form_validation->set_message('finder_check', 
                    'Ya existe un registro en el sistema con el valor: "' . $str . '" en el campo: "Clave de Búsqueda"');
            return FALSE;
        }
        return TRUE;        
    }

    /** Función encargada de eliminar usuarios */
    public function eliminar($ad_role_id = NULL) {
        
        $this->need_role_authorization();

        //Si recibe esta variable por get, significa que solo se desea eliminar dicho registro
        if ($ad_role_id) {
            
            //Eliminarlo
            $this->load->model('Cadena/role');
            $success = $this->role->delete_role($this->login_user_id, $ad_role_id);                                                 
            if ($success) {
                redirect(base_url('usuarios/roles/'));
            } else {
                redirect(base_url('usuarios/roles/'));
            }                       
        }

        //Cargar las variables de la vista                
        $this->data['title'] = $this->client_name . ' - Eliminar Roles';
        $this->data['header'] = 'Eliminar Roles';

        //Cargar el formulario y sus atributos
        $this->load->helper('form');
        $this->data['form_info'] = array(
            'id' => 'eliminar_roles');

        $this->data['form_action'] = 'usuarios/roles/eliminar';

        $this->data['form_input'] = array(
            'delete' => array(
                'type' => "submit",
                'class' => 'delete',                
                'content' => "Eliminar Roles",
                'name' => "delete",                
                'value' => TRUE
             ), 
            'reset' => array(
                'type' => "reset",
                'content' => "Limpiar Formulario",
                'name' => "Limpiar Formulario"                
            )
        );        
        
        $this->load->model('Cadena/role');
        $roles = $this->role->get_all_roles();
        
        //Eliminar aquellos roles que no estén activos
        foreach ($roles as $key => $role) {
            if (!$role->Is_Active) 
                unset ($roles[$key]);                
        }

        //Procesar el resultado
        $this->data['listar'] = array();                   
        foreach ($roles as $one) {                            
            
             //Para cada rol, obtener los módulos a los que tiene acceso
             $windows = $this->role->get_allowed_ad_windows($one);
             foreach ($windows as $module => $window) {
                 $one->Modules .= $module . ' - ';                 
             }
             
             $one->Users = array();
             $users = $this->role->get_users_with_role($one->AD_Role_ID);
             foreach ($users as $user) {
                 $one->Users[] = $user;                 
             }
             
             $one->Input = array(                                
                                'name' => "role[{$one->AD_Role_ID}]",
                                'id' => "role[{$one->AD_Role_ID}]",                                
                                'value'=> $one->AD_Role_ID,
                                'checked' => ( isset( $_POST["role"][$one->AD_Role_ID] ) ? TRUE : FALSE)
                            );
             $this->data['listar'][] = $one ;                                            
        }                
                
        //Validar el formulario, en caso de que no pase la prueba o no exista mostrarlo                
        $post_roles = isset($_POST['role']) ? $_POST['role'] : NULL ;            
        if (!$post_roles) {                        
            $data = array();
            $data['title'] = $this->client_name . ' - Crear Rol';
            $this->load_as_content('roles/eliminar');            
        } else {            
                    
            //Proceder a eliminar todos aquellos roles seleccionados                        
            $this->load->model('Cadena/role');
            
            $success = TRUE;
            foreach ($post_roles as $ad_role_id) {
                $success &= $this->role->delete_role($this->login_user_id, $ad_role_id);                                                 
                if (!$success) 
                    break;
            }
            
            if ($success) {
                redirect(base_url('usuarios/roles/eliminar'));
            } else {
                redirect(base_url('usuarios/roles/eliminar'));
            }                         
        }        
        
    }    
    
}


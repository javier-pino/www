<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: user.php
 * Descripción del archivo :
 * Modelo de codeigniter que realiza las operaciones con la entidad
 * user para account
 *
 * Autor: Javier Pino
 * Fecha: 01/08/2012
 */

class User Extends TD_Model {
      
    public function verifyLogin($login, $password) {        
        
        $result = 0;
        
        //Buscar el usuario y contraseña        
        $this->db->from('AD_User u')
                ->where(
                    array(
                        'Login' => $login,
                        'Password' => md5($password),
                        'Is_Active' => TRUE
                    )
                );        
        try {                                       
            $result = $this->db->count_all_results();                      
        } catch ( Exception $e) {}               
                             
        if ($result > 0) 
            return TRUE;
        else 
            return FALSE;
        
    }
    
    /** Esta función logue al usuario en el sistema
     * Retorna el id del usuario logueado   
     */ 
    public function Login($login, $password, $remember, $cookie) {
        
        $ad_users = array();
        
        //Buscar el usuario y contraseña        
        $this->db->from('AD_User u')
                ->where(array(
                        'Login' => $login,
                        'Password' => ($cookie ? $password : md5($password)),                
                        'Is_Active' => TRUE
                ));        
        try {                                       
            $query = $this->db->get();           
            $ad_users = $query->result();            
        } catch ( Exception $e) {}               
        
        if (!empty($ad_users))  {           
            //Iniciar sesion en code igniter
            $user = $ad_users[0];                  
            $this->session->set_userdata('login_user_id', $user->AD_User_ID);                                    
            if ($remember) {
                $this->rememberLogin($login, $password);
            }                        
        } else {
            show_error('No es posible iniciar sesión en el sistema con los datos especificados');
        }         
        return $user->AD_User_ID;
    }
    
    /** Recuerda al usuario, guardando su sesión en una cookie */
    public function rememberLogin($login, $password) {

        //Guardar cookies
        $value = $login . '@'. md5($password);
        $value = base64_encode($value);
        $cookie = array(
            'name'   => '421a_ru',
            'value'  => $value,
            'expire' => 30*86400,
            'path'   => '/',
        );
        $this->load->helper('cookie');
        $this->input->set_cookie($cookie);
    }

    /** Olvida al usuario, borrando su cookie */
    public function forgetLogin() {
        $this->load->helper('cookie');
        delete_cookie('421a_ru');
    }
    
    /** Cierra la sesión del usuario borrandolo de la sesión */
    public function Logout() {
        $this->session->unset_userdata('login_user_id');            
    }    
        
    /** Esta función crea un rol y le asigna aquellos permisos */
    public function create_user_with_role($login_user_id) {
        
        $time = date('Y-m-d H:i:s', time());        
        $birthday = NULL;
        
        //Si se especificó la fecha de nacimiento
        if ($this->input->post('birthday')) {
            $birthday = $this->input->post('birthday');
            $birthday = str_replace('/', '-', $birthday);
            $birthday = strtotime($birthday);
            $birthday = date('Y-m-d H:i:s', $birthday);
        }
        
        //Se crea el usuario con los datos especificados
        $ad_user = array(        
            
            'Login' => ($this->input->post('login') ? $this->input->post('login') : ''),
            'Name' => ($this->input->post('name') ? $this->input->post('name') : ''),            
            'Password' => ($this->input->post('password') ? md5($this->input->post('password')) : ''),           
            'Description' => ($this->input->post('description') ? $this->input->post('description') : ''),
            'Comments' => ($this->input->post('comments') ? $this->input->post('comments') : ''),            
            'Email' => ($this->input->post('email') ? $this->input->post('email') : ''),            
            'Phone' => ($this->input->post('phone') ? $this->input->post('phone') : ''),                        
            'Phone2' => ($this->input->post('phone2') ? $this->input->post('phone2') : ''),                       
            'Birthday' => $birthday,                                  
            'Created' => $time,
            'CreatedBy' => $login_user_id,
            'Updated' => $time,
            'UpdatedBy' =>  $login_user_id,  
        );
        
        $inserted = FALSE;        
        try {
            $inserted = $this->db->insert('ad_user', $ad_user);                                    
        } catch ( Exception $e ) {}
        
        if (!$inserted) {
            $this->session_messages->set_error('Ocurrió un error al registrar el usuario nuevo'); 
            return FALSE;
        }
        
        $ad_user_id = $this->db->insert_id();        
                
        //Se garantiza la presencia del rol        
        $ad_role_id = $this->input->post('selected_value_hidden');
                
        //Para cada una de las ventanas agregar el permiso al rol        
        $ad_user_roles = array(
            'AD_Role_ID' => $ad_role_id,
            'AD_User_ID' => $ad_user_id,
            'Created' => $time,
            'CreatedBy' => $login_user_id,
            'Updated' => $time,
            'UpdatedBy' =>  $login_user_id,  
        );

        $inserted = FALSE;        
        try {                                         
            $inserted = $this->db->insert('ad_user_roles', $ad_user_roles);
        } catch ( Exception $e ) {}
        if (!$inserted) {
            $this->session_messages->set_error('Ocurrió un error al guardar el rol del usuario'); 
            return FALSE;
        }                                        
        $this->session_messages->set_message('Usuario creado exitosamente'); 
        return TRUE;
    }    
    
    public function update_user_with_role($login_user_id) {
        
        //Este campo siempre existe
        $ad_role_id = $this->input->post('selected_value_hidden');
        $ad_user_id = $this->input->post('id');
        
        //Validar, antes de eliminar que exista el usuario
        $this->another_admin_exist($ad_user_id, $ad_role_id);
        
        die;
        
        $time = date('Y-m-d H:i:s', time());        
        $birthday = NULL;
        
        //Si se especificó la fecha de nacimiento
        if ($this->input->post('birthday')) {
            $birthday = $this->input->post('birthday');
            $birthday = str_replace('/', '-', $birthday);
            $birthday = strtotime($birthday);
            $birthday = date('Y-m-d H:i:s', $birthday);
        }
        
        
        
        //Se actualiza al usuario con los datos especificados
        $ad_user = array(                    
            'Login' => ($this->input->post('login') ? $this->input->post('login') : ''),
            'Name' => ($this->input->post('name') ? $this->input->post('name') : ''),                        
            'Description' => ($this->input->post('description') ? $this->input->post('description') : ''),
            'Comments' => ($this->input->post('comments') ? $this->input->post('comments') : ''),            
            'Email' => ($this->input->post('email') ? $this->input->post('email') : ''),            
            'Phone' => ($this->input->post('phone') ? $this->input->post('phone') : ''),                        
            'Phone2' => ($this->input->post('phone2') ? $this->input->post('phone2') : ''),                       
            'Birthday' => $birthday,                                  
            'Updated' => $time,
            'UpdatedBy' =>  $login_user_id,  
        );
        
        //Se asume que el controlador validó
        if ($this->input->post('password')) {
            $ad_user['Password'] = md5($this->input->post('password'));                 
        }   
        
        //Se actualiza en la base de datos
        $inserted = FALSE;        
        try {
            $this->db->where('ad_user_id', $ad_user_id);
            $inserted = $this->db->update('ad_user', $ad_user); 
        } catch ( Exception $e ) {}
                
        if (!$inserted) {
            $this->session_messages->set_error('Ocurrió un error al actualizar el registro'); 
            return FALSE;
        }
        
        //Actualizar el rol
        $ad_user_roles = array(        
            'AD_Role_ID' => $ad_role_id,            
            'Updated' => $time,
            'UpdatedBy' =>  $login_user_id,  
        );
        
        $inserted = FALSE;        
        try {
            $this->db->where(array(                
                'AD_User_ID' => $ad_user_id,                                
            ));
            $inserted = $this->db->update('ad_user_roles', $ad_user_roles);             
            echo $this->db->last_query();
        } catch ( Exception $e ) {}
                        
        if (!$inserted) {
            $this->session_messages->set_error('Ocurrió un error al guardar el rol del usuario'); 
            return FALSE;
        }
                
        $this->session_messages->set_message('Usuario actualizado exitosamente'); 
        return TRUE;
    }    
    
    /** 
     * Esta función elimina los usuarios de las base de datos
     */
    public function delete_user($login_user_id, $ad_user_id) {
        
        //Validar, antes de eliminar que exista el usuario
        $this->another_admin_exist($ad_user_id);
               
        $time = date('Y-m-d H:i:s', time());        
         
        //Se actualiza al usuario con los datos especificados
        $ad_user = array(                    
            'Is_Active' => FALSE,            
            'Updated' => $time,
            'UpdatedBy' =>  $login_user_id,  
        );
        
        //Se actualiza en la base de datos
        $inserted = FALSE;        
        try {            
            $this->db->where('ad_user_id', $ad_user_id);
            $inserted = $this->db->update('ad_user', $ad_user);                         
        } catch ( Exception $e ) {}
                
        if (!$inserted) {
            $this->session_messages->set_error('Ocurrió un error al eliminar el registro'); 
            return FALSE;
        }
        
        $this->session_messages->set_message('Usuario eliminado exitosamente'); 
        return TRUE;
    }
       
    /** Esta función lista los usuarios, con sus roles */
    public function list_all_users () {
        
        $this->db->select('u.AD_User_ID ID, u.Login, u.Name Name_user, u.Description Desc_user, ' .
            'u.Comments, u.Email, u.Phone, u.Phone2, u.Birthday, u.Is_Active, ' .
            'a.AD_Role_ID, a.Finder, a.Name Name_role, a.Description Desc_role'
        );
        $this->db->from('ad_user u');
        $this->db->join('ad_user_roles ur', 'u.ad_user_id = ur.ad_user_id');
        $this->db->join('ad_role a', 'a.ad_role_id = ur.ad_role_id');                
        try {
            $query = $this->db->get();                                
            $result = $query->result();                    
        } catch ( Exception $e) {}        
        return $result;
    }
       
    /** Dado un id de usuario, busca al usuario en la base de datos */
    public function find_user_and_role ($ad_user_id) {
        
        $this->db
                ->select('u.AD_User_ID ID, u.Login, u.Name Name_user, u.Description Desc_user, '.
                    'u.Comments, u.Email, u.Phone, u.Phone2,'.
                    "u.Birthday ,ur.AD_Role_ID")
                ->from('ad_user u')
                ->join('ad_user_roles ur', 'u.ad_user_id = ur.ad_user_id')
                ->where(array('u.ad_user_id' => $ad_user_id) )
                ;                        
        try {
            $query = $this->db->get();                                
            $result = $query->result(); 
            if (empty($result))
                return NULL;
            else {
                return $result[0];
            }            
        } catch ( Exception $e) {}        
        return NULL;                
    }
    
    /** Dado un id de usuario, busca al usuario en la base de datos */
    public function is_repeated_login ($login, $ad_user_id) {
                       
        $this->db
                ->select('u.AD_User_ID ID')
                ->from('ad_user u')                
                ->where(array(
                        'u.AD_User_ID !=' => $ad_user_id,
                        'u.Login' => $login,                        
                       ));                       
        try {                        
            if ($this->db->count_all_results() > 0)
                return TRUE;
            else {
                return FALSE;
            }            
        } catch ( Exception $e) {}        
        return FALSE;                
    }
    
    /** Esta función valida que en el sistema, siempre exista un usuario admin*/
    public function another_admin_exist ($ad_user_id, $new_ad_role_id = NULL) {
        
        //Buscar el rol actual, y si es admin, antes de quitarle el rol validar que exista otro usuario                       
        $old_user = $this->find_user_and_role($ad_user_id);
        
        $this->load->model('Cadena/role');        
        $old_role = $this->role->getUserRole ($old_user);
        
        if (!$new_ad_role_id) {
            $new_role = NULL;
        } else {
            $old_user->AD_Role_ID = $new_ad_role_id;
            $new_role = $this->role->getUserRole ($old_user);
        }
        
        $validate_others_admin = FALSE;
        
        //Si el rol viejo es admin, y el nuevo lo intenta cambias.
        if ($old_role->Finder == 'admin') {            
            
            //Si el rol es distinto de null, quiere decir que se está editando, sino está eliminando
            if ($new_role != NULL) {
                //Se está editando
                                
                if ($old_role->Finder != $new_role->Finder) {
                    //Si el rol cambió, entonces debe validarse que exista un reemplazo
                    $validate_others_admin = TRUE;                    
                }                            
            } else {
                //Se está eliminando
                $validate_others_admin = TRUE;
            }
        }
        
        $another_admin = FALSE;
        //Buscar otros usuarios con el rol de administracion              
        if ($validate_others_admin) {            
            $admin_users = $this->role->get_users_with_role($old_role->AD_Role_ID);
            
            //Validar que exista algun otro usuario que tenga el rol admin
            foreach ($admin_users as $admin) {                
                               
                //Validar que dichos usuarios al menos uno esté activo,                                 
                if ($admin->AD_User_ID == $old_user->ID) {                    
                    continue;
                } else if ($admin->Is_Active == '1') {
                    $another_admin = TRUE;
                    continue;
                }
            }            
        }
                
        //Si tocaba validar y no hay otro usuario administrador
        if ($validate_others_admin && !$another_admin) {
            ECHO 'NO HAY OTRO ADMIN';
            return FALSE;            
        }
        
        'HAY OTRO ADMIN O NO TOCABA VALIDAR';
        return TRUE;        
    }
        
     
}

/* Fin de archivo user.php */
/* Ubicación: */

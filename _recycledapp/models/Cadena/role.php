<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo: role.php
 * Descripción del archivo :
 * Modelo de codeigniter que realiza las operaciones con la entidad
 * user para account
 *
 * Autor: Javier Pino
 * Fecha: 01/08/2012
 */

class Role Extends TD_Model {

    /** Esta función permite encontrar el rol asociado a un usuario */
    public function getUserRole (stdClass $adUser) {
        
        $result = NULL;                               
        $this->db->from('AD_Role')
                 ->where(array('AD_Role_ID' => $adUser->AD_Role_ID));
        try {
            $query = $this->db->get();                                
            $result = $query->result();                                
            if (!empty($result)) {
                $result = $result[0];
            }
        } catch ( Exception $e) {}        
        return $result;                
    }

    /** Esta función indica si el rol puede acceder a la ventana solicitada */
    public function isAuthorizedRole (stdClass $role) {
                
        //Verificar si el rol tiene acceso al url                
        $document_dir = $this->get_ad_window(); 
                
        $this->db->from('AD_Role_Windows rw')
                ->join('AD_Window w', 'w.AD_Window_ID = rw.AD_Window_ID')                
                 ->where(array(
                     'rw.AD_Role_ID' => $role->AD_Role_ID,
                     'w.DocumentDir' => $document_dir,                                          
                ));
        try {
            $query = $this->db->get();
            $result = $query->result();                                            
            if (!empty($result)) {
                return TRUE;
            }
        } catch ( Exception $e) {}        
        return FALSE;                        
    }

    /** Obtener el url de la ventana que se desea acceder */
    private function get_ad_window() {

        $this->load->helper('url');                
        $url = $this->uri->segment(1) . '/';        
        if ($this->uri->segment(2)) {
            $url .= $this->uri->segment(2). '/';
        } else {
            $url .= $url;
        }
        if ($this->uri->segment(3)) {
            $url .= $this->uri->segment(3);
        }        
        return $url;
    }
    
    /** Esta función retorna las ventanas disponibles para el rol que se ha conectado */
    public function get_allowed_ad_windows (stdClass $ad_role) {         
                
        //Como se tiene el rol, se buscan las ventanas existentes asociadas             
        $result = array();        
                
        $this->db->select('w.*')
                ->from('AD_Role_Windows rw')
                ->join('AD_Window w', 'w.AD_Window_ID = rw.AD_Window_ID')                
                 ->where(array(
                     'rw.AD_Role_ID' => $ad_role->AD_Role_ID,
                     "w.class !=" => 'edit'
                ));
        try {
            $query = $this->db->get();
            $result_temp = $query->result();   
             
            //Si tiene un rol asociado buscarlo
            foreach ($result_temp as $res) {                
                $result[$res->Module][] = $res;
            }
            
        } catch ( Exception $e) {}                
        return $result;        
    }
    
    /** Esta función retorna todas las posibles ventanas para un rol*/
    public function get_all_windows () {         
                        
        $result = array();    
        
        $this->db->select('w.*')
                 ->from('AD_Window w')                 
                 ->order_by("w.Module", "asc")
                 ->order_by("w.Name", "asc");
        try {
            $query = $this->db->get();                        
            $result_temp = $query->result();                                     
            foreach ($result_temp as $value) {
                $result[$value->AD_Window_ID] = $value;
            }
        } catch (Exception $e) {}                  
        return $result;
    }
    
    /** Esta función retorna todas las posibles ventanas para un rol*/
    public function get_all_windows_for_role ($ad_role_id) {         
                
        //Como se tiene el rol, se buscan las ventanas existentes asociadas        
        $result = array();    
        
        $this->db->select('w.*')
                 ->from('AD_Window w')
                 ->join('AD_Role_Windows rw', 'rw.AD_Window_ID = w.AD_Window_ID')
                 ->where('rw.AD_Role_ID',$ad_role_id)                  
                 ->order_by("w.Module", "asc")
                 ->order_by("w.Name", "asc");
        try {
            $query = $this->db->get();                        
            $result_temp = $query->result();                                     
            foreach ($result_temp as $value) {
                $result[$value->AD_Window_ID] = $value;
            }
        } catch (Exception $e) {}                  
        return $result;
    }
    
    
    
    /** Esta funci;in  retorna el arreglo con las clases que se refieren a modulos*/
    public function get_modules_class () {
        return 
            array(
                'Productos' => 'product',
                'Atributos' => 'attribute',
                'Conjunto Atr.' => 'set',
                'Usuarios' => 'user',
                'Esquemas' => 'scheme',                    
                'Compras' => 'shop',
                'Insumos' => 'inventory',
                'Ventas' => 'sales',                        
                'Producción' => 'production',
                'Despacho' => 'shipping',
                'Inv. Insumos' => 'inventory',
                'Inv. Productos' => 'inventory',
                'Permisos' => 'user',
                'Alertas de Insumos' => 'traffic',                
                );
    }
    
    
    /** Esta función crea un rol y le asigna aquellos permisos */
    public function create_role_with_permissions($login_user_id) {
               
        $time = date('Y-m-d H:i:s', time());
               
        //Se crea el rol actual
        $ad_role = array(        
            'Description' => $this->input->post('description'),
            'Finder' => $this->input->post('finder'),
            'Name' => $this->input->post('name'),            
            'Created' => $time,
            'CreatedBy' => $login_user_id,
            'Updated' => $time,
            'UpdatedBy' =>  $login_user_id,  
        );
        
        $inserted = FALSE;        
        try {
            $inserted = $this->db->insert('ad_role', $ad_role);            
        } catch ( Exception $e ) {}
        
        if (!$inserted) {
            $this->session_messages->set_error('Ocurrió un error al guardar el rol del usuario'); 
            return FALSE;
        }
        
        $ad_role_id = $this->db->insert_id();
        
        //Para cada una de las ventanas agregar el permiso al rol
        $window = $this->input->post('window');                
        foreach ($window as $key => $value) {
            $ad_role_window = array(
                'AD_Role_ID' => $ad_role_id,
                'AD_Window_ID' => $value,
                'Created' => $time,
                'CreatedBy' => $login_user_id,
                'Updated' => $time,
                'UpdatedBy' =>  $login_user_id,  
            );
                       
            $inserted = FALSE;        
            try {                                         
                $inserted = $this->db->insert('ad_role_windows', $ad_role_window);
            } catch ( Exception $e ) {}
            if (!$inserted) {
                $this->session_messages->set_error('Ocurrió un error al guardar los permisos del rol'); 
                return FALSE;
            }                        
        }
        
        $this->session_messages->set_message('Rol creado exitosamente'); 
        return TRUE;
    }    
    
    /** Esta función crea un rol y le asigna aquellos permisos */
    public function update_role_with_permissions($login_user_id) {
               
        $time = date('Y-m-d H:i:s', time());               
        $ad_role_id = $this->input->post('id');
        
        //Se crea el rol actual
        $ad_role = array(        
            'Description' => ($this->input->post('description') ? $this->input->post('description') : ''),            
            'Finder' => ($this->input->post('finder') ? $this->input->post('finder') : ''),                        
            'Name' =>  ($this->input->post('name') ? $this->input->post('name') : ''),                        
            'Updated' => $time,
            'UpdatedBy' =>  $login_user_id,  
        );
                
        $inserted = FALSE;        
        try {                      
            $this->db->where('ad_role_id', $ad_role_id);
            $inserted = $this->db->update('ad_role', $ad_role);                     
        } catch ( Exception $e ) {}
        
        if (!$inserted) {
            $this->session_messages->set_error('Ocurrió un error al actualizar el rol del usuario'); 
            return FALSE;
        }
        
        //Eliminar los permisos anteriores
        try {                      
            $this->db->where('ad_role_id', $ad_role_id);
            $inserted = $this->db->delete('ad_role_windows');                                 
        } catch ( Exception $e ) {}
        
        
        //Para cada una de las ventanas agregar el permiso al rol        
        $window = $this->input->post('window');                
        foreach ($window as $value) {
            $ad_role_window = array(
                'AD_Role_ID' => $ad_role_id,
                'AD_Window_ID' => $value,
                'Created' => $time,
                'CreatedBy' => $login_user_id,
                'Updated' => $time,
                'UpdatedBy' =>  $login_user_id,  
            );
                       
            $inserted = FALSE;        
            try {                                         
                $inserted = $this->db->insert('ad_role_windows', $ad_role_window);
            } catch ( Exception $e ) {}
            if (!$inserted) {
                $this->session_messages->set_error('Ocurrió un error al guardar los permisos del rol'); 
                return FALSE;
            }                        
        }
        
        $this->session_messages->set_message('Rol actualizado exitosamente'); 
        return TRUE;
    }    
    
    
    /** 
     * Esta función retorna todas los posibles roles de un usuario 
     * Retorna un arreglo de stdClass con los parametros ID, Finder, Name     
     */
    public function get_all_roles () {         
                
        //Como se tiene el rol, se buscan las ventanas existentes asociadas
        $result = array();    
        $this->db->select('AD_Role_ID as ID, Finder, Name, Is_Active, Description,  AD_Role_ID')
                 ->from('ad_role')                 
                 ->order_by("name", "asc");
        try {
            $query = $this->db->get();                        
            $result = $query->result();                    
        } catch (Exception $e) {}                  
        return $result;
    }
    
    
    /** Dado un id de usuario, busca al usuario en la base de datos */
    public function find_role ($ad_role_id) {
        
        $this->db                
                ->from('AD_Role u')                
                ->where(array('u.AD_Role_id' => $ad_role_id) )
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
    
    /** Dado un id de role, busca que no exista el nuevo valor en la base de datos */
    public function is_repeated_finder ($finder, $ad_role_id) {                       
        $this->db
                ->select('u.AD_Role_ID')
                ->from('AD_Role u')                
                ->where(array(
                        'u.AD_Role_ID !=' => $ad_role_id,
                        'u.Finder' => $finder,                        
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
    
    /** 
     * Esta función elimina los usuarios de las base de datos
     */
    public function delete_role($login_user_id, $ad_role_id) {
        
        //Esta función debe validar que no haya usuarios con este rol
        $users = $this->get_users_with_role($ad_role_id);        
        if ($users) {
            $this->session_messages->set_error('El rol seleccionado tiene usuarios asociados, no se puede eliminar'); 
            return FALSE;
        }
        
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
            $this->db->where('ad_role_id', $ad_role_id);
            $inserted = $this->db->update('ad_role', $ad_user);                         
        } catch ( Exception $e ) {}
                
        if (!$inserted) {
            $this->session_messages->set_error('Ocurrió un error al eliminar el registro'); 
            return FALSE;
        }
        
        $this->session_messages->set_message('Usuario eliminado exitosamente'); 
        return TRUE;
    }
    
    
    /** Esta función nos dice cuales usuarios, están asignados a dicho rol*/
    public function get_users_with_role($ad_role_id) {
        
        $result = array();
        $this->db
             ->select('w.*')
             ->from('AD_User_Roles rw')
             ->join('AD_User w', 'w.AD_User_ID = rw.AD_User_ID')                
             ->where(array(
                 'rw.AD_Role_ID' => $ad_role_id,                 
            ));
        try {
            $query = $this->db->get();
            $result = $query->result();                                                        
        } catch ( Exception $e) {}                
        return $result;
        
    }
       
}
/* Fin de archivo user.php */
/* Ubicación: */

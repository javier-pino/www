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
    public function getUserRole (Entities\AdUser $adUser) {
        
        $result = NULL;        
        $query = $this->qb->select('u, ur')
                ->from('Entities\ADUserRoles', 'ur')                
                ->join('ur.adUser', 'u')
                ->where('u.adUserId = '. $adUser->getAdUserId())
                ->getQuery();                        
        try {                        
             //Si tiene un rol asociado buscarlo
            $result = $query->getSingleResult()->getAdRole();            
        } catch (Exception $e) {}
        
        return $result;
    }

    /** Esta función indica si el rol puede acceder a la ventana solicitada */
    public function isAuthorizedRole (Entities\AdRole $role) {
        
        //Verificar si el rol tiene acceso al url                
        $document_dir = $this->get_ad_window();                  
        $query = $this->qb->select('rw')
            ->from('Entities\ADRoleWindows', 'rw')                
            ->join('rw.adRole', 'r')            
            ->join('rw.adWindow', 'w')                           
            ->where('r.adRoleId = '. $role->getAdRoleId())
            ->andWhere('w.documentdir = :directory')
            ->getQuery();                
        $query->setParameter('directory', $document_dir);
        try {                        
             //Si existe la relación, quiere decir que si esta permitido
            $result = $query->getSingleResult();                                    
            if ($result) {
                return TRUE;
            }            
        } catch (Exception $e) {}        
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
    public function get_allowed_ad_windows (\Entities\AdRole $ad_role) {         
                
        //Como se tiene el rol, se buscan las ventanas existentes asociadas
        $result = array();        
        $this->qb = $this->em->createQueryBuilder();
        $query = $this->qb->select('rw, ro, wi')
                ->from('Entities\ADRoleWindows', 'rw')                
                ->join('rw.adRole', 'ro')
                ->join('rw.adWindow', 'wi')
                ->where('ro.adRoleId ='. $ad_role->getAdRoleId())
                ->andWhere("wi.class != 'edit'")
                ->getQuery();                        
        try {                        
             //Si tiene un rol asociado buscarlo
            $result_temp = $query->getResult(); 
            foreach ($result_temp as $res) {
                $w = $res->getAdWindow();
                $result[$w->getModule()][] = $w;
            }
        } catch (Exception $e) {}
        return $result;        
    }
    
    /** Esta función retorna todas las posibles ventanas para un rol*/
    public function get_all_windows () {         
                
        //Como se tiene el rol, se buscan las ventanas existentes asociadas
        $result = array();        
        $this->qb = $this->em->createQueryBuilder();
        $query = $this->qb->select('w')
                ->from('Entities\AdWindow', 'w')                                                
                ->orderBy('w.module, w.name')
                ->getQuery();      
        
        echo $query->getSQL();
        die;
        
        try {                        
             //Si tiene un rol asociado buscarlo
            $result = $query->getResult();             
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
                $this->db->insert('ad_role_windows', $ad_role_window);
            } catch ( Exception $e ) {}
            if (!$inserted) {
                $this->session_messages->set_error('Ocurrió un error al guardar los permisos del rol'); 
                return FALSE;
            }                        
        }
        
        $this->session_messages->set_message('Rol creado con exito'); 
        return TRUE;
    }    
}
/* Fin de archivo user.php */
/* Ubicación: */

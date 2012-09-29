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
            $result = $query->getSingleResult();
            var_dump($result);
                    
                    
                    die;
                    //->getAdRole();            
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
        $query = $this->qb->select('rw, ro')
                ->from('Entities\ADRoleWindows', 'rw')                
                ->join('rw.adRole', 'ro')
                ->where('ro.adRoleId ='. $ad_role->getAdRoleId())
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
                ->from('Entities\ADWindow', 'w')                                
                ->orderBy('w.module, w.name')
                ->getQuery();                        
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
    public function create_role_with_permissions(\Entities\AdUser $creator) {
        
        //Se coloca la fecha actual
        $now = new \DateTime("now");              
        
        $role = new Entities\AdRole();
        $role->setCreated($now);
        $role->setCreatedby($creator);        
        $role->setUpdated($now);
        $role->setUpdatedby($creator);        
        $role->setDescription($this->input->post('description'));
        $role->setFinder($this->input->post('finder'));
        $role->setName($this->input->post('name'));
        
        //Se almacena el rol
        try {
            $this->em->persist($role);
            $this->em->flush();
        } catch (Exception $e) {
            
        }
        
        
        var_dump($role);
        die;        
        
        
        
        
        
        
    }
    
}

/* Fin de archivo user.php */
/* Ubicación: */

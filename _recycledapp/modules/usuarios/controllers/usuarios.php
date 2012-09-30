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

        $this->qb = $this->em->createQueryBuilder();
        $query = $this->qb->select('ur, u, r')
                ->from('AdUserRoles', 'ur')
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
}


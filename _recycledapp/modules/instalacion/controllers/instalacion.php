<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instalacion extends TD_Controller {
        
    public function index()
    {
        $this->load->config('cadena_suministros');                
        $org_finder = $this->config->item('client_finder');

        //Si se configuró correctamente        
        $result = $this->em->getRepository('Entities\AdClient')
                       ->findBy(array('finder' => $org_finder));    
        
        //Eliminar los clientes
        foreach ($result as $remove) {
            $this->em->remove($remove);            
        }
        $this->em->flush();
        
        
        echo 'Se crean los elementos necesarios<br/>';
        
        //Importar la información de la organizacion
        $this->load->config('cadena_suministros');        
        echo 'Crear el cliente<br/>';
        
        $org_finder = $this->config->item('client_finder');
        $org_name = $this->config->item('client_name');
        $org_desc = $this->config->item('client_description');
        $now = new \DateTime("now");              
        
        //Se procede a crear el cliente
        echo 'Se procede a crear el cliente<br/>';        
        
        $client = new Entities\AdClient();        
        $client->setDescription($org_desc);
        $client->setFinder($org_finder);
        $client->setName($org_name);
       
        $this->em->persist($client);
        $this->em->flush();
        
        if ($client->getAdClientId() > 0) 
            echo 'El cliente fue creado exitosamente<br/>';
        else {
            echo 'Ocurrio un error en la creacion del cliente<br/>';
            return;
        }
                
        //Ahora se procede a crear las preferencias del cliente
        echo 'Ahora se procede a crear las preferencias del cliente<br/>';
        $info = new \Entities\AdClientinfo();
        $info->setAdClientId($client->getAdClientId());                
        $info->setKeeplogdays(0);
        
        $this->em->persist($info);
        $this->em->flush();
                
        if ($info->getAdClientinfoId() > 0) 
            echo 'Las preferencias fueron creadas exitosamente<br/>';
        else {
            echo 'Ocurrio un error en la creacion de las preferencias<br/>';
            return;
        }                               
    }
}
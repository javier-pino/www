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

    /********************** Seguridad y cifrado ****************************/
    const CHAR_MIX = 0;
    const CHAR_NUM = 1;
    const CHAR_WORD = 2;
        
    /** Crea un usuario en la base de datos
     * $validator y $hash son variables para el BUHO
     * $validator para el link
     * $hash      para el id en el BUHO         
    public function create_from_buho($user_buho, $email, $password, $client)
    {
        $user_row = new models\User();
        
        $user_row->setEmail($email);
        $user_row->setPassword($this->encode_password($password));
        $user_row->setCreateTime(time());
        $user_row->setLoginTime(time());
        $user_row->setIp($this->input->ip_address());

        if (isset ($user_buho['hash'])) {
            $user_row->setHash($user_buho['hash']);
        }
        if (isset ($user_buho['validator'])) {
            $user_row->setSecret($user_buho['validator']);
        }
        $user_row->setClient($client);
        $user_row->setRealname($user_buho['realname']);
        $user_row->setEnable('N');
        $user_row->setBirthday($user_buho['birthday']);
        $user_row->setCedula($user_buho['identifier']);
        $user_row->setMobile($user_buho['mobile']);

        //Almacenarlo en la base de datos
        try {            
            $this->em->persist($user_row);
            $this->em->flush();
        } catch (Exception $e) {
            //var_dump($e);
        }
        return $user_row;
    }

    /**
     * $validator y $hash son variables para el BUHO
     * $validator para el link
     * $hash      para el id en el BUHO
    public function register_from_buho($user_buho, $client, $validator=NULL, $hash=NULL) {

        $this->load->model('account/user');
        $td_user = $this->user->create_from_buho($user_buho, $user_buho['email'], $user_buho['password'], $client);

        $td_user->setCityId($user_buho['city_id']);
        $td_user->setCity($user_buho['city']);
        $td_user->setGender($user_buho['gender']);

        //Completar los datos
        if ($hash)
            $td_user->setHash($hash);

        if ($validator) {
            $td_user->setSecret ($validator);
        } else {
            $td_user->setSecret(md5($this->generate_secret(12)));
        }

        //Almacenarlo en la base de datos
        try {            
            $this->em->persist($td_user);
            $this->em->flush();
        } catch (Exception $e) {
            //var_dump($e);
        }       
        return $td_user;        
    }

     /*
      * Se actualizan el usuario de acuerdo a la información del buho      
    public function update_from_buho (models\User &$user, $user_buho, $password) {

        if($user_buho['verified'] == 1) {
            $user->setEnable('Y');
        } elseif($user_buho['verified'] == 0) {
            $user->setEnable('N');
        }

        if(!is_null($user_buho['validator']) && isset($user_buho['validator'])) {
            $user->setRecode($user_buho['validator']);
            $user->setSecret($user_buho['validator']);
        }

        if(!is_null($user_buho['identifier']) && isset($user_buho['identifier'])) {
            $user->setCedula($user_buho['identifier']);
        }

        if(!is_null($user_buho['mobile_phone']) && isset($user_buho['mobile_phone'])) {
            $user->setMobile($user_buho['mobile_phone']);
        }

        if(!is_null($user_buho['birthday']) && isset($user_buho['birthday'])) {
            $user->setLocal(strtotime($user_buho['birthday']));
        }

        if(!is_null($user_buho['hash']) && isset($user_buho['hash'])) {
            $user->setHash($user_buho['hash']);
        }

        if(!is_null($user_buho['origin_client']) && isset($user_buho['origin_client'])) {
            $user->setClient($user_buho['origin_client']);
        }

        if(!is_null($password) && isset($password)) {
            $user->setPassword($this->encode_password($password));
        }

        try {
            $this->em->persist($user);
            $this->em->flush();
        } catch (Exception $e) {
            //var_dump($e);
        }
    }

    */
    
    /** Validar que no exista otra usuario en la base de datos */
    public function existing_user ($email, $username, $cedula) {

        $query = $this->qb->select('u')
                  ->from('models\User', 'u')
                  ->where('u.email = :user_email')
                  ->orWhere("u.username != '' and u.username = :user_name" )
                  ->orWhere('u.cedula = :user_cedula')
                  ->getQuery();

        $query->setParameter('user_email', $email)
                ->setParameter('user_name', $username)
                ->setParameter('user_cedula', $cedula);

        $result = array();
        try {
            $result = $query->getArrayResult();
        } catch (Exception $e) {
            //var_dump($e);
        }

        //Si no existe es valido
        if (!empty($result))
            return TRUE;
        else
            return FALSE;
    }
    
    public function verifyLogin($login, $password) {        
        
        //Buscar el usuario y contraseña
        $ad_users = $this->em->getRepository('Entities\AdUser')->findBy(array(
                'login' => $login,
                'password' => md5($password)                                      
            )
        );        
        if (empty($ad_users)) 
            return FALSE;
        else 
            return TRUE;
    }
    
    /** Esta función logue al usuario en el sistema */ 
    public function Login($login, $password, $remember) {
        
        //Buscar el usuario y contraseña
        $ad_users = $this->em->getRepository('Entities\AdUser')->findBy(array(
                'login' => $login,
                'password' => md5($password)                                      
            )
        );           
        if (!empty($ad_users))  {
            
            //Iniciar sesion en code igniter
            $user = $ad_users[0];            
            $this->session->set_userdata('login_user_id', $user->getAdUserId());            
            if ($remember) {
                $this->rememberLogin($login, $password);
            }            
        } else {
            show_error('No es posible iniciar sesión en el sistema con los datos especificados');
        }
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
    
}

/* Fin de archivo user.php */
/* Ubicación: */

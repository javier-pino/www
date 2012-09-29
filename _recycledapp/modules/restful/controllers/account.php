<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Descripción de la clase : Esta clase es el controlador por defecto de account
 * Maneja los métodos que corresponden al inicio, cierre, registro y actualización
 * de un usuario
 *
 * Autor: Javier Pino
 * Fecha: 27/07/2012
 */
class Account extends REST_Controller {

    
    /** 
     * Se debe duplicar el método login posst, para que se haga en login get
     * Por esto se crea este método para evitar repetir funciones
     */
    function login_process ($email, $password) {
        
        //Sino está logueado, hacerlo con usuario y contraseña
        $this->load->model('buho/buho');
        $login_result = $this->buho->login($email, $password);
        
        //Se da una respuesta como servicio restful
        $response = array();
        $response['status'] = $login_result->getSuccess();
        $response['message'] = $login_result->getMessage();
        $response['user'] = $login_result->getUser();
                
        $this->response($response);        
    }
    
    /**
     * Realiza el inicio de sesión del usuario, se conecta al buho y realiza
     * las operaciones necesarias
     */
    function login_get()
    {                 
        //Solicitar los parámetros
        $email = $this->input->get('email');
        $password = $this->input->get('password');
        $this->login_process($email, $password);
    }

    /**
     * Realiza el inicio de sesión del usuario, se conecta al buho y realiza
     * las operaciones necesarias
     */
    function login_post()
    {                 
        //Solicitar los parámetros
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->login_process($email, $password);
    }
    
        /**
     * Realiza el inicio de sesión del usuario, se conecta al buho y realiza
     * las operaciones necesarias
     */
    function register_post()
    {

        //Crear arreglo de parámetros
        $u = array();
        $u['password'] = $this->input->post('password');
        $u['password2'] = $this->input->post('password2');
        $u['email'] = $this->input->post('email');
        $u['city_id'] = abs(intval($this->input->post('city_id')));
        $u['city'] = $this->input->post('city') != NULL ? strval($this->input->post('city')) : '';
        
        //Si no especificó la ciudad
        if ($u['city'] == '') {
            $city_input = $this->input->post('city_input');
            $city_select = $this->input->post('city_select');                        
            if ($u['city_id'] == '1') {
                //Hace falta, buscar el municipio
                $municipio = $this->em->find('models\Municipio', $city_select);                
                $u['city'] =  $municipio->getNombre();
            } else {
                $u['city'] =  $city_input;
            }
        }        

        $u['gender'] = $this->input->post('gender');
        $u['mobile'] = $this->input->post('mobile');
        $u['identifier'] = $this->input->post('identifier');
        $u['full_name'] = $u['realname'] = $this->input->post('realname') != NULL ?
                strval($this->input->post('realname'))
                        : strval($this->input->post('name')) . " " . strval($this->input->post('lastname'));
        $u['birthday'] =
            $this->input->post('birthday') != NULL ?
                strtotime(str_replace('/', '-', $this->input->post('birthday'))) : 0;

        if ($this->input->post('client') == NULL) {
            $u['client'] = 'TD';
        } else {
            $u['client'] = $this->input->post('client');
        }
        $u['interest'] = $this->input->post('interest');
        $u['username'] = '';
        $u['terminos'] = $this->input->post('terminos') == NULL ? 'N' : 'Y';
        $u['subscribe'] = $this->input->post('subscribe') == NULL ? 'N' : 'Y';
        
        //Sino está logueado, hacerlo con usuario y contraseña
        $this->load->model('buho/buho');
        $login_result = $this->buho->register($u);

        //Se da una respuesta como servicio restful
        $response = array();
        $response['status'] = $login_result->getSuccess();
        $response['message'] = $login_result->getMessage();
        $response['user'] = $login_result->getUser();
                
        
        $this->response($response);
        
    }

    /** Desconecta al usuario */
    function logout_get () {

        //Se da una respuesta como servicio restful
        $response = array();
        $response['status'] = TRUE;
        $response['message'] = 'Logout exitoso';
        $response['user'] = NULL;                
        $this->response($response);
    }

    /** Modifica la preferencia de dispositivo */
    function devicepreference_get()
    {
        $this->config->load('device'); //Cargar la configuracion

        //Obtiene los parámetros de definicion
        $device_preference = $this->input->get('preference');
        $device_go_back =$this->input->get('url');

        //Validar la preferencia del usuario, y colocar una por defecto si hace falta
        if ($device_preference != $this->config->item('NO_PREFERENCE') &&
                $device_preference != $this->config->item('MOBILE_PREFERENCE') &&
                    $device_preference != $this->config->item('DESKTOP_PREFERENCE')
        ) $device_preference = $this->config->item('NO_PREFERENCE');

        //Guardar la preferencia actual, y dirigir a la página deseada
        $this->load->library('device_storage');
        $this->device_storage->storeDevicePreference($device_preference);

        //Si se especificó directorio de destino biz, sino ir a index
        $this->load->helper('url');

        //Redirigir a la página inicial        
        redirect($device_go_back);
    }
    
    /** Este servicio entrega todas las ciudades disponibles */
    function ciudades_municipios_get() {
        
        //Antes de procesar, se deben buscar las ciudades y municipios
        $this->load->model('td/category');
        $this->load->model('td/municipio');
        
        //Procesar
        $all_cities = $this->category->get_all_cities();                
        foreach ($all_cities as $city) {
            $result['ciudades'][$city->getId()] = $city->getName();
        }

        //Obtener los municipios               
        $all_municipios = $this->municipio->get_municipios_caracas();        
        foreach ($all_municipios as $mun) {
            $result['municipios'][$mun->getIdmunicipio()] = htmlentities($mun->getNombre());
        }        
        $this->response($result);        
    }
    
}

/* End of file account.php */
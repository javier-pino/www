<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Descripción de la clase : Esta clase es el controlador por defecto de account
 * Maneja los métodos que corresponden al inicio, cierre, registro y actualización
 * de un usuario
 *
 * Autor: Javier Pino
 * Fecha: 27/07/2012
 */
class Cuenta extends TD_Mobile_Controller {

    /**
     * Vista que muestra el formulario de inicio de sesión, para
     * un usuario móvil
     */
    public function iniciar () {

        //Cargar los helpers necesarios
        $this->load->helper('url');

        /*
        if ($this->is_login()) {            
            $url = base_url('movil/');
            redirect($url, 'refresh');
        }
        */

        //Cargar las variables de la vista
        $this->data['title'] = 'TúDescuentón.com - Iniciar Sesión';
        
        //Cargar el formulario y sus atributos
        $this->load->helper('form');
        $this->data['form_info'] = array('class' => 'ui-body ui-body-b ui-corner-all', 'id' => 'iniciar_sesion', 'data-ajax' => 'false');
        $this->data['form_action'] = 'movil/cuenta/iniciar_post';

        $this->data['form_input'] = array(
            'email' => array(
                'type' => "email",
                'name' => "email",
                'id' => "email",
                'value' => "",
                'placeholder' => "Ingrese su login de usuario",
                'required' => true
            ),
            'password' => array(
                'type' => "password",
                'name' => "password",
                'id' => "password",
                'value' => "",
                'placeholder' => "Ingrese su contraseña",
                'required' => true
            ),
            'submit' => array(
                'type' => "submit",
                'data-theme' => "a",
                'content' => "Ingresar"
            ),
            'reset' => array(
                'type' => "reset",
                'data-theme' => "d",
                'content' => "Limpiar Formulario"
            )
        );

        $this->load_as_content('movil/cuenta/iniciar');

    }

    /**
     * Esta función recibe los parámetros del post, ademas de conectarse al
     * api restful y recibir respuesta 
     */
    public function iniciar_post() {

        $this->load->helper(array('form', 'url'));
        
        //Conectarse al api restful        
        $config = $this->config->item('buho');
        $fields = array(            
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $options = array('ssl' => false);
        $this->load->helper(array('curl', 'url'));

        //Procesar la respuesta
        $curl = get_curl(base_url('restful/account/login'), 'post', $fields, $options);
        $result = json_decode($curl['result'], TRUE);

        //Solo aqui se puede procesar la respuesta
        if ($result != NULL) {

            //Si todo ocurrió correctamente
            if ($result['status']) {

                //Iniciar sesion en code igniter
                $user = $result['user'];
                $this->session->set_userdata('user_id', $user['id']);

                //Guardar en la sesión de php td, el id de tudescuenton
                $this->load->library('php_session');
                $this->php_session->set( 'user_id', $user['id']);

                //Recordar la sesión del usuario
                $this->load->model('account/login');
                $this->login->rememberLogin($user);

                $url = base_url('movil/');
                redirect($url, 'refresh');

            } else {
                if (empty($result['message'])) {
                    $result['message'] = 'No se conectó al servidor de sesiones';
                    $result['user'] = NULL;
                }
            }            
        } else {
            $result['message'] = 'No se conectó al servidor de sesiones';
            $result['user'] = NULL;
        }

        //Retornar el mensaje del buho
        $this->data['error_message'] = $result['message'];
        $this->load_as_content('cuenta/iniciar_fallido');
        
        
    }


    /**
     * Vista que muestra el formulario de registro de usuario, para
     * un usuario móvil
     */
    public function registrar () {

        //Cargar los helpers necesarios
        $this->load->helper('url');

        //Cargar las variables de la vista
        $this->data['title'] = 'TúDescuentón.com - Registrar Usuario';

        //Cargar el formulario y sus atributos
        $this->load->helper('form');
        $this->data['form_info'] = array(
            'class' => 'ui-body ui-body-b ui-corner-all',
            'id' => 'registrar_usuario', 'data-ajax' => 'false');

        //Antes de procesar, se deben buscar las ciudades y municipios
        $this->load->model('td/category');
        $all_cities = $this->category->get_all_cities();

        //Procesar las ciudades
        $cities = array('' => 'Selecciona tu ciudad');
        foreach ($all_cities as $city) {
            $cities[$city->getId()] = $city->getName();
        }

        //Obtener los municipios
        $this->load->model('td/municipio');
        $all_municipios = $this->municipio->get_municipios_caracas();
        $municipios = array('' => 'Selecciona tu municipio');
       
        foreach ($all_municipios as $mun) {
            $municipios[$mun->getIdmunicipio()] = htmlentities($mun->getNombre());
        }

        $this->data['form_action'] = 'movil/cuenta/registrar';
        $this->data['form_input'] = array(
            'realname' => array(
                'type' => "text",
                'name' => "realname",
                'id' => "realname",
                'value' => set_value('realname'),
                'placeholder' => "Ingrese su nombre y apellido",
                'required' => true
            ),
            'gender' => array(
                '' => 'Elegir',
                'M' => 'Masculino',
                'F' => 'Femenino'                  
            ),

            'birthday' => array(
                'type' => "text",
                'name' => "birthday",
                'id' => "birthday",
                'value' => set_value('birthday'),
                'placeholder' => "23/08/2012",
                'required' => true
            ),
            'identifier' => array(
                'type' => "number",
                'name' => "identifier",
                'id' => 'identifier',
                'value' => set_value('identifier'),
                'placeholder' => "Cédula",
                'required' => true
            ),
            'mobile' => array(
                'type' => "text",
                'name' => "mobile",
                'id' => 'mobile',
                'value' => set_value('mobile'),
                'placeholder' => "Ingrese su número de teléfono celular",
                'required' => true
            ),

            'email' => array(
                'type' => "email",
                'name' => "email",
                'id' => "email",
                'value' => set_value('email'),
                'placeholder' => "Correo de Registro",
                'required' => true
            ),
            'email2' => array(
                'type' => "email",
                'name' => "email2",
                'id' => "email2",
                'value' => set_value('email2'),
                'placeholder' => "Confirmar Correo",
                'required' => true
            ),
            'password' => array(
                'type' => "password",
                'name' => "password",
                'id' => "password",
                'value' => set_value('password'),
                'placeholder' => "Ingrese su contraseña",
                'required' => true
            ),
            'password2' => array(
                'type' => "password",
                'name' => "password2",
                'id' => "password2",
                'value' => set_value('password2'),
                'placeholder' => "Confirme su Contraseña",
                'required' => true
            ),

            'city_id' => $cities,
            'city_input' => array(
                'type' => "text",
                'name' => "city_input",
                'id' => "city_input",
                'class' => '',
                'value' => set_value('city_input'),
                'placeholder' => 'Seleccione el municipio',                
            ),
            'city_select' => $municipios,
            'interest' => array (
                //Buscar los intereses
            ),
            'subscribe' => array(
                'name'        => 'subscribe',
                'id'          => 'subscribe',
                'value'       => 'Y',
                'checked'     => set_value('subscribe') == 'Y' ? TRUE : FALSE,
            ),
            'terminos' => array(
                'name'        => 'terminos',
                'id'          => 'terminos',
                'value'       => 'Y',
                'checked'     => set_value('terminos') == 'Y' ? TRUE : FALSE,
                //'url'=> '<a target="_blank" href="http://localhost/about/terminos.php">Leer</a>',
            ),

            'submit' => array(
                'type' => "submit",
                'data-theme' => "a",
                'content' => "Registrarme"
            ),
            'reset' => array(
                'type' => "reset",
                'data-theme' => "d",
                'content' => "Limpiar Formulario"
            )
        );

        //Validar el formulario, en caso de que no pase la prueba o no exista mostrarlo
        $this->load->library('form_validation');

        //Crear las reglas
        $this->form_validation->set_rules('realname','"Nombre Completo"', 'required|max_length[32]');
        $this->form_validation->set_rules('gender', '"Género"', 'required');
        $this->form_validation->set_rules('birthday', '"Fecha de Nacimiento"', 'required|is_date'); //Este formato, obligatorio
        $this->form_validation->set_rules("identifier", '"Cédula"',  "required|numeric|max_length[128]|is_unique[user.cedula]");
        $this->form_validation->set_rules("email", '"Correo Electrónico"', "required|valid_email||is_unique[user.email]");
        $this->form_validation->set_rules("email2", '"Confirmar Correo"', "required|matches[email]");
        $this->form_validation->set_rules("password", '"Contraseña"', "required|min_length[4]|max_length[32]");
        $this->form_validation->set_rules("password2",  '"Confirmar su Contraseña"', "required|matches[password]");
        $this->form_validation->set_rules('city_id',  '"Ciudad"', 'required|callback_municipio_check');        
        $this->form_validation->set_rules('terminos', '"Acepta los términos"', 'required');
        
        //Verificar el seguimiento de las reglas
        if ($this->form_validation->run($this) == FALSE)
        {
            //En caso de fracaso mostrar el formulario nuevamente
            $this->load_as_content('movil/cuenta/registrar');
        }
        else
        {
            $city_id = $this->input->post('city_id');
            $city_input = $this->input->post('city_input');
            $city_select = $this->input->post('city_select');

            if ($city_id == '1') {
                //Hace falta, buscar el municipio
                $municipio = $this->em->find('models\Municipio', $city_select);                
                $city =  array('city' => $municipio->getNombre());
            } else {
                $city =  array('city' => $city_input);
            }

            //Conectarse al api restful
            $config = $this->config->item('buho');
            $fields = array_merge($this->input->post(), $city);
            $options = array('ssl' => false);
            $this->load->helper('curl');

            //Procesar la respuesta
            $curl = get_curl(base_url('restful/account/register'), 'post', $fields, $options);
            $result = json_decode($curl['result'], TRUE);


            //Solo aqui se puede procesar la respuesta
            if ($result != NULL) {

                //Si todo ocurrió correctamente
                if ($result['status']) {

                    //Setear algunas variables de espera de correos
                    $user = $result['user'];
                    $this->session->set_userdata('unemail', $user['email']);

                    //Setear algunas variables de espera de correos
                    $this->load->library('php_session');
                    $this->php_session->set( 'unemail', $user['email']);

                    $this->load_as_content('movil/cuenta/registrar_exitoso');
                    return;

                } else {
                    if (empty($result['message'])) {
                        $result['message'] = 'No se conectó al servidor de sesiones';
                        $result['user'] = NULL;
                    }
                }
            } else {
                $result['message'] = 'No se conectó al servidor de sesiones';
                $result['user'] = NULL;
            }
                        
            //En caso de fracaso mostrar el formulario nuevamente
            $this->data['error_message'] = $result['message'];
            $this->load_as_content('movil/cuenta/registrar_fallido');
            
            /*$this->load->helper('url');
            if ($login_result->getSuccess()) {
                $url = prep_url($this->input->server('HTTP_HOST'));
                ///account/signuped.php?id_team='. $id_team . '&ord=' . $user_id.'&client=' . $u['client']);
            } else {
                $url = base_url('account/register');
                //$url = '/account/signuped.php?id_team='. $id_team . '&ord=' . $user_id.'&client=' . $u['client']);
            }
            redirect($url, 'refresh');
            */
          
        }


    }

   
    /**
     * Esta función recibe los parámetros del get, ademas de conectarse al
     * api restful y recibir respuesta
     */
    public function cerrar() {

        //Cerrar sesión en codeigniter
        $this->session->unset_userdata('user_id');

        //Eliminar la sesión de php td
        $this->load->library('php_session');
        $this->php_session->delete('user_id');

        //Olvidar la sesión del usuario
        $this->load->model('account/login');
        $this->login->forgetLogin();

        $this->load->helper('url');
        $url = prep_url($this->input->server('HTTP_HOST'));
        redirect($url, 'refresh');
    }


    /** Esta función agrega al formulario, una validacion adicional además de
     * entregar un mensaje formateado
     */
    public function municipio_check($str)
    {
        $city_id = $this->input->post('city_id');
        $city_input = $this->input->post('city_input');
        $city_select = $this->input->post('city_select');
        
        if ($city_id == '1' && $city_select == '') {
            $this->form_validation->set_message('municipio_check', 'El campo "Municipio" es obligatorio');
            return FALSE;
        }

        if ($city_id != '1' && $city_input == '') {
            $this->form_validation->set_message('municipio_check', 'El campo "Municipio" es obligatorio');
            return FALSE;
        }        
        return TRUE;        
    }

}

/* End of file account.php
 * C:\wamp\www\td\_recycledapp\modules\movil\controllers\cuenta.php
 */

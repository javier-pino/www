<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Descripción de la clase :
 *
 * Clase Global que se espera se utilice en vez de usar CI_controller
 * Carga el querybuilder del entity manager
 *
 * Determina el dispositivo, ademas que redirecciona a los controladores necesarios
 * en caso de ser movil o no
 *
 * Autor: Javier Pino
 * Fecha: 16/07/2012
 */

require APPPATH."third_party/MX/Controller.php";

/** 
 * Esta clase permite crear controladores que no verifiquen el dispositivo
 * pero que carguen las variables de la base de datos 
 * 
 * Este controlador conoce y calcula el cliente actual, además de almacenarlo
 * en una variable global
 */
class TD_Controller extends MX_Controller {

    //Declaro las propiedades con tipo, para que sea el tipo adecuado y netbeans
    //pueda detectarlas

    /**
     * @var Doctrine\ORM\EntityManager
     */
    public $em = null;

    /**
     * @var \Doctrine\ORM\QueryBuilder
     */
    public $qb = null;
    
    //Para mostrar comodamente el nombre del cliente
    public $client_name = '';
   
    //Para reusar las variables y poderlo usar en las vistas
    protected $data = array();
    
    /** Contruye el objeto con las funciones de base de datos ya cargadas,
     * ademas de haber determinado el dispositivo */
    public function  __construct()
    {
        parent::__construct();
        
        //Instantiate a Doctrine Entity Manager, Querybuilder, Database
        $this->load->database();
        $this->em = $this->doctrine->em;
        $this->qb = $this->em->createQueryBuilder();                
        
        //Traer textos de configuracion para tenerlos a la mano
        $this->load->config('cadena_suministros');                
        $this->client_name = $this->config->item('client_name'); 
    }    
}

/** Controlador que realiza la validación de si el usuario tiene acceso a la 
 * pagina que está solicitando ***/
class TD_Login_Controller extends TD_Controller {
               
    /**
     * @var stdClass Usuario logueado en el sistema
     * Esta variable almacena el usuario identificado
     */
    protected $login_user = NULL;
    
    /**     
     * Esta variable almacena el identificador del cliente de la aplicacion
     */
    protected $login_user_id = NULL;

    /** Para reusar las variables y poderlo usar en las vistas */
    protected $data = array();
    
    /** Contruye el objeto con las funciones de base de datos ya cargadas,
     * ademas de haber determinado el dispositivo */    
    public function __construct() {
        
        parent::__construct();
        
        //Buscar el cliente en la sesión
        $this->load->model('Cadena/user');        
        $this->login_user_id = $this->session->userdata('login_user_id');  
        
        //Si no está en sesión
        if (!$this->login_user_id) {
            
            //Buscarlo en las cookies e iniciar sesión
            $login_cookie = $this->get_login_cookie();                        
            if ($login_cookie) {                
                
                //Si se encuentra, iniciar la sesión sino entonces buscar el cookie de inicio de sesión
                $this->login_user_id = $this->user->Login($login_cookie[0], $login_cookie[1], TRUE, TRUE);
            }
        }
        
        $this->data['client_name'] = $this->client_name;
        if ($this->login_user_id) {  //Buscar al usuario en la base de datos                                     
            $this->login_user = $this->user->find_user_and_role($this->login_user_id);                        
            $this->data['user_name'] = $this->login_user->Name_user;
        }        
               
        //Para evitar llamar varias veces a base_url  para los css y js se usa array_map     
        $this->data['css'] = array_map('base_url',
            array(                    
                'css/yahoo-yui-reset.css',
                'css/screen.css',                
                'css/initial_table.css',
                'css/jquery-ui-1.8.23.custom.css'
            )
        );
        
        //Indicar los css para movil
        $this->data['js'] = array_map('base_url',
            array(                
                'js/jquery-1.8.0.min.js',
                'js/jquery.dataTables.min.js', 
                'js/jquery-ui-1.8.23.custom.min.js',
                'js/general_jquery.js',
            )
        );
    }        
        
    /** Carga la vista de acuerdo al contenido especificado */
    protected function load_as_content($view) {
        
        //Cargar los mensajes informativos
        $this->data['info'] = $this->session_messages->get_message();
        $this->data['error'] = $this->session_messages->get_error();
        
        //Cargar las vistas
        $this->load->view('cabecera_html', $this->data);        
        $this->load->view('cabecera_menu', $this->data);
        $this->load->view('cabecera_mensajes', $this->data);
        $this->load->view($view, $this->data);
        $this->load->view('fondo_html', $this->data);
    }
    
    /** Cargar css adicionales */
    protected function load_css($csss) {
        $this->data['css'] = 
            array_merge($this->data['css'], array_map('base_url',$csss));
    }
    
    /** Cargar js adicionales */
    protected function load_js($jss) {
        $this->data['js'] = 
                array_merge($this->data['js'], array_map('base_url',$jss));               
    }
                
    /** Retorna el cliente global, en casop de que exista */ 
    public function get_login_user_id() {        
        if (!$this->login_user_id) 
            return false;
        else 
            return $this->login_user_id;
    }
    
    /** Retorna el cliente global, en caso de que exista */ 
    public function get_login_user() {        
        if (!$this->login_user) 
            return false;
        else 
            return $this->login_user;
    }
    
    /** Retorna un booleano que indica si el usuario está conectado o no */
    public function is_login() {
        if ($this->login_user !== NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }   
    
    /** Obtiene el cookie de sesión de tudescuenton - codeigniter para iniciar el usuario */
    private function get_login_cookie() {
        $cookie = $this->input->cookie('421a_ru');
        if ($cookie) {
            $cookie = base64_decode($cookie);
            $cookie = explode('@', $cookie, 2);
            return $cookie;        
        } else
            return false;        
    }
    
    /** Llamar a esta función implica que el usuario debe estar logueado para acceder
        a esta funcionalidad
     */
    public function need_login() {             
        if (!$this->is_login()) {            
            redirect(base_url('usuarios/sesion/iniciar'));            
        }        
    }

}

/** Controlador que realiza la validación de si el usuario tiene acceso a la 
 * pagina que está solicitando ***/
class TD_Role_Controller extends TD_Login_Controller {
               
    /**
     * @var stdClass Rol del usuario que está logueado     
     */
    private $login_role = NULL;
    
    /**
     * Indica si el usuario está autorizado a acceder a la ventana
     */
    private $authorized = FALSE;    
    
    /** Constructor */
    public function __construct() {
        
        parent::__construct();
        
        //Si está logueado, buscar el rol del usuario
        if ($this->is_login()) {
            
            //Obtener el rol y determinar si el rol está autorizado
            $this->load->model('Cadena/role');                                    
            $this->login_role = $this->role->getUserRole($this->login_user);
            
            if ($this->login_role) {                
                $this->authorized = $this->role->isAuthorizedRole($this->login_role);                
                        
                //Buscar las pantallas que tiene permitidas
                $this->data['role_name'] = $this->login_role->Name;
                $this->data['allowed_ad_windows'] =                         
                        $this->role->get_allowed_ad_windows($this->login_role);                 
                
                $this->data['windows_class'] = $this->role->get_modules_class();                            
            }
        }                     
    }
    
    /** Indica si el usuario está autorizado para acceder a la ventana */
    public function is_authorized() {
        return $this->authorized;
    }
    
    /** Retorna el cliente global, en caso de que exista */ 
    public function get_login_role() {        
        if (!$this->login_role) 
            return false;
        else 
            return $this->login_role;
    }
    
    /** Esta función valida que el usuario tenga un rol determinado para accederla
     */
    public function need_role_authorization() {
        
        //Se valida si el usuario tiene la a
        if (!$this->is_authorized()) {           
            show_error('No está autorizado para ingresar a esta página');
            return;        
        }        
    }   
    
}
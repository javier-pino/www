<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include ('constant.php');

class Establishment extends TD_Controller {

        function __construct()
        {
                parent::__construct();
                /* Standard Libraries */
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */
                
        }
        
        public function index()
        {
            $data['title'] = '.::TuDescuentón.com::.. Locales Disponibles';
            $data['css_files'] = array('css/index.min.css', 
                                'css/header.css', 
                                'css/nav_tdmarcas.css', 
                                'css/coin-slider.css',
                                'css/fonts.css',
                                'css/style.css',
                                'css/datepicker_trontastic.css',
                                'css/list_style.css',
                                'css/socialNetworks.css');
            $data['js_files'] = array('js/jquery-1.7.2.js',
                                'js/ui/jquery.ui.core.js',
                                'js/ui/jquery.ui.widget.js',
                                'js/ui/jquery.ui.datepicker.js',
                                'js/ajax.js',
                                'js/jquery.carouFredSel-5.5.5-packed.js',
                                'js/utilities.js',
                                'js/list_js.js');
            $data['image_url'] = 'http://localhost/static/';
            $today_time = time();
            $today_date = (string) date('d/m/Y', $today_time);
            
            $data['cuisine'] = $this->_get_cuisine();
            $data['citys'] = $this->_get_citys();
            
            //$data['list'] = $this->_get_list($today_time, $today_date);
            $data['list'] = $this->_get_list();
            $count_home_list = count($data['list']);
            $data['times_arr'] = $this->_times_arr();
            
            
            for ($i=0;$i<$count_home_list;$i++){
                $data['list'][$i]['dates'] = $this->_get_date_current($data['list'][$i]['team_id']);
                $data['list'][$i]['image'] = $this->_get_team_image($data['list'][$i]['team_id'], 1);
            }
            
//            echo '<pre>';
//            print_r ($data['list']); 
//            echo '</pre>';die;
//            echo '<pre>';
//            print_r($data); 
//            echo '</pre>';die;
            
            $this->load->view('header', $data);
            $this->load->view('header_td');
            $this->load->view('list_content');
            $this->load->view('footer');
        }
        
        public function _get_cuisine()
        {
            
                
                $query = $this->db->query("SELECT *
                                        FROM `cuisine_reserva`");

                
                return $query->result_array();
                
            
        }
        
        public function _get_citys()
        {
            
                
                $query = $this->db->query("SELECT *
                                        FROM `citys`
                                        WHERE `id_state` = 1");

                
                return $query->result_array();
                
            
        }
        
         public function list_query()
        {            
            
            date_default_timezone_set('America/Caracas');
            
            $party_size = $_POST['opciones'][0]['value'];
            if ($_POST['opciones'][1]['value'] == ''){
                $date_reserve = (string) date('d/m/Y');
            }else{
                $date_reserve = $_POST['opciones'][1]['value'];
            }            
            $time_reserve = $_POST['opciones'][2]['value'];
            
            //var_dump ($party_size); die;
            $count_opciones = count($_POST['opciones']);
            $k = 0;
            $j = 0;
            $municipio = '';
            $foodtype = '';
            if ($count_opciones >=4){
                for ($i=3;$i<$count_opciones;$i++){
                    if ($_POST['opciones'][$i]['name']==='municipio'){
                        $municipio[$k] = $_POST['opciones'][$i]['value'];
                        $k++;
                    }
                    elseif ($_POST['opciones'][$i]['name']==='foodtype')
                    {
                        $foodtype[$j] = $_POST['opciones'][$i]['value'];
                        $j++;
                    }
                }
            }
            
            $data['image_url'] = 'http://localhost/static/';
            $data['list'] = $this->_get_list_ajax($time_reserve, $date_reserve, $party_size, $municipio, $foodtype);
            $count_home_list = count($data['list']);
            //var_dump($data); die;
            for ($i=0;$i<$count_home_list;$i++){
                $data['list'][$i]['times'] = $this->_get_time_current($data['list'][$i]['team_id'], $date_reserve);
                $data['list'][$i]['image'] = $this->_get_team_image($data['list'][$i]['team_id'], 1);
            }
            
            $data['municipio'] = $municipio;
            $data['foodtype'] = $foodtype;
             
            //var_dump ($data); die;
            
             $this->load->view('list_query', $data);
            
        }
        
        public function _get_list()
        {
            
            $fecha_aux = mktime(date("H"), date("i")+ADDMINUTES, date("s"), date("m"), date("d"), date("Y"));
            $now = strtotime (date("d-m-Y H:i:s", $fecha_aux));
            
            $query = $this->db->query("SELECT `t_reservas`.`team_id`,`local`.`local_name`, `local`.`city_name`,
                                    `partner`.`cuisine`, `team`.`url_title`, `team`.`detail`
                                    FROM `local`
                                    JOIN `partner` on `partner`.`id` = `local`.`partner_id`
                                    JOIN `t_reservas` on `t_reservas`.`local_id` = `local`.`id`
                                    JOIN `t_booking` on `t_booking`.`id_team` = `t_reservas`.`team_id`
                                    JOIN `team` on `team`.`id` = `t_reservas`.`team_id`
                                    WHERE `t_reservas`.`date_fin` > $now
                                    and `t_booking`.`date` >= $now
                                    and (`t_booking`.`availability` - `t_booking`.`now`) > 0
                                    GROUP BY `t_reservas`.`team_id`
                                    LIMIT 4");

            
            
            
            return $query->result_array();
            
        }
        
        public function _get_list_ajax($time, $date, $party_size, $municipio, $foodtype)
        {
            $fecha_aux = mktime(date("H"), date("i")+ADDMINUTES, date("s"), date("m"), date("d"), date("Y"));
            $now = strtotime (date("d-m-Y H:i:s", $fecha_aux));
            
            if (($date == '') || ($time == '') || ($party_size == '')){
                
                if ($party_size === ''){
                    $party_size = (int) 0;
                }else{
                    $party_size = (int) $party_size;
                }
                if ($date == ''){
                   $date = (string) date('d/m/Y');
                }
                if ($time == ''){
                    $time = strtotime(date('d-m-Y'));
                }else{
                    $date = strtr($date,"/","-");
                    $time = strtotime($date." ".$time);
                    $date = strtr($date,"-","/");
                }
                
                
                
                $today_time = strtotime(date('d-m-Y'));
                $today_date = (string) date('d/m/Y', $today_time);
                
                $sql_list = "SELECT `t_reservas`.`team_id`,`local`.`local_name`, `local`.`city_name`,
                                    `partner`.`cuisine`, `team`.`url_title`, `team`.`detail`
                                    FROM `local`
                                    JOIN `partner` on `partner`.`id` = `local`.`partner_id`
                                    JOIN `t_reservas` on `t_reservas`.`local_id` = `local`.`id`
                                    JOIN `t_booking` on `t_booking`.`id_team` = `t_reservas`.`team_id`
                                    JOIN `team` on `team`.`id` = `t_reservas`.`team_id`
                                    WHERE `t_reservas`.`date_fin` > ".$time."
                                    and from_unixtime(`t_booking`.`date`, '%d/%m/%Y') = '$date'
                                    and `t_booking`.`date` >= $now
                                    and (`t_booking`.`availability` - `t_booking`.`now`) >= ".$party_size;
                
                
                if ($municipio!= ''){
                    $sql_list .= " and (";
                    $count_m = count($municipio);
                    for ($i=0;$i<$count_m;$i++){
                        $sql_list .= "`local`.`city_name` = '$municipio[$i]'";
                        if ($i+1<$count_m){
                            $sql_list .= " or ";
                        }
                    }
                    $sql_list .= ")";
                }
                
                if ($foodtype!= ''){
                    $sql_list .= " and (";
                    $count_f = count($foodtype);
                    //print_r($count_f);
                    for ($j=0;$j<$count_f;$j++){
                        $sql_list .= "`partner`.`cuisine` LIKE '%$foodtype[$j]%'";
                        if ($j+1<$count_f){
                            $sql_list .= " or ";
                        }
                    }
                    $sql_list .= ")";
                }  
                //print_r ($sql_list); die;
                
                
                
                $sql_list .= " GROUP BY `t_reservas`.`team_id`";
                
                
                $query = $this->db->query($sql_list);
                
            }else{
                
                
                
                $date =  (string)strtr($date,"/","-");
                $time =  (int)strtotime($date." ".$time);
                
                
                $sql_list = "SELECT `t_reservas`.`team_id`,`local`.`local_name`, `local`.`city_name`,
                                    `partner`.`cuisine`, `team`.`url_title`, `team`.`detail`
                                    FROM `local`
                                    JOIN `partner` on `partner`.`id` = `local`.`partner_id`
                                    JOIN `t_reservas` on `t_reservas`.`local_id` = `local`.`id`
                                    JOIN `t_booking` on `t_booking`.`id_team` = `t_reservas`.`team_id`
                                    JOIN `team` on `team`.`id` = `t_reservas`.`team_id`
                                    WHERE from_unixtime(`t_booking`.`date`, '%d-%m-%Y') = '$date'
                                    and `t_booking`.`date` >= ".$time."
                                    and (`t_booking`.`availability` - `t_booking`.`now`) >= ".$party_size;
                 if ($municipio!= ''){
                    $sql_list .= " and (";
                    $count_m = count($municipio);
                    for ($i=0;$i<$count_m;$i++){
                        $sql_list .= "`local`.`city_name` = '$municipio[$i]'";
                        if ($i+1<$count_m){
                            $sql_list .= " or ";
                        }
                    }
                    $sql_list .= ")";
                }
                
                if ($foodtype!= ''){
                    $sql_list .= " and (";
                    $count_f = count($foodtype);
                    //print_r($count_f);
                    for ($j=0;$j<$count_f;$j++){
                        $sql_list .= "`partner`.`cuisine` LIKE '%$foodtype[$j]%'";
                        if ($j+1<$count_f){
                            $sql_list .= " or ";
                        }
                    }
                    $sql_list .= ")";
                }              
                
                $sql_list .= " GROUP BY `t_reservas`.`team_id`";
                //print_r ($sql_list); die;
                $query = $this->db->query($sql_list);
                
            }
            
            return $query->result_array();
            
        }
        
        public function _get_time_current($id_team, $fecha)
        {
            
                $fecha_aux = mktime(date("H"), date("i")+ADDMINUTES, date("s"), date("m"), date("d"), date("Y"));
                $now = strtotime (date("d-m-Y H:i:s", $fecha_aux));
                $query = $this->db->query("SELECT from_unixtime(`t_booking`.`date`, '%h:%i %p') time,
                                        FROM_UNIXTIME(  `t_booking`.`date` ,  '%d/%m/%Y' ) AS date_url
                                        FROM `t_booking` 
                                        WHERE id_team = '$id_team'
                                        and from_unixtime(`t_booking`.`date`, '%d/%m/%Y') = '$fecha'
                                        and `t_booking`.`date` >= $now
                                        and (`t_booking`.`availability` - `t_booking`.`now`) > 0");

                
                return $query->result_array();
                
            
        }
        
        public function _get_date_current($id_team)
        {
            
                $fecha_aux = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                $now = strtotime (date("d-m-Y H:i:s", $fecha_aux));
                
                $query = $this->db->query("SELECT FROM_UNIXTIME(  `t_booking`.`date` ,  '%e %b' ) AS date_available,
                                            FROM_UNIXTIME(  `t_booking`.`date` ,  '%d/%m/%Y' ) AS date_url
                                            FROM  `t_booking` 
                                            WHERE id_team = '$id_team'
                                            AND `t_booking`.`date` >= $now
                                            GROUP BY date_available
                                            ORDER BY `t_booking`.`date`");

                
                return $query->result_array();
                
            
        }
        
        public function _get_team_image($id_team, $qty)
        {
            
                
                $query = $this->db->query("SELECT `multimedia`.`route`
                                        FROM `multimedia` 
                                        JOIN `team` ON `team`.`id` = `multimedia`.`id_team`
                                        WHERE `multimedia`.`id_team` = '$id_team'
                                        LIMIT $qty");

                
                return $query->result_array();
                
            
        }
        
        public function search()
        {            
            
            if(isset($_GET['q']))
                {            
                    $data['search'] = $_GET['q'];
                }
                else
                {
                    $data['search'] = '';
                }
                
            $data['title'] = '.::TuDescuentón.com::.. Locales Disponibles';
            $data['css_files'] = array('css/index.min.css', 
                                'css/header.css', 
                                'css/nav_tdmarcas.css', 
                                'css/coin-slider.css',
                                'css/fonts.css',
                                'css/style.css',
                                'css/datepicker_trontastic.css',
                                'css/list_style.css',
                                'css/socialNetworks.css');
            $data['js_files'] = array('js/jquery-1.7.2.js',
                                'js/ui/jquery.ui.core.js',
                                'js/ui/jquery.ui.widget.js',
                                'js/ui/jquery.ui.datepicker.js',
                                'js/ajax.js',
                                'js/jquery.carouFredSel-5.5.5-packed.js',
                                'js/utilities.js',
                                'js/list_js.js');
            $data['image_url'] = 'http://localhost/static/';
            $today_time = strtotime(date('d-m-Y'));
            $today_date = (string) date('d/m/Y', $today_time);
            
            $data['cuisine'] = $this->_get_cuisine();
            $data['citys'] = $this->_get_citys();
            
            $data['list'] = $this->_get_list($today_time, $today_date);
            $count_home_list = count($data['list']);
            
            
            for ($i=0;$i<$count_home_list;$i++){
                $data['list'][$i]['times'] = $this->_get_time_current($data['list'][$i]['team_id'], $today_date);
                $data['list'][$i]['image'] = $this->_get_team_image($data['list'][$i]['team_id'], 1);
            }
            
//            echo '<pre>';
//            print_r($data); 
//            echo '</pre>';die;
            
            $this->load->view('header', $data);
            $this->load->view('header_td');
            $this->load->view('list_content');
            $this->load->view('footer');
            
        }
        
        public function view($slug=NULL, $box=NULL)
        {
            $data['box'] = '00';
            if ($box != NULL){
                $data['box'] = $box;
                $data['party_size'] = 2 ;
                $data['date'] = $_GET['f'];
                $data['time'] = $_GET['t'];
            }
//            echo $box; echo "<br />";
//            echo $_GET['f']; echo "<br />";
//            echo $_GET['t'];
//            die;
            
            $data['team']= '';
            // Determinamos la versión del explorador para decidir si se activa
            // el slider del carrusel infinito de la página de vista del local
            $this->load->library('user_agent');
            
            if (($this->agent->is_browser('Firefox')) && ((int) $this->agent->version() >= 12))
            {
                $data['slider'] = 1;
            }
            elseif (($this->agent->is_browser('Internet Explorer')) && ((int) $this->agent->version() >= 9))
            {
                $data['slider'] = 1;
            }
            elseif (($this->agent->is_browser('Safari')) && ((int) $this->agent->version() >= 535))
            {
                $data['slider'] = 1;
            }
            else
            {
                $data['slider'] = 0;
            }
            // Fin del escaneo de la versión del explorador
            
            if ($slug === NULL) // Si no se paso ningun parametro el método
            {
                 redirect('reservas/establishment/', 'refresh'); // va a la lista de locales
            }
            
            // Llamada a la función privada que nos devuelve los datos necesarios
            // del local para mostrar toda la información en la vista
            $data['team'] = $this->_get_local($slug);
            
            //$data['times'] = $this->get_times('widget', $data['team'][0]['id_promo']); 
            // Titulo de la página
            $data['title'] = '.::TuDescuentón.com::.. ';
            
            // Arreglo de los css que se usarán en esta vista
            $data['css_files'] = array('css/index.min.css', 
                                'css/header.css', 
                                'css/nav_tdmarcas.css', 
                                'css/coin-slider.css',
                                'css/fonts.css',
                                'css/style.css',
                                'css/datepicker_trontastic.css',
                                'css/view_style.css',
                                'css/socialNetworks.css');
            
            // Arreglo de los js que se usaran en esta vista
            $data['js_files'] = array('js/jquery-1.7.2.js',
                                'js/ui/jquery.ui.core.js',
                                'js/ui/jquery.ui.widget.js',
                                'js/ui/jquery.ui.datepicker.js',
                                'js/ajax.js',
                                'js/jquery.carouFredSel-5.5.5-packed.js',
                                'js/utilities.js',
                                'js/view_js.js');            
            $data['image_url'] = 'http://localhost/static/';
            
//            echo '<pre>';
//            print_r($data);
//            echo '</pre>';
//            die;
            $this->load->view('header', $data);
            $this->load->view('header_td');
            $this->load->view('reservation_main');
            $this->load->view('footer');
        }
        
        public function _get_local($slug)
        {
            // Datos de la promo
            $slug = (string) $slug;
            $this->db->select('`team`.`id` as id_promo, `local`.`local_name`, `local`.`city_name`,
                            `local`.`location`, `partner`.`cuisine`,
                            `team`.`description`, `t_reservas`.`date_ini`, `t_reservas`.`date_fin`');
            $this->db->from('team');
            $this->db->join('t_reservas', 'team.id_t_reservas = t_reservas.id_t_reservas');
            $this->db->join('local', 'local.id = t_reservas.local_id');
            $this->db->join('partner', 'team.partner_id = partner.id');
            $this->db->where('`team`.`url_title`', $slug);
            $this->db->limit(1);
            
            $query = $this->db->get();
            
            if ($this->db->affected_rows() == 0){
                redirect('reservas/establishment/', 'refresh'); // va a la lista de locales                
            }
            
            
            $promo_array = $query->result_array();
            
            $promo_array[0]['id_promo'];
            
            $this->db->select('`multimedia`.`route`');
            $this->db->from('multimedia');
            $this->db->join('team', 'team.id = multimedia.id_team');
            $this->db->where('multimedia.type', 'image');
            $this->db->where('multimedia.id_team', $promo_array[0]['id_promo']);
            
            $query2 = $this->db->get();
            $multimedia_array = $query2->result_array();
            
            
            $promo_array[0]['multimedia'] = $multimedia_array;   
            
            $date_res = strtotime(date('d-m-Y'));
            $bookings_array = $this->get_bookings($date_res, $promo_array[0]['id_promo']);
            
            $promo_array[0]['bookings'] = $bookings_array;
            
            return $promo_array;
        }
        
        public function get_bookings($date_res=NULL, $id_team=NULL)
        {           
            if (($date_res === NULL) || ($id_team === NULL)) // Si no se paso ningun parametro el método
            {
                 show_404('page'); // Le muestro un 404
            }  
            elseif ($date_res === 'widget') 
            {
                //echo $_POST['reservas'][0]['value'];die;
                
                $date_res = strtotime(date('d-m-Y'));
                $this->db->select('`t_reservas`.`date_ini`, `t_reservas`.`date_fin`');
                $this->db->from('t_reservas');
                $this->db->where('t_reservas.team_id', $id_team);
                
                $query = $this->db->get();
                $date_array =  $query->result_array();
                $date_fin_aux = date('d-m-Y',$date_array[0]['date_fin']);
                $today = strtotime(date('d-m-Y'));
                $date_ini_aux = $date_array[0]['date_ini'];
                
                
                
                if ($today > $date_ini_aux){
                    $date_ini_tmp = date('d-m-Y', $today);
                    $date_ini = date('Y, n, j', strtotime($date_ini_tmp.' -1 month'));
                }else{
                    $date_ini_tmp = date('d-m-Y', $date_ini_aux);
                    $date_ini = date('Y, n, j', strtotime($date_ini_tmp.' -1 month'));
                }
                
                
                $date_fin = date('Y, n, j', strtotime($date_fin_aux.' -1 month'));
                //$date_ini = $date('Y, n, j',  strtotime($date_ini_aux));
                $cantidad = $_POST['reservas'][0]['value'];
                
                $query = $this->db->query("SELECT TODOS.date_unavailable
                                        FROM 
                                        (
                                        SELECT from_unixtime(`t_booking`.`date`, '%d-%m-%Y') as date_unavailable
                                        FROM `t_booking` 
                                        WHERE id_team = '$id_team'
                                        group by date_unavailable
                                        ) TODOS
                                        LEFT JOIN 
                                        (
                                        SELECT from_unixtime(`t_booking`.`date`, '%d-%m-%Y') as date_unavailable
                                        FROM `t_booking` 
                                        WHERE id_team = '$id_team'
                                        and (`t_booking`.`availability` - `t_booking`.`now` - '$cantidad') >= 0
                                        group by date_unavailable
                                        ) DISPONIBLES on DISPONIBLES.date_unavailable = TODOS.date_unavailable
                                        WHERE DISPONIBLES.date_unavailable IS NULL");

                //$query = $this->db->get();
                $bookings_array = $query->result_array();
                $x=array(
                    'cantidad'=>$cantidad,
                    'bookings'=>$bookings_array,
                    'date_ini'=>$date_ini,
                    'date_fin'=>$date_fin
                );
                echo json_encode($x);
                //var_dump ($bookings_array);
                
            }
            else
            {
                $aux_date = $date_res + (24 * 3600);
                
                $this->db->select('`t_booking`.`date`, `t_booking`.`availability`, 
                                `t_booking`.`now`');
                $this->db->from('t_booking');
                $this->db->where('t_booking.id_team', $id_team);
                $this->db->where('t_booking.date >=', $date_res);
                $this->db->where('t_booking.date <=', $aux_date);

                $query = $this->db->get();
                $bookings_array = $query->result_array();
                if ($query->num_rows() > 0){
                    return $bookings_array[0]['date'];
                }else{
                    return NULL;
                }
               
                
            }   
        }
        
        public function get_times($date_res=NULL, $id_team=NULL)
        {           
            if (($date_res === NULL) || ($id_team === NULL)) // Si no se paso ningun parametro el método
            {
                 show_404('page'); // Le muestro un 404
            }  
            elseif ($date_res === 'widget') 
            {
                 
                $now = time();
                $cantidad = $_POST['reservas'][0]['value'];
                $fecha_res = $_POST['reservas'][1]['value'];
                $query = $this->db->query("SELECT from_unixtime(`t_booking`.`date`, '%h:%i %p') time
                                        FROM `t_booking` 
                                        WHERE id_team = '$id_team'
                                        and `t_booking`.`date` >= $now
                                        and from_unixtime(`t_booking`.`date`, '%d/%m/%Y') = '$fecha_res'
                                        and (`t_booking`.`availability` - `t_booking`.`now`) >= '$cantidad'");

                
                $times_array = $query->result_array();
                $x=array(
                    'times'=>$times_array
                );
                echo json_encode($x);
                //var_dump ($times_array);
                
            }  
        }
        
        public function _times_arr() 
        {
        $time_aux = strtotime(date('H:i:s',strtotime(date('d-m-Y H:i').'+75 minutes')));
        
        
        $min_aux = date("i", $time_aux);
        $times = array();
        if ($min_aux >= 30) {
            $time = strtotime(date('H:30:00', $time_aux));
        }else{
            $time = strtotime(date('H:00:00', $time_aux));
        }
        
        $key_aux = date("g:i:s a",$time);
        //echo $key_aux; die;
        $times[$key_aux] = date("g:i a",$time);
        
        for($i = 1;$i < 48;$i++) {
            $time = strtotime("+ 30 minutes",$time);
            $key = date("H:i:s",$time);
            $times[$key] = date("g:i a",$time);
            if ($key === LIMITTIME ){
                break;
            }
        }
        return $times;
        }
}



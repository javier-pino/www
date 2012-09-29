<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends TD_Controller {
        
        public function index()
        {
         
            $data['title'] = '.::TuDescuentón.com::..';
            $data['css_files'] = array('css/index.min.css', 
                                'css/header.css', 
                                'css/nav_tdmarcas.css', 
                                'css/coin-slider.css',
                                'css/fonts.css',
                                'css/style.css',
                                'css/socialNetworks.css');
            $data['js_files'] = array('js/jquery-1.7.2.js',
                                'js/coin-slider.js',
                                'js/ajax.js',
                                'js/utilities.js');
            
            $data['image_url'] = 'http://localhost/static/';
            
            $today_time = strtotime(date('d-m-Y'));
            $today_date = (string) date('d/m/Y', $today_time);
            
            $data['cuisine'] = $this->_get_cuisine();
            $data['citys'] = $this->_get_citys();
            
            $data['home_list'] = $this->_home_list($today_time, $today_date);
            $count_home_list = count($data['home_list']);
            $data['bottom_list'] = $this->_bottom_list($today_time, $today_date);
            
            
            for ($i=0;$i<$count_home_list;$i++){
                $data['home_list'][$i]['times'] = $this->_get_time_current($data['home_list'][$i]['team_id'], $today_date);
                $data['home_list'][$i]['image'] = $this->_get_team_image($data['home_list'][$i]['team_id'], 1);
            }
                        
            $this->load->view('header', $data);
            $this->load->view('header_td');
            $this->load->view('main_content');
            $this->load->view('footer');            
        }
        
        public function _home_list($today_time, $today_date)
        {
            
            $fecha_aux = mktime(date("H"), date("i")+ADDMINUTES, date("s"), date("m"), date("d"), date("Y"));
            $now = strtotime (date("d-m-Y H:i:s", $fecha_aux));
            
            $query = $this->db->query("SELECT `t_reservas`.`team_id`,`local`.`local_name`, `partner`.`cuisine`, `team`.`url_title`
                                    FROM `local`
                                    JOIN `partner` on `partner`.`id` = `local`.`partner_id`
                                    JOIN `t_reservas` on `t_reservas`.`local_id` = `local`.`id`
                                    JOIN `t_booking` on `t_booking`.`id_team` = `t_reservas`.`team_id`
                                    JOIN `team` on `team`.`id` = `t_reservas`.`team_id`
                                    WHERE `t_reservas`.`date_fin` > '$today_time'
                                    and `t_booking`.`date` >= $now
                                    and from_unixtime(`t_booking`.`date`, '%d/%m/%Y') = '$today_date'
                                        and (`t_booking`.`availability` - `t_booking`.`now`) > 0
                                    GROUP BY `t_reservas`.`team_id`
                                    LIMIT 4");

            
            
            
            return $query->result_array();
            
        }
        
        public function _bottom_list($today_time, $today_date)
        {
            
            
            $query = $this->db->query("SELECT `t_reservas`.`team_id`,`local`.`local_name`,`local`.`location`, `partner`.`cuisine`, `team`.`url_title`
                                    FROM `local`
                                    JOIN `partner` on `partner`.`id` = `local`.`partner_id`
                                    JOIN `t_reservas` on `t_reservas`.`local_id` = `local`.`id`
                                    JOIN `t_booking` on `t_booking`.`id_team` = `t_reservas`.`team_id`
                                    JOIN `team` on `team`.`id` = `t_reservas`.`team_id`
                                    WHERE `t_reservas`.`date_fin` > '$today_time'
                                        and (`t_booking`.`availability` - `t_booking`.`now`) > 0
                                    GROUP BY `t_reservas`.`team_id`
                                    LIMIT 4");

            
            
            
            return $query->result_array();
            
        }
        
        public function _get_time_current($id_team, $fecha)
        {
                date_default_timezone_set('America/Caracas');
                
                
                $Fecha = mktime(date("H"), date("i")+45, date("s"), date("m"), date("d"), date("Y"));
                $now = strtotime (date("d-m-Y H:i:s", $Fecha));
                //echo $now; die;
                $query = $this->db->query("SELECT from_unixtime(`t_booking`.`date`, '%h:%i %p') time,
                                        FROM_UNIXTIME(  `t_booking`.`date` ,  '%d/%m/%Y' ) AS date_url
                                        FROM `t_booking` 
                                        WHERE id_team = '$id_team'
                                        and from_unixtime(`t_booking`.`date`, '%d/%m/%Y') = '$fecha'
                                        and `t_booking`.`date` >= $now
                                        and (`t_booking`.`availability` - `t_booking`.`now`) > 0
                                        LIMIT 3");

                
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
        
}

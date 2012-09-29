<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends TD_Controller {

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
                      
            redirect('/home/', 'refresh');
        }
        
        public function first_step()
        {
                      
            $this->load->view('box_reserve_01');
        }
        
        public function second_step()
        {
            
            $data['reservas'] = ($_POST['reservas']);
            $bookings_array = json_decode($_POST['bookings']);
            $data['date_ini'] = $bookings_array->date_ini;
            $data['date_fin'] = $bookings_array->date_fin;
            
            //var_dump($bookings_array->bookings[0]);die;
            
            $i_count = count ($bookings_array->bookings);
            
            if ($i_count == 0){
                $data['unavailableDates_aux'] = '';
            }else{
                for ($i=0;$i<$i_count;$i++){
                    $unavailableDates[$i] = "'".(string) date("j-n-Y",(strtotime($bookings_array->bookings[$i]->date_unavailable)))."'";
                }
            
                $data['unavailableDates_aux'] = implode(",", $unavailableDates); 
            }                       
            
            $this->load->view('box_reserve_02', $data);
        }
        
        public function third_step()
        {
            //$times_array = json_decode($_POST['times']);
            //var_dump($times_array); die;
            $data['reservas'] = ($_POST['reservas']);
            
            $times_array = json_decode($_POST['times'], TRUE);
            $data['i_count'] = count($times_array['times']);
            
            $data['time_available'] = $times_array;
            
            $this->load->view('box_reserve_03', $data);
        }
        public function loader()
        {
                      
            $this->load->view('loader');
        }
        
}


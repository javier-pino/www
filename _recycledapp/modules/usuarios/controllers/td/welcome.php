<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends TD_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    
         
                $this->em = $this->doctrine->em; //Instantiate a Doctrine Entity Manager
                $this->qb = $this->em->createQueryBuilder();
	
		//$team = new models\Team; //CARGAMOS EL MODELO
                $partner = new models\Partner;
                $local = new models\Local;
//		$user->setUsername('oaurdaneta');
//		$user->setPassword('cevp9984');
//		$user->setEmail('oaurdaneta@yahoo.com');
//               
//                $this->em->persist($user);
//                
//                $this->em->flush();
                
                  //$query = $this->em->createQuery("SELECT t FROM models\Team t WHERE t.idTReservas IN (SELECT r.idTReservas FROM models\TReservas r WHERE t.idTReservas = r.idTReservas)");
                    
                  $query = $this->em->createQuery("SELECT t, r FROM models\Team t INNER JOIN t.idTReservas r");
                
//                $offset = (int) 0;
//                $limit = (int) 10;
                $this->qb->select(array('t','r'))
			->from('models\Team', 't')
			->innerJoin('t.idTReservas', 'r');
                
                $query = $this->qb->getQuery();
                
                
                $query = $query->getScalarResult();
		
		$this->load->view('welcome_message', array('query' => $query));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

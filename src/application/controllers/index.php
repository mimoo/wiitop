<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	//	/$tournoi/ << chaque tournoi à son URL à lui

	public function index($tournoi=''){
		echo htmlentities($tournoi);
	}

	public function news($tournoi=''){

	}

	public function rules($tournoi=''){

	}

	public function contact($tournoi=''){
		
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('twig');
	}

	public function index()
	{
		$this->twig->display('accueil.html');
	}
}

/* End of file accueil.php */
/* Location: ./application/controllers/accueil.php */
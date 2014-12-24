<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('twig');
      $this->load->library('form_validation');
      $this->load->helper('url');
	}

   /**
    * validate if language is french, english, german etc...
    * @param  string $str input
    * @return boolean      
    */
   public function _validate_language($str)
   {
      if(in_array($str, array('fr','de','en','it','fi','se','es','ro','pt')))
      {
         return TRUE;
      }
      else
      {
         $this->form_validation->set_message('_validate_language','What kind of language is that!');
         return FALSE;
      }
   }

   /**
    * crée la page si tout est bon ! Sinon affiche le formulaire.
    */
   function _not_numeric($str)
   {
      if(ctype_digit($str))
      {
         $this->form_validation->set_message('_not_numeric', 'The %s field can not be digits only');
         return FALSE;
      }
      else
      {
         return TRUE;
      }
   }
   
	public function index()
	{
		if($_POST){
         /*
         
               array(
                     'field'   => 'language',
                     'label'   => 'language',
                     'rules'   => 'required|callback__validate_language'
                  ),
          */
			
         /* form_validation.rules */
			$config = array(
               array(
                     'field'   => 'name',
                     'label'   => 'name',
                     'rules'   => 'required|min_length[1]|max_length[30]'
                  ),
               array(
                     'field'   => 'namespace',
                     'label'   => 'namespace',
                     'rules'   => 'required|min_length[1]|max_length[20]|is_unique[pages.namespace]|alpha_numeric|callback__not_numeric'
                  ),
               array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'required|is_unique[users.username]|min_length[5]|max_length[20]|alpha_numeric'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|min_length[5]|max_length[20]'
                  ),
               array(
                     'field'   => 'password_conf',
                     'label'   => 'Password',
                     'rules'   => 'required|matches[password]'
                  ),
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email|max_length[100]'
                  )
            );

			$this->form_validation->set_rules($config);

         // erreurs spécifique à bootstrap
         $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

         // si il y a erreur sur le form
			if ($this->form_validation->run() == FALSE)
			{
            $data = array(
               'name' => array($this->input->post('name'),form_error('name')),
               'namespace' => array($this->input->post('namespace'),form_error('namespace')),
               'username' => array($this->input->post('username'),form_error('username')),
               'password' => array(NULL,form_error('password')),
               'password_conf' => array(NULL,form_error('password_conf')),
               'email' => array($this->input->post('email'),form_error('email'))
            );

				$this->twig->display('create.html',$data);
			}
         // on envoit le formulaire
			else
			{
            $this->load->library('ion_auth');
            /* anti spam */
            // a venir, rEcaptchA !
            /* queries   */

            // create page
            $this->db->select('id');
            $this->db->where('official', 1);
            $query = $this->db->get('games');
            $games = $query->result_array();
            $games = array_map('reset', $games);
            $games = json_encode($games);
            
            $insert = array(
               'name' => $this->input->post('name'),
               'namespace' => $this->input->post('namespace'),
               'language' => 'english',
               'theme' => 1,
               'games' => $games
            );
            $this->db->insert('pages',$insert);

            // create user
            $additional_data = array('id_tn' =>  $this->db->insert_id());
            $this->ion_auth->register($this->input->post('username'), $this->input->post('password'), $this->input->post('email'),$additional_data);

            /* output */
				$data = array(
               'namespace' => $this->input->post('namespace')
            );
				$this->twig->display('summary.html',$data);
			}
		}
		else{
			$this->twig->display('create.html');
		}
	
	}

}

/* End of file create.php */
/* Location: ./application/controllers/create.php */
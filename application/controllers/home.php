<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	// CONSTRUCT
	// 
	// check for correct namespace
	// (has to be alphanum, can't be digits only)
	// 
	// get page info in $this->page
	// get page css in $this->page->css
	// get method in $this->page->page
	// 
	public function __construct()
	{
		parent::__construct();

		// loads
		$this->load->library('twig');
		$this->load->model('home_model','home');
		$this->load->model('fetch');

		// check for namespace
		// (have to be alphanumeric (not digit only) and exist as a page)
		$namespace = $this->uri->segment(2);
		$method = $this->uri->segment(3);
		if (!ctype_alnum($namespace) || ctype_digit($namespace) || !$this->fetch->get_page_info($namespace))
		{
			echo 'bad namespace';
			exit;
		}

		if(empty($method)) $method = 'index';

		$this->page = $this->fetch->get_page_info($namespace);
		$this->page->page = $method;
		$this->page->css = $this->fetch->get_css($this->page->theme);
	}

	// INDEX
	// 
	// display tree if tournament.live == 2
	// display teams if tournament.live == 1
	// display something else if page.live == 0
	// 
	public function index($tournoi){
		$data = array();

		// a tournament is live ?
		// $this->page->live == 1
		// 
		if($this->page->live > 0)
		{
			// fetch
			$tournament = $this->fetch->get_tournament_info($this->page->id);

			$game_info = $this->fetch->get_game_info($tournament->id_game);

			// get teams
			$teams = $this->fetch->get_tournament_data($this->page->id, 'teams');

			// output
			$data = array(
				'teams' => $teams,
				'game' => $game_info,
				'tournament' => $tournament,
				'page' => $this->page
			);

			// tree
			if($tournament->live == 2)
			{

				// get maps
				if($game_info->maps == 1)
				{
					$maps_list = $this->fetch->get_game_data($tournament->id_game);
					$maps = $this->fetch->get_tournament_data($this->page->id, 'maps');
				}
				else
				{
					$maps_list = false;
					$maps = false;
				}

				// get tree
				$tree = $this->fetch->get_tournament_data($this->page->id, 'tree');

				// output
				$data['tree'] = $tree;
				$data['maps'] = $maps;
				$data['maps_list'] = $maps_list;

				$this->twig->display('tn/'.$tournament->slots.'slots.html', $data);
			}
			elseif($tournament->live == 1)
			{
				$this->twig->display('tn/live.html', $data);
			}
			
		}
		else
		{
			// display news ?
			// atm display last tournament
			// 
			// fetch
			$tournament = $this->fetch->get_tournament_info($this->page->id, false);
			if(!empty($tournament))
			{
				$game_info = $this->fetch->get_game_info($tournament->id_game);
				// get maps
				if($game_info->maps == 1)
				{
					$maps_list = $this->fetch->get_game_data($tournament->id_game);
					$maps = $this->fetch->get_tournament_data($this->page->id, 'maps');
				}
				else
				{
					$maps_list = false;
					$maps = false;
				}
				// get teams
				$teams = $this->fetch->get_tournament_data($this->page->id, 'teams');
				$tree = $this->fetch->get_tournament_data($this->page->id, 'tree');

				// output
				$data = array(
					'maps_list' => $maps_list,
					'maps' => $maps,
					'tree' => $tree,
					'teams' => $teams,
					'game' => $game_info,
					'tournament' => $tournament,
					'page' => $this->page
				);

				$this->twig->display('tn/live.html', $data);
			}
			else
			{
				
				// output
				$data = array(
					'page' => $this->page
				);

				$this->twig->display('tn/template.html', $data);
			}
			
		}

	}

	// news
	public function news($tournoi){
		echo 'news pour tournoi '.htmlentities($tournoi);
	}

	// rules
	public function rules($tournoi){
		echo 'rules pour '.htmlentities($tournoi);
	}

	// contact
	public function contact($tournoi){
		echo 'contact pour tournoi '.htmlentities($tournoi);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
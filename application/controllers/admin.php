<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/*
	 * Before each page : 
	 * check if the namespace is alphanumeric (not digit only)
	 * check if it's a real namespace
	 * check if the user is logged
	 * yes -> check if the user is logged on the right page
	 * no  -> redirect towards login page
	 * 
	 */
	public function __construct()
	{
		parent::__construct();

		// loads
		$this->load->library('twig');
		$this->load->library('ion_auth');
		$this->load->helper('url');
		$this->load->model('admin_model','admin');
		$this->load->model('fetch');

		// check for namespace
		// (have to be alphanumeric (not digit only) and exist as a page)
		$namespace = $this->uri->segment(2);
		$method = $this->uri->segment(3);
		if (!ctype_alnum($namespace) || ctype_digit($namespace) || !$this->fetch->get_page_info($namespace, 'id'))
		{
			echo 'bad namespace';
			exit;
		}

		// not logged?
		// if yes, on the login page?
		if(!$this->ion_auth->logged_in() && $method != 'login')
		{
			redirect('/admin/'.$namespace.'/login');
			exit;
		}

		// get info of page, always usefull
		// get it only if logged in!
		if($this->ion_auth->logged_in())
		{

			$this->page = $this->fetch->get_page_info($this->ion_auth->user()->row()->id_tn);
			if(empty($method)) $method = 'index';
			$this->page->page = $method;
			
			// at the right place though?
			if($namespace != $this->page->namespace)
			{
				echo 'you are not at the right place, this is the right place : '.'www.wiitop.net/admin/'.$this->page->namespace.'/';
				exit;
			}
		}
	}

	/*
	 * Home
	 */
	public function index($namespace)
	{

		// update
		$this->load->helper('time2str');
		$update = $this->fetch->get_update();

		$update->date = time2str($update->date);

		// output
		$data = array(
			'update' => $update,
			'namespace' => $namespace,
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);

		$this->twig->display('admin/home.html', $data);
	}

	public function set_tn($namespace)
	{
		// tournament already occuring ?
		
		if($this->page->live == 1)
		{
			
			redirect('/admin/'.$namespace.'/register_teams/');
		}
		if($this->page->live == 2)
		{
			
			redirect('/admin/'.$namespace.'/edit_tree/');
		}

		// trying to set tournament
		if($_POST)
		{
			
			// check first that there is no other tournaments occuring
			if($this->page->live > 0){
				echo "there is already a tournament occuring";
				exit;
			}

			// okay let's check the form first
			$this->load->library('form_validation');

			$config = array(
               	array(
	                 'field'   => 'game',
	                 'label'   => 'Game',
	                 'rules'   => 'required|numeric'
              	),
	           	array(
	                 'field'   => 'slots',
	                 'label'   => 'Slots',
	                 'rules'   => 'required|numeric'
              	)
            );

			$this->form_validation->set_rules($config); 

			if ($this->form_validation->run() == FALSE)
			{
				echo 'error';
				exit;
			}

			// update "pages"
			$live = ($this->input->post('noteams') == 1)? 2 : 1;
			$update = array('live' => $live);
			$this->db->where('id', $this->page->id);
			$this->db->update('pages', $update);

			// insert into "tournaments"
			$insert = array(
				'id_page' => $this->page->id,
				'id_game' => $this->input->post('game'),
				'date' => date("Y-m-d H:i:s"),
				'slots' => $this->input->post('slots'),
				'live' => 1
				);

			$this->db->insert('tournaments', $insert);

			// redirect !
			redirect('/admin/'.$namespace.'/register_teams/');
			exit;
		}

		// get games
		$games = $this->admin->get_games($this->page->id);

		// output
		$data = array(
			'games' => $games,
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);

		$this->twig->display('admin/set_tn.html', $data);
	}

	public function register_teams($namespace)
	{
		// fetchings datas
		$teams = $this->fetch->get_tournament_data($this->page->id, 'teams');
		$pictures = $this->admin->get_pictures();
		$tournament = $this->fetch->get_tournament_info($this->page->id);
		$game_info = $this->fetch->get_game_info($tournament->id_game);

		// trying to post ?
		if($_POST)
		{
			$players = array();
			if($game_info->players >1)
			{
				for($i=1;$i<=$game_info->players;$i++)
				{
					$players[$i] = $this->input->post('player_'.$i);
				}
			}
			$team = array(
				'name' => $this->input->post('name'),
				'server' => $this->input->post('server'),
				'picture' => $this->input->post('picture'),
				'players' => $players
			);
			$teams[] = $team;
			$this->admin->update_tournament_data($this->page->id, 'teams', $teams);

			// check if slots are full
			if($tournament->slots == sizeof($teams))
			{
				// yes ?
				// update page
				$update = array('live' => 2);
				$this->db->where('id', $this->page->id);
				$this->db->update('pages', $update);

				//  scramble maps
				if($game_info->maps == 1)
				{
					$maps_array = $this->fetch->get_game_data($tournament->id_game);
					$rand = array(8 => 3, 16 => 4, 32 => 5);
					$rand = $rand[$tournament->slots];

					// uniquement s'il y a assez de maps pour ça
					if($rand <= sizeof($maps_array))
					{
						$random_maps = array_rand($maps_array, $rand);
						$this->admin->update_tournament_data($this->page->id, 'maps', $random_maps);
					}	
				}

				// scramble teams
				$tree = array();
				$tree[0] = '';
				foreach($teams as $key => $team)
				{
					$tree[] = array(
						'id' => $key
					);
				}

				$this->admin->update_tournament_data($this->page->id, 'tree', $tree);

				//redirect to bracket edit
				redirect('/admin/'.$namespace.'/edit_tree/');	
			}
		}

		// output
		$data = array(
			'tournament' => $tournament,
			'game_info' => $game_info,
			'teams' => $teams,
			'pictures' => $pictures,
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);

		$this->twig->display('admin/register_teams.html', $data);	
	}

	public function delete_team($namespace, $team_id)
	{
		$teams = $this->fetch->get_tournament_data($this->page->id, 'teams');
		unset($teams[(int)$team_id]);
		$this->admin->update_tournament_data($this->page->id, 'teams', $teams);
		redirect('/admin/'.$namespace.'/register_teams/');
	}

	public function edit_tree($namespace)
	{
		// what kind of tree?
		// is it live ?
		$tournament = $this->fetch->get_tournament_info($this->page->id);
		$game_info = $this->fetch->get_game_info($tournament->id_game);

		// get teams
		$teams = $this->fetch->get_tournament_data($this->page->id, 'teams');

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
		// posting ? 
		if($_POST)
		{
			// maps
			if($game_info->maps == 1)
			{
				$rounds = array(8 => 3, 16 => 4, 32 => 5);
				$maps = array();
				for($i = 0; $i < $rounds[$tournament->slots]; $i++)
				{
					$maps[] = $this->input->post('map'.$i);
				}
				$this->admin->update_tournament_data($this->page->id, 'maps', $maps);
			}
			// tree
			$tree = array();
			$rounds = array(8 => 15, 16 => 31, 32 => 63);
			for($i = 1; $i <= $rounds[$tournament->slots]; $i++)
			{
				$tree[$i] = array(
					'id' => $this->input->post('team'.$i),
					'score' => $this->input->post('score'.$i)
				);
			}
			$this->admin->update_tournament_data($this->page->id, 'tree', $tree);
		}
		else
		{
			// get tree
			$tree = $this->fetch->get_tournament_data($this->page->id, 'tree');
		}
		
		// output
		$data = array(
			'teams' => $teams,
			'maps_list' => $maps_list, // la liste des maps selon settings
			'maps' => $maps, // la liste des maps du tn
			'tree' => $tree,
			'game' => $game_info,
			'tournament' => $tournament,
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);

		$this->twig->display('admin/'.$tournament->slots.'slots_tree.html', $data);
	}

	public function change_tree_state($namespace, $state)
	{
		$state = ($state == 2)? 2 : 1;
		$this->admin->change_tree_state($this->page->id, $state);
		redirect('/admin/'.$namespace.'/edit_tree/');
	}

	public function end_tn($namespace)
	{
		// is there a tournament occuring ?
		if($this->page->live == 0) exit;
		
		$this->admin->end_tn($this->page->id);
	
		redirect('/admin/'.$namespace);
	}

	public function edit_tn($namespace)
	{
		// trying to update infos?
		if($_POST)
		{
			$this->db->where('id_page', $this->page->id);
			$this->db->where('live >', 0);
			$this->db->update('tournaments', $_POST);
		}
		// fetch informations about current tournament settings
		$games = $this->admin->get_games($this->page->id);
		$tournament = $this->fetch->get_tournament_info($this->page->id);
		// output
		$data = array(
			'tournament' => $tournament,
			'games' => $games,
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);

		$this->twig->display('admin/edit_tn.html', $data);
	}


	public function cancel_tn($namespace)
	{
		$this->admin->cancel_tn($this->page->id);
		redirect('/admin/'.$namespace.'/');
		exit;
	}

	public function edit_page($namespace)
	{
		if($_POST)
		{
			// check if name is alphanumeric AND not numeric !
			if(ctype_digit($this->input->post('name') || !ctype_alnum($this->input->post('name')))) exit;
			$update = array('name' => $this->input->post('name'),
				'update_onchange' => $this->input->post('update_onchange'));
			$this->db->where('id', $this->page->id);
			$this->db->update('pages', $update);

			$this->page->name = $this->input->post('name');
			$this->page->update_onchange = $this->input->post('update_onchange');
		}
		
		$data = array(
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);
		$this->twig->display('admin/edit_page.html', $data);
	}

	public function manage_games($namespace)
	{
		$games = $this->admin->get_games_list($this->page->id);
		$official_games = $this->admin->get_official_games_list();
		$data = array(
			'games' => $games,
			'official_games' => $official_games,
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);
		$this->twig->display('admin/manage_games.html', $data);
	}

	public function add_game($namespace)
	{
		if($_POST)
		{
			// add in "games"
			$this->admin->add_game($this->page->id, $_POST);
			$id_game = $this->db->insert_id();
			
			// add in "pages"
			$games = $this->fetch->get_page_data($this->page->id);
			$games[] = $id_game;
			$this->admin->update_page_data($this->page->id, $games);

			// redirect
			redirect('/admin/'.$namespace.'/edit_game/'.$id_game.'/');
		}
	}

	public function edit_game($namespace, $id_game=FALSE)
	{
		// check id_game from form or urldecode(str)
		if(!$id_game)
		{
			$id_game = $this->input->post('edit');
		}
		if(!is_numeric($id_game)) exit;

		// is it in our game_list ?
		$games = $this->admin->get_games_list($this->page->id);
		$games = array_map("reset", $games);
		if(!in_array($id_game, $games))
		{
			echo 'not your game !';
			exit;
		}

		$game = $this->fetch->get_game_info($id_game);
		$game->data = $this->fetch->get_game_data($id_game);

		$maps = $this->fetch->get_game_data($id_game);
		$game->number_maps = sizeof($maps);

		$data = array(
			'maps' => $maps,
			'game' => $game,
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);
		$this->twig->display('admin/edit_game.html', $data);
	}

	public function edit_game_do($namespace)
	{
		if($_POST)
		{

			// check form
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'name', 'required|alphanumeric|max_length[15]');
			$this->form_validation->set_rules('maps', 'maps', 'numeric');
			$this->form_validation->set_rules('servers', 'servers', 'numeric');
			$this->form_validation->set_rules('scores', 'scores', 'numeric');
			$this->form_validation->set_rules('players', 'players', 'numeric');

			$data = array(
				'page' => $this->page,
				'username' => $this->ion_auth->user()->row()->username
			);

			if ($this->form_validation->run() == FALSE)
			{
				$data['game'] = $this->input->post;
				$this->twig->display('admin/edit_game.html', $data);
			}
			else
			{
				$id_game = $this->input->post('edit');
				//
				// is this official ?
				//
				$info = $this->fetch->get_game_info($id_game);
				if($info->official == 1)
				{
					// create new copy
					$this->admin->add_game($this->page->id, $_POST);
					$id_game = $this->db->insert_id();
					// add the game in the page's list
					$games = $this->fetch->get_page_data($this->page->id);
					$games[] = $id_game;
					$this->admin->update_page_data($this->page->id, $games);
					
				}
				//
				// not official
				// 
				else
				{
					// update game info
					$this->admin->update_game_info($id_game, $_POST);
				}
				//
				// new maps !
				//
				if($this->input->post('number_maps') > 0)
				{

					$maps = array();

					for($i = 1; $i <= $this->input->post('number_maps') ; $i ++)
					{
						$map_name = $this->input->post('map_name_'.$i, TRUE);
						$map_url = $this->input->post('map_url_'.$i, TRUE);
						if(!empty($map_name) && !empty($map_url))
						{
							$maps[] = array(
								'name' => $map_name,
								'url' => $map_url
							);
						}
					}

					$this->admin->update_game_data($id_game, $maps);

				}
				
				// redirect
				redirect('/admin/'.$namespace.'/edit_game/'.$id_game.'/');
			}
		}
	}


	public function add_official_game($namespace)
	{

		$games = $this->fetch->get_page_data($this->page->id);
		if(!in_array($this->input->post('add'), $games) && is_numeric($this->input->post('add')))
		{
			$games[] = $this->input->post('add');
		}
		$this->admin->update_page_data($this->page->id, $games);
		
		redirect('/admin/'.$namespace.'/manage_games/');
	}

	public function remove_game($namespace, $id_game)
	{
		$games = $this->fetch->get_page_data($this->page->id);
		if(($key = array_search($id_game, $games)) !== false) {
		    unset($games[$key]);
		}
		$this->admin->update_page_data($this->page->id, $games);
		
		redirect('/admin/'.$namespace.'/manage_games/');
	}

	public function changelog($namespace, $id)
	{
		$this->load->helper('time2str');
		
		$update = $this->fetch->get_update($id);
		$update->date = time2str($update->date);

		$data = array(
			'update' => $update,
			'page' => $this->page,
			'username' => $this->ion_auth->user()->row()->username
		);
		$this->twig->display('admin/changelog.html', $data);
	}

	/*
	 * login page
	 */
	public function login($namespace)
	{
		// already logged ?
		if($this->ion_auth->logged_in())
		{
			redirect('/admin/'.$namespace.'/');
		}

		// posting form
		if($_POST)
		{
			// trying to login
			$rememberme = (bool) $this->input->post('rememberme');

			if($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $rememberme))
			{
				// is it the right tournament?
				if($this->ion_auth->user()->row()->id_tn != $this->fetch->get_page_info($namespace,'id')->id)
				{
					echo 'good logins, but not for this page.';
					$this->ion_auth->logout();
					exit;
				}
				else{
					redirect('/admin/'.$namespace.'/');
				}
			}

		}
		$name = $this->fetch->get_page_info($namespace, 'name')->name;
		$data = array('name' => $name);
		$this->twig->display('admin/login.html', $data);
	}

	/*
	 * logout page
	 */

	public function logout($namespace)
	{
		$this->ion_auth->logout();
		redirect('/admin/'.$namespace.'/login/');
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
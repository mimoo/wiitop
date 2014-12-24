<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public $type_tournament_data = array('teams', 'maps', 'tree');
	
	// update page games
	public function update_page_data($page_id, $data)
	{
		$data = json_encode($data);
		$update = array('games' => $data);
		$this->db->where('id', $page_id);
		$this->db->update('pages', $update);
	}

	// supprime un tournoi
	function cancel_tn($id_tn)
	{
		// erase "tournaments" entry
		$this->db->where('id_page', $id_tn);
		$this->db->where('live', 1);
		$this->db->delete('tournaments');
		// update "page"
		$this->db->where('id', $id_tn);
		$set = array('live' => 0);
		$this->db->update('pages', $set);
	}

	// retourne la liste de jeux officiel + ceux de la page
	public function get_games($id_tn)
	{
		$this->db->select('id, name');
		$this->db->where('official', 1);
		$this->db->or_where('id_tn', $id_tn);
		$this->db->from('games');
		$query = $this->db->get();
		return $query->result();
	}


	

	// update tournament data
	public function update_tournament_data($id_page, $type, $data)
	{

		if(in_array($type, $this->type_tournament_data))
		{
			$type = 'data_'.$type;
			$data = json_encode($data);
			$update = array($type => $data);
		}
		else
		{
			return false;
		}
		$this->db->where('id_page', $id_page);
		$this->db->where('live >',0);
		$this->db->update('tournaments', $update);
		return TRUE;
	}

	// get icons from a folder
	public function get_pictures()
	{
		$this->load->helper('directory');
		$maps = directory_map('./images/icones/');

		function get_rid_of_gif(&$item, $key)
		{
		    $item = preg_replace('#.gif#', '', $item);
		}
		array_walk($maps, 'get_rid_of_gif');

		return $maps;
	}

	// set tree live
	public function change_tree_state($page_id, $state)
	{
		$update = array('live' => $state);
		$this->db->where('id_page', $page_id);
		$this->db->where('live >', 0);
		$this->db->update('tournaments', $update);
	}

	// get game list
	public function get_games_list($id_page)
	{
		// get games from the page
		$this->db->select('games');
		$this->db->where('id', $id_page);
		$this->db->from('pages');
        $query = $this->db->get();
        $games = $query->row()->games;
        $games = json_decode($games, TRUE);
        // get info about those games
        if(empty($games)) return false;
        $this->db->select('id, name, official');
        $this->db->from('games');
        $this->db->where_in('id', $games);
        $query = $this->db->get();
        return $query->result_array();
	}

	public function get_official_games_list()
	{
		$this->db->select('id, name');
		$this->db->where('official', 1);
		$this->db->from('games');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_game($id_page, $data)
	{
		$insert = array(
			'official' => 0,
			'name' => $data['name'],
			'id_tn' => $id_page,
			'players' => $data['players'],
			'servers' => $data['servers'],
			'maps' => $data['maps'],
			'scores' => $data['scores']
		);
		$this->db->insert('games', $insert);
	}

	public function update_game_info($id_game, $data)
	{
		$update = array(
			'name' => $data['name'],
			'players' => $data['players'],
			'servers' => $data['servers'],
			'maps' => $data['maps'],
			'scores' => $data['scores']
		);
		$this->db->where('id', $id_game);
		$this->db->update('games', $update);
	}

	public function update_game_data($id_game, $data)
	{
		$data = json_encode($data);
		$update = array('data' => $data);
		$this->db->where('id', $id_game);
		$this->db->update('games', $update);
	}

	public function end_tn($id_page)
	{
		$this->db->where('id', $id_page);
		$this->db->update('pages', array('live' => 0));
		
		$this->db->where('id_page', $id_page);
		$this->db->where('live >', 0);
		$this->db->update('tournaments', array('live' => 0));

		return TRUE;
	}

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */
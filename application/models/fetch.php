<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fetch extends CI_Model {

	public $type_tournament_data = array('teams', 'maps', 'tree');

	// renvoit une info sur un namespace (id/str), sinon TOUT
	public function get_page_info($page, $info=NULL)
	{
		if(in_array($info, array('id','name','live')))
		{
			$this->db->select($info);
		}
		$this->db->from('pages');
		if(is_numeric($page))
		{
			$this->db->where('id', $page);
		}
		else
		{
			$this->db->where('namespace', $page);
		}
		$query = $this->db->get();
		return ($query->num_rows() == 0)? FALSE : $query->row();
	}

	public function get_page_data($page_id)
	{
		$this->db->select('games');
		$this->db->from('pages');
		$this->db->where('id', $page_id);
		$query = $this->db->get();
		$data = $query->row()->games;
		return json_decode($data, TRUE);
	}


	// chope les infos d'un tournoi en cours
	function get_tournament_info($id_page, $live = TRUE)
	{
		// chope les infos basiques
		$this->db->from('tournaments');
		$this->db->where('id_page', $id_page);
		if($live)
		{
			$this->db->where('live >',0);
		}
		else
		{
			$this->db->limit(1);
			$this->db->order_by('id', 'desc');
		}
		$this->db->select('id, id_game, slots, live');
		$query = $this->db->get();
		return $query->row();
	}

	// fetch game info
	public function get_game_info($id_game)
	{
		$this->db->select('id, name, official, players, servers, maps, scores');
		$this->db->from('games');
		$this->db->where('id', $id_game);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_game_data($id_game)
	{
		$this->db->select('data');
		$this->db->where('id', $id_game);
		$this->db->from('games');
		$query = $this->db->get();
		$data = json_decode($query->row()->data, TRUE);
		return $data;
	}
	// fetch tournament data
	// return array
	public function get_tournament_data($id_page, $type)
	{
		if(in_array($type, $this->type_tournament_data))
		{
			$type = 'data_'.$type;
			$this->db->select($type);
		}
		else
		{
			return FALSE;
		}
		$this->db->from('tournaments');
		$this->db->where('id_page', $id_page);
		$this->db->where('live >',0);
		$query = $this->db->get();
		$data = json_decode($query->row()->{$type}, TRUE);
		return $data;
	}

	public function get_update($id=NULL)
	{
		if(is_numeric($id))
		{
			$this->db->where('id', $id);
		}
		else
		{
			$this->db->limit(1);
			$this->db->order_by('id', 'desc');
		}
		$this->db->from('updates');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_css($id)
	{
		$this->db->select('css');
		$this->db->where('id', $id);
		$this->db->from('themes');
		$query = $this->db->get();
		return $query->row()->css;
	}

}

/* End of file fetch.php */
/* Location: ./application/models/fetch.php */
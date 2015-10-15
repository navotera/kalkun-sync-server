<?php
/**
 * Kalkun
 * An open source web based SMS Management
 *
 * @package		Kalkun
 * @author		Kalkun Dev Team
 * @license		http://kalkun.sourceforge.net/license.php
 * @link		http://kalkun.sourceforge.net
 */

// ------------------------------------------------------------------------

/**
 * Sync_server_model Class
 *
 * Handle all plugin database activity 
 *
 * @package		Kalkun
 * @subpackage	Plugin
 * @category	Models
 */
class Sync_server_model extends Model {

	private $table = 'plugin_sync_server';

/*	private $db_type = 'mysql';
	private $db_host = 'localhost';
	protected $db_name = 'rcp';
	protected $db_username = 'root';
	protected $db_password = '';
*/

	
	function Sync_server_model()
	{
		parent::Model();
	}	


	/*function connection()
	{
		try {
		    $conn = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.'',$this->db_username,$this->db_password); 
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return $conn;
		} catch(PDOException $e) {
		    return $conn;
		}
	}*/
	


	function get_rest_server_url()
	{
		$this->db->select('rest_server_url');
		return $result = $this->_get();

	}



	/*function sync($data)
	{
		$conn = $this->connection();
		 $stmt = $conn->prepare('SELECT * FROM area');
		  $stmt->execute();
		 
		  return $result = $stmt->fetchAll();
	}

	function get_unsync()
	{
		$this->db->select('*');
		$this->db->where('status', 0);
		return $this->_get();
	}*/


	function insert_new_msg($data)
	{
		if($data['id_inbox'])
		{
			$this->db->insert($this->table,$data);
		}
	}


	
	function simpan_rest_server_url($data)
	{
		return $this->_save($data);			
	}

	function update()
	{
		$data = array (
				'phone_number' => trim($this->input->post('editphone_number',TRUE)),
				'reason' => $this->input->post('editreason',TRUE),
					);
		$this->db->where('id_blacklist_number', $this->input->post('editid_blacklist_number',TRUE));			
		$this->db->update('plugin_blacklist_number',$data);
	}	
	
	function delete($id)
	{
		$this->db->delete('plugin_blacklist_number', array('id_blacklist_number' => $id)); 
	}



//----------------------------------------------------------




	private function _get($table=0)
	{
		$table || $table = $this->table;
		$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{
			return $query;
		}
			return FALSE;

	}


	private function _get_query($sql)
	{
		 $query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
			return FALSE;
		
	}


private function _get_querys($sql)
	{
		 $query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query;
		}
			return FALSE;
		
	}



	private function _save($object, $table=0)
	{
		$table || $table = $this->table;

		 $this->db->insert($table, $object);

		if ($this->db->affected_rows() >= '1')
		{
			return TRUE;
			$query->free_result();
		} 

		return FALSE; // FALSE = "";
		$query->free_result();
	}

	private function _update($table=0)
	{ 
		$table || $table = $this->table;
		$query = $this->db->update($table); 	
		if ($this->db->affected_rows() >= '1')
		{
			return TRUE;
			$query->free_result();
		}
		
		return FALSE; // FALSE = "";
		$query->free_result();
	}
	

	private function _delete($id=0,$table)
	{
		$table || $table = $this->table;

		 $this->db->where('id', $id);
		 $this->db->delete($table);

		if ($this->db->affected_rows() >= '1')
		{
			return TRUE;
			$query->free_result();
		} 

		return FALSE; // FALSE = "";
		$query->free_result();
	}


}

/* End of file blacklist_number_model.php */
/* Location: ./application/plugins/blacklist_number/models/blacklist_number_model.php */
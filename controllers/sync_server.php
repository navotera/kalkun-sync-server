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
 * Sync_server Class
 *
 * @package		Kalkun
 * @subpackage	Plugin
 * @category	Controllers
 */
include_once(APPPATH.'plugins/Plugin_Controller.php');


class Sync_server extends Plugin_Controller {
	
	function Sync_server()
	{
		parent::Plugin_Controller();		
		$this->load->model('Kalkun_model');
		$this->load->model('sync_server_model', 'plugin_model');
		
	}
	
	function index()
	{
		//include_once(APPPATH.'plugins/sync_server/config/sync_server_config.php');
	

		$data['rest_server_url'] = $this->plugin_model->get_rest_server_url();
		$data['main'] = 'index';
		
		
		$this->load->view('main/layout', $data);

		
	}

	function post_rest_server_url()
	{
		$data['rest_server_url'] = $this->input->post('rest_server_url');
		$result = $this->plugin_model->simpan_rest_server_url($data);
		if($result)
		{
			redirect(site_url().'/sync_server');
		}
	}
	
	function sync_to_server($id)
	{
		
		
		//get data from plugin_sync_server where status : 0
		var_dump($this->plugin_model->get_unsync());





		//ambil pesannya saja

		//extract format pesannya adalah : user_id:10 area:222 z:10 s:20 m:22



		//


		$this->plugin_model->delete($id);
		redirect('plugin/blacklist_number');
	}
}
	
/* End of file blacklist_number.php */
/* Location: ./application/plugins/blacklist_number/controllers/blacklist_number.php */
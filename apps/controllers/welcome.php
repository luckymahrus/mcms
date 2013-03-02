<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->helper('url');
		$this->load->view('welcome_message');
		$this->render();
	}
	
	function _render_page()
	{
		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
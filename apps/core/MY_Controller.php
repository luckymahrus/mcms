<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: MY_Controller
*
* Author: Ben Edmunds
* Created: 7.21.2009
*
* Description: Class to extend the CodeIgniter Controller Class. All controllers should extend this class.
*
*/

class MY_Controller extends CI_Controller
{
	protected $data = Array();
	protected $controller_name;
	protected $action_name;
	protected $previous_controller_name;
	protected $previous_action_name;
	protected $save_previous_url = false;
	protected $page_title;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session','ion_auth','form_validation'));
		$this->load->helper('url');
		
		//save the previous controller and action name from session
		$this->previous_controller_name = $this->session->flashdata('previous_controller_name');
		$this->previous_action_name = $this->session->flashdata('previous_action_name');
		
		//set the current controller and action name
		$this->controller_name = $this->router->fetch_directory() . $this->router->fetch_class();
		$this->action_name = $this->router->fetch_method();
		
		$this->data['content']	= '';
		$this->data['css']		= '';
		$this->data['js']		= '';
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));


		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect('/', 'refresh');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
		}

	}
	
	protected function render($template='main')
	{
		//save the controller and action names in session
		if ($this->save_previous_url)
		{
			$this->session->set_flashdata('previous_controller_name', $this->previous_controller_name);
			$this->session->set_flashdata('previous_action_name', $this->previous_action_name);
		}
		else
		{
			$this->session->set_flashdata('previous_controller_name', $this->controller_name);
			$this->session->set_flashdata('previous_action_name', $this->action_name);
		}
		
		$view_path = $this->controller_name . '/' . $this->action_name . '.php'; //set the path off the view
		if (file_exists(APPPATH . 'views/' . $view_path))
		{
			//$this->data['content'] .= $this->load->parser($view_path, $this->data, true); //load the view
			$this->data['content'] .= $this->parser->parse($view_path, $this->data, true); //load the view
		}
		//echo "<pre>";print_r($this->data);exit;
		//$this->load->parser("$template.tpl.php", $this->data); //load the template
		$this->parser->parse("$template.tpl.php", $this->data); //load the template
	}
	
	protected function add_title()
	{
		$this->load->model('page_model');
		
		//the default page title will be whats set in the controller
		//but if there is an entry in the db override the controller's title with the title from the db
		$page_title = $this->page_model->get_title($this->controller_name,$this->action_name);
		if ($page_title)
		{
			$this->data['title'] = $page_title;
		}
	}
	
	protected function save_url()
	{
		$this->save_previous_url = true;
	}
}
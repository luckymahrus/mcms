<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***
 *
 * DASHBOARD.PHP CONTROLLER 
 *
 * author		: Lucky Mahrus
 * copyright	: Tama Komunika Persada (c) 2012
 * license		: http://www.luckymahrus.com/
 * file			: controllers/userarea/dashboard.php
 * created		: 2013 February 7th / 10:57:00
 * last edit	: 2013 February 7th / 10:57:00
 * edited by	: Lucky Mahrus
 * version		: 2.0
 *
 */

class Dashboard extends MY_Controller
{
	var $what = 'dashboard';

	public function __construct()
	{
		parent::__construct(); 
	} 

	public function index()
	{
		$this->data['baseurl']	= 'sadfkjakhsdkasjdkl';
		$this->render($this->what);
	}
}

/* End of file dashboard.php */
/* Location: ./apps/controllers/userarea/dashboard.php */


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller {

	/** security variables * */
	public $publicAccess = TRUE;
	public $authInfo = array();
	/** end * */

	/** template variables * */
	public $baseLayout;
	public $layoutVars = array();
	public $sections;
	public $title;
	public $active_nav;

	/** end * */
	public function __construct()
	{
		parent::__construct();
		/** load lib and helpers, instead of the config to minimize loading * */
		$this->load->helper('url');
		$this->load->library('form_validation');

		/** set layout * */
		if (!isset($this->baseLayout))
			$this->baseLayout = 'default';
		/** end * */
		$this->IonAuthInit();

		$sections = array(
			'active_nav' => $this->title,
			'title' => $this->title,
			'short_title' => $this->title,
			'content' => null,
			'additional_js' => null,
			'additional_css' => null,
		);

		$this->sections = $sections;
	}

	public function render($sections = array(), $template_name = null, $return = false)
	{
		if ($this->input->is_ajax_request())
		{
			$this->baseLayout = 'ajax';
		}

		if (!isset($template_name) && isset($this->baseLayout))
			$template_name = $this->baseLayout;

		$sections = array_merge($this->layoutVars, $sections);

		$sections['__domain'] = str_replace('.', '_', $_SERVER['HTTP_HOST']);
		$sections['authInfo'] = $this->authInfo;

		return $this->load->view('layouts/' . $template_name, $sections, $return);
	}

	function beforeIonAuth($loggedIn = null)
	{
		$sg = $this->uri->segments;

		if (empty($sg) && count($sg) < 1)
			return;
	}

	function checkIfAdmin($loggedIn)
	{
		$sg = $this->uri->segments;

		if (!empty($sg) && count($sg) > 0 && $sg[1] == 'admin')
		{
			if (!$loggedIn)
			{
				$allowed = false;
				redirect('/auth/login');
			}

			if ($this->publicAccess)
				$allowed = false;

			if (isset($this->authInfo['accessgroup']) && $this->authInfo['accessgroup'] != 'admin')
			{
				$allowed = false;
			}
			else
			{
				$allowed = true;
			}

			if ($allowed === false)
			{
				die('Not Allowed. Not accessible to your group.');
			}
		}
	}

	function IonAuthInit()
	{
		$this->load->library('ion_auth');
		$this->load->model('users_model');

		$isLoggedIn = $this->ion_auth->logged_in();


		$this->beforeIonAuth($isLoggedIn);
		$this->checkIfAdmin($isLoggedIn);

		if ($this->publicAccess == false && !$isLoggedIn)
		{
			$this->session->set_userdata('request_uri', $_SERVER['REQUEST_URI']);
			$this->session->set_flashdata('error', 'Please login to access the requested page.');
			redirect('/auth/login', 'refresh');
			exit;
		}

		if ($isLoggedIn)
		{
			$uid = $this->ion_auth->get_user_id();
			$this->authInfo = $this->users_model->getInfo($uid);

			if (in_array(users_model::group_admins, $this->authInfo['groups']))
			{
				$this->authInfo['accessgroup'] = 'admin';
			}
			elseif (in_array(users_model::group_members, $this->authInfo['groups']))
			{
				$this->authInfo['accessgroup'] = 'member';
			}

			$this->checkIfAdmin($isLoggedIn);

			$this->layoutVars['authInfo'] = $this->authInfo;
		}
	}

}

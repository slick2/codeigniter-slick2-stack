<?php
/**
 * 
 * TODO: put a language file
 * 
 */
class Categories extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('category_model');
	}

	public function index()
	{


		$data = array();
		$data['categories'] = $this->category_model->getAll();
		$data['content'] = $this->load->view('admin/categories/index', $data, TRUE);
		$this->render($data);
	}

	public function create()
	{

		if ($this->form_validation() == TRUE)
		{
			if (!empty($result) && isset($empty))
			{
				$this->session->set_flashdata('message', 'The record has been added.');
			}
			else
			{
				$this->session->set_flashdata('message', 'An error has occured, please try again.');
			}
		}
	}

	public function edit($category_id)
	{
		if ($this->form_validation() == TRUE)
		{
			if (!empty($result) && isset($empty))
			{
				
				$this->session->set_flashdata('message', 'The record has been updated.');
			}
			else
			{
				$this->session->set_flashdata('message', 'An error has occured, please try again.');
			}
		}
	}

	public function remove($category_id)
	{
		
	}

}

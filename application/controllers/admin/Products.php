<?php

/**
 * 
 * TODO: put a language file
 * 
 */
class Products extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('product_model');
	}

	public function index()
	{
		$data = array();
		$data['product'] = $this->product_model->getAll();
		$data['content'] = $this->load->view('admin/products/index', $data, TRUE);
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
		$data = array();
		$data['content'] = $this->load->view('admin/products/create', $data, TRUE);
		$this->render($data);
	}

	public function edit($product_id)
	{
		if (empty($product_id))
			redirect('admin/products');

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
		$data = array();
		$data['content'] = $this->load->view('admin/products/edit', $data, TRUE);
		$this->render($data);
	}

	public function remove($product_id)
	{
		if (empty($product_id))
			redirect('admin/products');
		$data = array();
		$data['content'] = $this->load->view('admin/products/remove', $data, TRUE);
		$this->render($data);
	}

}

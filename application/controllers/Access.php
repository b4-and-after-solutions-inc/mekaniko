<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');

      	$this->load->model('shop_model');
      	$this->load->model('user_model');

	}
	public function error_404(){
    	$cihead['Title'] = '404 Error'; $cihead['Description'] = ''; $cihead['Menu1'] = '';

		$this->load->view('includes/cihead', $cihead);
		$this->load->view('errors/html/error_404_lteci');
		$this->load->view('includes/cifoot');
  	}

	public function login(){
		$this->load->view('login');
	}

	//REGISTER CHOOSE
	public function choosep(){
	  	$this->load->view("choose");
	}

	public function chooses(){

      	$cihead['provinceData'] = $this->shop_model->getProvinceDetails();
      	$cihead['municipalityData'] = $this->shop_model->getMunicipalityDetails();
      	$cihead['barangayData'] = $this->shop_model->getBarangayDetails();
        $this->load->view("shopownerreg",$cihead);
    }

    public function freelance_mekaniko(){

      	$cihead['provinceData'] = $this->shop_model->getProvinceDetails();
      	$cihead['municipalityData'] = $this->shop_model->getMunicipalityDetails();
      	$cihead['barangayData'] = $this->shop_model->getBarangayDetails();
        $this->load->view("freelance_mekaniko_reg",$cihead);
    }

    public function register(){
        $this->load->view("regester");
    }

	public function sign_in(){
		echo $this->user_model->sign_in($this->input->post());
	}
	public function sign_out(){
		$this->user_model->sign_out();
		redirect(base_url().'Access/login/', 'refresh');
	}

}

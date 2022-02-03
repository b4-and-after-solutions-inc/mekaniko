<?php
//controllers
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('shop_model');
      $this->load->model('user_model');
  }
  public function index()
  {
    if($this->session->userdata('cosid')) {
      //FOR SUPER ADMIN INDEX
      if ( $this->session->userdata("role") == 0 ){
        //$cihead['Menu1'] = 'Dashboard';
        //$cihead['Title'] = 'Dashboard'; $cihead['Description'] = ''; $cihead['Menu1'] = 'Dashboard';

        $costumerCount =  $this->shop_model->get_costumerCount();   
        $cihead['totalCostumerCount'] =$costumerCount[0]->count_costumer;

    		$this->load->view('includes/cihead', $cihead);
        $this->load->view('dashboard',$cihead);
    		$this->load->view('includes/cifoot');
      }
      // FOR CUSTOMER INDEX
      else if ( $this->session->userdata("role") == 1 ){
        $cihead['locationAllData'] = $this->shop_model->getLocationAllDetails();
        $this->load->view('includes/cihead', $cihead);
        $this->load->view('dashboard_customer',$cihead);
        $this->load->view('includes/cifoot');
      }
      //FOR OWNER INDEX
       else if( $this->session->userdata("role") == 2 ){
        
        $cihead['locationData'] = $this->shop_model->getLocationDetails();
        $cihead['branchOwnerData'] = $this->shop_model->getBranchOwnerDetails();
        $this->load->view('includes/cihead', $cihead);
        $this->load->view('dashboard_owner',$cihead);
        $this->load->view('includes/cifoot');
      }
      //FOR FREELANCE MEKANIKO INDEX
      else if( $this->session->userdata("role") == 3 ){
        
        $cihead['locationData'] = $this->shop_model->getLocationDetails();
        $cihead['branchOwnerData'] = $this->shop_model->getBranchOwnerDetails(); 

        $this->load->view('includes/cihead', $cihead);
        $this->load->view('dashboard_freelance_mekaniko',$cihead);
        $this->load->view('includes/cifoot');
      }
    }
    else{
      redirect(base_url().'Access/login/', 'refresh');
    }

  }

  // DATA GENERATION
  
  //SYSTEM SETUP
  public function setup_user() {
    if($this->session->userdata('cosid')) {
      $cihead['userData'] = $this->shop_model->getUserDetails();
      $cihead['userCustomerData'] = $this->shop_model->getUserCustomerDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('setup_user',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //SEARCH FREELANCE MEKANIKO
  public function search_freelance_mekaniko() {
    if($this->session->userdata('cosid')) {
      $cihead['locationAllData'] = $this->shop_model->getLocationAllFreelanceDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('dashboard_customer_freelance',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //SHOP MANAGEMENT
  public function view_shop() {
    if($this->session->userdata('cosid')) {
      $cihead['shopData'] = $this->shop_model->getShopDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('view_shop',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //CUSTOMER MANAGEMENT
  public function view_customer() {
    if($this->session->userdata('cosid')) {
      $cihead['customerData'] = $this->shop_model->getCustomerDetailsAdmin();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('view_customer',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //PROVINCE
  public function province() {
    if($this->session->userdata('cosid')) {
      $cihead['provinceData'] = $this->shop_model->getProvinceDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('setup_province',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //MUNICIPALITY
  public function municipality() {
    if($this->session->userdata('cosid')) {
      $cihead['municipalityData'] = $this->shop_model->getMunicipalityDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('setup_municipality',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //BARANGAY
  public function barangay() {
    if($this->session->userdata('cosid')) {
      $cihead['barangayData'] = $this->shop_model->getBarangayDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('setup_barangay',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //CUSTOMER MANAGEMENT
  public function customer() {
    if($this->session->userdata('cosid')) {
      $cihead['customerData'] = $this->shop_model->getCustomerDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('customer_reg_owner',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  public function service_list() {
    if($this->session->userdata('cosid')) {
      $cihead['serviceData'] = $this->shop_model->getServiceDetails();

      $cihead['shopData'] = $this->shop_model->getShopDetails();

      $this->load->view('includes/cihead', $cihead);
      $this->load->view('service_list',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }
  //labor list
  public function labor_list() {
    if($this->session->userdata('cosid')) {
      $cihead['serviceData'] = $this->shop_model->getServiceFreelanceDetails();

      //$cihead['shopData'] = $this->shop_model->getShopDetails();

      $this->load->view('includes/cihead', $cihead);
      $this->load->view('labor_list',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //SERVICE OWNER
  public function service_owner() {
    if($this->session->userdata('cosid')) {
      $cihead['serviceOwnerData'] = $this->shop_model->getServiceOwnerDetails();

      $this->load->view('includes/cihead', $cihead);
      $this->load->view('service_owner',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }



  //ARCHIVED SERVICE OWNER
  public function service_owner_archived() {
    if($this->session->userdata('cosid')) {
      $cihead['serviceOwnerArchivedData'] = $this->shop_model->getServiceOwnerArchivedDetails();

      $this->load->view('includes/cihead', $cihead);
      $this->load->view('service_archived',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //BRANCH OWNER
  public function branch_owner() {
    if($this->session->userdata('cosid')) {
      $cihead['branchOwnerData'] = $this->shop_model->getBranchOwnerDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('branch_owner',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //LOCATION OWNER
  public function location_owner() {
    if($this->session->userdata('cosid')) {
      $cihead['locationData'] = $this->shop_model->getLocationDetails();
      $cihead['branchOwnerData'] = $this->shop_model->getBranchOwnerDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('setup_location',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //LOCATION FREELANCE MEKANIKO
  public function location_freelance_mekaniko() {
    if($this->session->userdata('cosid')) {
      $cihead['locationData'] = $this->shop_model->getLocationDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('setup_location_freelance',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //TRANSACTION LIST OWNER
  public function transaction_list_owner() {
    if($this->session->userdata('cosid')) {
      $cihead['reservationOwnerData'] = $this->shop_model->getReservationOwnerDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('transaction_list_owner',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }

  //TRANSACTION LIST FREELANCE
  public function transaction_list_freelance() {
    if($this->session->userdata('cosid')) {
      $cihead['reservationOwnerData'] = $this->shop_model->getReservationOwnerDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('transaction_list_freelance',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }


  //TRANSACTION CUSTOMER
  public function reservation_customer() {
    if($this->session->userdata('cosid')) {

      $cihead['reservationData'] = $this->shop_model->getReservationCustomerDetails();
      $this->load->view('includes/cihead', $cihead);
      $this->load->view('reservation_customer',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }


  //REPORTS FREELANCE
  public function report_total_sales_freelance() {
    if($this->session->userdata('cosid')) {
      $cihead['reportsData'] = $this->shop_model->getReportsDetails();

      $this->load->view('includes/cihead', $cihead);
      $this->load->view('report_total_sales_freelance',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }


  //REPORTS OWNER
  public function report_total_sales_owner() {
    if($this->session->userdata('cosid')) {
      $cihead['reportsData'] = $this->shop_model->getReportsOwnerDetails();

      $this->load->view('includes/cihead', $cihead);
      $this->load->view('report_total_sales_owner',$cihead);
      $this->load->view('includes/cifoot');
    }
    else{
       redirect(base_url().'Access/login/', 'refresh');
    }
  }



  //ADD TO DATABASE
  //ADD USER
  public function user_add(){
  $password_encrypt = $this->input->post('password');
  $password = md5($password_encrypt);
      $data = array(
              'shopname' => $this->input->post('shop_name'),
              'cosfirstname' => $this->input->post('firstname'),
              'coslastname' => $this->input->post('lastname'),
              'coscontactnum' => $this->input->post('contact'),
              'province' => $this->input->post('province'),
              'municipality' => $this->input->post('municipality'),
              'barangay' => $this->input->post('barangay'),
              'email_address' => $this->input->post('email_address'),
              'cosusername' => $this->input->post('username'),
              'cospassword' => $password,
              'role' => $this->input->post('role'),
      );
      
      $insert = $this->shop_model->user_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //ADD USER CUSTOMER
  public function user_customer_add(){
  $password_encrypt = $this->input->post('password');
  $password = md5($password_encrypt);

  
      $data = array(
              'cosfirstname' => $this->input->post('firstname'),
              'coslastname' => $this->input->post('lastname'),
              'coscontactnum' => $this->input->post('contact'),
              'email_address' => $this->input->post('email_address'),
              'cosusername' => $this->input->post('username'),
              'cospassword' => $password,
              'role' => 1,
              //'status' => 2,
      );
      
      $insert = $this->shop_model->user_add($data);
      echo json_encode(array("status" => TRUE));
  }


  //ADD SHOP
  public function shop_add(){
  $role = 2;
  $password_encrypt = $this->input->post('password');
  $password = md5($password_encrypt);


      $data = array(
              'shopname' => $this->input->post('shop_name'),
              'cosfirstname' => $this->input->post('firstname'),
              'coslastname' => $this->input->post('lastname'),
              'coscontactnum' => $this->input->post('contact'),
              'province' => $this->input->post('province'),
              'municipality' => $this->input->post('municipality'),
              'barangay' => $this->input->post('barangay'),
              'email_address' => $this->input->post('email_address'),
              'cosusername' => $this->input->post('username'),
              'cospassword' => $password,
              'role' => $role,
      );
      
      $insert = $this->shop_model->shop_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //OWNER SHOP ADD
  public function owner_shop_add(){
      //$password_encrypt = $this->input->post('password');
      //$password = md5($password_encrypt);
      $this->shop_model->owner_shop_add($this->input->post());
      
  }

  //FREELANCE MEKANIKO ADD
  public function freelance_mekaniko_add(){
      //$password_encrypt = $this->input->post('password');
      //$password = md5($password_encrypt);
      $this->shop_model->freelance_mekaniko_add($this->input->post());
      
  }


  //ADD PROVINCE
  public function province_add(){

      $data = array(
              'province_name' => $this->input->post('province_name'),
      );
      
      $insert = $this->shop_model->province_add($data);
      echo json_encode(array("status" => TRUE));
  }


  //ADD MUNICIPALITY
  public function municipality_add(){

      $data = array(
              'municipality_name' => $this->input->post('municipality_name'),
      );
      
      $insert = $this->shop_model->municipality_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //ADD BARANGAY
  public function barangay_add(){

      $data = array(
              'barangay_name' => $this->input->post('barangay_name'),
      );
      
      $insert = $this->shop_model->barangay_add($data);
      echo json_encode(array("status" => TRUE));
  }



  //ADD CUSTOMER
  public function customer_add(){
  $role = 1;
  $password_encrypt = $this->input->post('password');
  $password = md5($password_encrypt);

  $firstname = $this->input->post('firstname');
  $lastname = $this->input->post('lastname');
  $contact = $this->input->post('contact');
  $email_address = $this->input->post('email_address');
  $username = $this->input->post('username');

  $this->sent_mail_customer_add($firstname,$lastname,$contact,$email_address,$username);

      $data = array(
              'cosfirstname' => $this->input->post('firstname'),
              'coslastname' => $this->input->post('lastname'),
              'coscontactnum' => $this->input->post('contact'),
              'email_address' => $this->input->post('email_address'),
              'cosusername' => $this->input->post('username'),
              'cospassword' => $password,
              'role' => $role,
              'status' => 2,
      );
      
      $insert = $this->shop_model->shop_add($data);
      echo json_encode(array("status" => TRUE));
  }



  //MAILING CUSTOMER REGISTRATION

  public function sent_mail_customer_add($firstname,$lastname,$contact,$email_address,$username) {
  //print_r($email_address);
      $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'dnatsu100218@gmail.com',
          'smtp_pass' => 'D.natsu100218',
          'mailtype'  => 'html',
          'charset'   => 'iso-8859-1'
      );
      // Load email library and passing configured values to email library
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      // Sender email address
      $this->email->from('dnatsu100218@gmail.com');
      // Receiver email address.for single email

      //TO GET EMAIL OF OWNER
      //$email_to_input =  $this->employee_model->get_email_to();
      //$this->email->to($email_to_input[0]);
      //$email_list = array($email_to_input->email_address);

      //print_r($email_to_input);
      //$email_list = array($email_address);
      $email_list = array($email_address);
      $this->email->to($email_list);

      // Subject of email
      
      $this->email->subject('Registration Successfully');
      // Message in email
      
      $message = "Good day"." ".$firstname." ".$lastname." you are now registered to our system"."<br>
      <br>
      You may now proceed to the website by clicking the link below:<br><br>
      ".base_url('')."

      <br>";
      
      
      
      $this->email->message($message);
      // It returns boolean TRUE or FALSE based on success or failure
      $this->email->send();
  }

  //ADD SERVICE
  public function service_add(){

  $shop_name = $this->input->post('shop_name');

  $shop_input =  $this->shop_model->getShopDetailsForAllService();

      if($shop_name == 'All'){
          for($i = 0; $i < count($shop_input); $i++){

          $owners_id = $shop_input[$i]["cosid"];

              $data = array(
              'ownersid' => $owners_id,
              'servicename' => $this->input->post('service'),
              //'amount' => $this->input->post('amount'),
              );

              $insert = $this->shop_model->service_add($data);

          }
      }else{
          $data = array(
              'ownersid' => $this->input->post('shop_name'),
              'servicename' => $this->input->post('service'),
              //'amount' => $this->input->post('amount'),
          );
          $insert = $this->shop_model->service_add($data);
          //echo json_encode(array("status" => TRUE));

      }
      

      echo json_encode(array("status" => TRUE));
      
  }

  //ADD SERVICE FREELANCE
  public function service_freelance_add(){

  $session_id = $this->session->userdata('cosid'); 

      $data = array(
              'ownersid' => $session_id,
              'servicename' => $this->input->post('service'),
              'amount' => $this->input->post('amount'),
      );
      
      $insert = $this->shop_model->service_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //ADD SERVICE OWNER
  public function service_owner_add(){

  $session_id = $this->session->userdata('cosid'); 

      $data = array(
              'ownersid' => $session_id,
              'servicename' => $this->input->post('service'),
              'amount' => $this->input->post('amount'),
      );
      
      $insert = $this->shop_model->service_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //ADD SERVICE OWNER PRODUCT
  public function product_add(){

  $session_id = $this->session->userdata('cosid'); 

      $data = array(
              'product_name' => $this->input->post('product_name'),
              'quantity' => $this->input->post('quantity'),
              'serviceid' => $this->input->post('serviceid'),
              'price' => $this->input->post('price'),
              'category' => $this->input->post('category'),
      );
      
      $insert = $this->shop_model->product_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //ADD BRANCH OWNER
  public function branch_owner_add(){

  $session_id = $this->session->userdata('cosid'); 

      $data = array(
              'ownersid' => $session_id,
              'branch_name' => $this->input->post('branch_name'),
      );
      
      $insert = $this->shop_model->branch_add($data);
      echo json_encode(array("status" => TRUE));
  }



  //LOCATION ADD
  public function location_add(){

  $session_id = $this->session->userdata('cosid');
      $data = array(
              'loc_name' => $this->input->post('location_name'),
              'latitude' => $this->input->post('latitude'),
              'longitude' => $this->input->post('longitude'),
              'loc_info' => $this->input->post('location_info'),
              'branch_id' => $this->input->post('branch_name'),
              'mapuserid' => $session_id
      );
      
      $insert = $this->shop_model->location_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //LOCATION FREELANCE
  public function location_freelance_add(){

  $session_id = $this->session->userdata('cosid');
      $data = array(
              'loc_name' => $this->input->post('location_name'),
              'latitude' => $this->input->post('latitude'),
              'longitude' => $this->input->post('longitude'),
              'loc_info' => $this->input->post('location_info'),
              'mapuserid' => $session_id
      );
      
      $insert = $this->shop_model->location_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //RESERVATION ADD
  public function reservation_add(){

  $session_id = $this->session->userdata('cosid');
  $mapid = $this->input->post('id');
  $mapuserid = $this->input->post('mapuserid');
  $shop_name = $this->input->post('shop_name');
  $branch_name = $this->input->post('branch_name');
  $location_name = $this->input->post('location_name');
  $location_info = $this->input->post('location_info');
  $service_name = $this->input->post('service_name');
  $issue = $this->input->post('issue');
  $latitude = $this->input->post('latitude');
  $longitude = $this->input->post('longitude');

  $this->sent_mail_customer_transaction($mapid,$mapuserid,$shop_name,$branch_name,$location_name,$location_info,$service_name,$issue,$session_id);
      $data = array(
              'mapid' => $this->input->post('id'),
              'mapuserid' => $this->input->post('mapuserid'),
              'shop_name' => $this->input->post('shop_name'),
              'branch_name' => $this->input->post('branch_name'),
              'loc_name' => $this->input->post('location_name'),
              'loc_info' => $this->input->post('location_info'),
              'serviceid' => $this->input->post('service_name'),
              'issue' => $this->input->post('issue'),
              'latitude' => $this->input->post('latitude'),
              'longitude' => $this->input->post('longitude'),
              'vehicle_type' => $this->input->post('vehicle_type'),
              'customerid' => $session_id
      );
      
      $insert = $this->shop_model->reservation_add($data);
      echo json_encode(array("status" => TRUE));
  }




  //MAILING FOR OWNER

  public function sent_mail_customer_transaction($mapid, $mapuserid,$shop_name,$branch_name,$location_name,$location_info,$service_name,$issue,$session_id) {
  //print_r($email_address);
      $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'dnatsu100218@gmail.com',
          'smtp_pass' => 'D.natsu100218',
          'mailtype'  => 'html',
          'charset'   => 'iso-8859-1'
      );
      // Load email library and passing configured values to email library
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      // Sender email address
      $this->email->from('dnatsu100218@gmail.com');
      // Receiver email address.for single email

      //TO GET EMAIL OF OWNER
      /*$email_to_input =  $this->employee_model->get_email_to();
      $this->email->to($email_to_input[0]);*/

      $email_to_input =  $this->shop_model->get_email_to_owner($mapuserid);
      $this->email->to($email_to_input[0]->email_address);

      $customer_id =  $this->shop_model->get_name($session_id);
      $customer_name = $customer_id[0]->customer_name;

      // Subject of email
      
      $this->email->subject('Reservation Transaction');
      // Message in email

      $message = "Good Day,   <br><br> &emsp;&emsp; I am "." ".$customer_name." processed a reservation for your services with an issue of"." ".$issue."<br>";
      
      $this->email->message($message);
      // It returns boolean TRUE or FALSE based on success or failure
      $this->email->send();
  }


  //RESERVATION ADD WITH PRODUCT
  public function reservation_with_product_add(){

  $session_id = $this->session->userdata('cosid');
  $mapid = $this->input->post('id_hidden');
  $mapuserid = $this->input->post('mapuserid_hidden');
  $shop_name = $this->input->post('shop_name_hidden');
  $branch_name = $this->input->post('branch_name_hidden');
  $location_name = $this->input->post('location_name_hidden');
  $location_info = $this->input->post('location_info_hidden');
  $service_name = $this->input->post('service_name_hidden');
  $issue = $this->input->post('issue_hidden');
  $latitude = $this->input->post('latitude_hidden');
  $longitude = $this->input->post('longitude_hidden');
  $vehicle_type = $this->input->post('vehicle_type_hidden');


  $quantity = $this->input->post('quantity');
  $price_hidden = $this->input->post('price_hidden');
  $total_price = $quantity * $price_hidden;

  $this->sent_mail_customer_transaction($mapid,$mapuserid,$shop_name,$branch_name,$location_name,$location_info,$service_name,$issue,$session_id);
      $data = array(
              'mapid' => $this->input->post('id_hidden'),
              'mapuserid' => $this->input->post('mapuserid_hidden'),
              'shop_name' => $this->input->post('shop_name_hidden'),
              'branch_name' => $this->input->post('branch_name_hidden'),
              'loc_name' => $this->input->post('location_name_hidden'),
              'loc_info' => $this->input->post('location_info_hidden'),
              'serviceid' => $this->input->post('service_name_hidden'),
              'issue' => $this->input->post('issue_hidden'),
              'vehicle_type' => $this->input->post('vehicle_type_hidden'),
              'latitude' => $this->input->post('latitude_hidden'),
              'longitude' => $this->input->post('longitude_hidden'),
              'product_name' => $this->input->post('product_name'),
              'quantity' => $this->input->post('quantity'),
              'price' => $total_price,
              'category' => $this->input->post('category_hidden'),
              'customerid' => $session_id
      );
      
      $insert = $this->shop_model->reservation_add($data);
      echo json_encode(array("status" => TRUE));
  }


  //ADD SERVICE OWNER PRODUCT
  public function reservation_product_add(){

  $session_id = $this->session->userdata('cosid'); 

      $data = array(
              'product_name' => $this->input->post('product_name'),
              'quantity' => $this->input->post('quantity'),
              'serviceid' => $this->input->post('serviceid'),
              'price' => $this->input->post('price_hidden'),
              'category' => $this->input->post('category_hidden'),
              'reservation_id' => $this->input->post('resid'),
      );
      
      $insert = $this->shop_model->reservation_product_add($data);
      echo json_encode(array("status" => TRUE));
  }

  //Populate to Textfield
  public function ajax_select_product_data($id){
      $data = $this->shop_model->get_by_id_product($id);
      echo json_encode($data);
  }


  //USER
  public function ajax_edit_user($id){
      $data = $this->shop_model->get_by_id_user($id);
      echo json_encode($data);
  }

  //USER CUSTOMER
  public function ajax_edit_user_customer($id){
      $data = $this->shop_model->get_by_id_user($id);
      echo json_encode($data);
  }

  //SHOP
  public function ajax_edit_shop($id){
      $data = $this->shop_model->get_by_id_shop($id);
      echo json_encode($data);
  }

  //CUSTOMER
  public function ajax_edit_customer($id){
      $data = $this->shop_model->get_by_id_customer($id);
      echo json_encode($data);
  }

  //PROVINCE
  public function ajax_edit_province($id){
      $data = $this->shop_model->get_by_id_province($id);
      echo json_encode($data);
  }

  //MUNICIPALITY
  public function ajax_edit_municipality($id){
      $data = $this->shop_model->get_by_id_municipality($id);
      echo json_encode($data);
  }

  //BARANGAY
  public function ajax_edit_barangay($id){
      $data = $this->shop_model->get_by_id_barangay($id);
      echo json_encode($data);
  }
  //SERVICE
  public function ajax_edit_service($id){
      $data = $this->shop_model->get_by_id_service($id);
      echo json_encode($data);
  }


  //PRODUCT
  public function ajax_edit_product($id){
      $data = $this->shop_model->get_by_id_product($id);
      echo json_encode($data);
  }

  //BRANCH
  public function ajax_edit_branch($id){
      $data = $this->shop_model->get_by_id_branch($id);
      echo json_encode($data);
  }

  //LOCATION
  public function ajax_edit_location($id){
      $data = $this->shop_model->get_by_id_location($id);
      echo json_encode($data);
  }

  //LOCATION PLOT
  public function ajax_edit_location_plot(){
      $data = $this->shop_model->get_by_location_plot();
      echo json_encode($data);
  }

  //LOCATION CUSTOMER PLOT
  public function ajax_edit_location_customer_plot($id){
      $data = $this->shop_model->get_by_location_customer_plot($id);
      echo json_encode($data);
  }

  //LOCATION PLOT ALL
  public function ajax_edit_location_plot_all(){
      $data = $this->shop_model->get_by_location_plot_all();
      echo json_encode($data);
  }

  //LOCATION PLOT FREELANCE
  public function ajax_edit_location_plot_all_freelance(){
      $data = $this->shop_model->get_by_location_plot_all_freelance();
      echo json_encode($data);
  }


  //LOCATION FOR RESERVATION
  public function ajax_reservation($id){
      $data = $this->shop_model->get_by_id_reservation($id);
      $dropdown_data = $this->shop_model->get_by_id_reservation_services($id);
      $data['dropdown_data'] = $dropdown_data;


      echo json_encode($data);
  }

  //ADD PRODUCT FOR TRANSACTION
  public function ajax_reservation_product($id){
      $dropdown_data = $this->shop_model->get_by_id_reservation_customer_product($id);
      $data['dropdown_data'] = $dropdown_data;
      echo json_encode($data);
  }


  //EDIT DATA
  //EDIT USER
  public function user_update(){

        $data = array(
              'shopname' => $this->input->post('shop_name'),
              'cosfirstname' => $this->input->post('firstname'),
              'coslastname' => $this->input->post('lastname'),
              'coscontactnum' => $this->input->post('contact'),
              'province' => $this->input->post('province'),
              'municipality' => $this->input->post('municipality'),
              'barangay' => $this->input->post('barangay'),
              'email_address' => $this->input->post('email_address'),
              'role' => $this->input->post('role')
        );

        $this->shop_model->shop_update(array('cosid' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  // EDIT USER CUSTOMER
  public function user_customer_update(){
  $role = 1;
        $data = array(
                'cosfirstname' => $this->input->post('firstname'),
                'coslastname' => $this->input->post('lastname'),
                'coscontactnum' => $this->input->post('contact'),
                'email_address' => $this->input->post('email_address'),
                'cosusername' => $this->input->post('username'),
                'role' => $role,
        );

        $this->shop_model->shop_update(array('cosid' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT SHOP
  public function shop_update(){

        $data = array(
              'shopname' => $this->input->post('shop_name'),
              'cosfirstname' => $this->input->post('firstname'),
              'coslastname' => $this->input->post('lastname'),
              'coscontactnum' => $this->input->post('contact'),
              'province' => $this->input->post('province'),
              'municipality' => $this->input->post('municipality'),
              'barangay' => $this->input->post('barangay'),
              'email_address' => $this->input->post('email_address')
        );

        $this->shop_model->shop_update(array('cosid' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT PROVINCE
  public function province_update(){

        $data = array(
              'province_name' => $this->input->post('province_name'),
        );

        $this->shop_model->province_update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT MUNICIPALITY
  public function municipality_update(){

        $data = array(
              'municipality_name' => $this->input->post('municipality_name'),
        );

        $this->shop_model->municipality_update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT BARANGAY
  public function barangay_update(){

        $data = array(
              'barangay_name' => $this->input->post('barangay_name'),
        );

        $this->shop_model->barangay_update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT SERVICE
  public function service_update(){

        $data = array(
              'ownersid' => $this->input->post('shop_name'),
              'servicename' => $this->input->post('service'),
              'amount' => $this->input->post('amount'),
        );

        $this->shop_model->service_update(array('serviceid' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT SERVICE OWNER
  public function service_owner_update(){

        $data = array(
              'servicename' => $this->input->post('service'),
              'amount' => $this->input->post('amount'),
        );

        $this->shop_model->service_update(array('serviceid' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT PRODUCT
  public function product_update(){

        $data = array(
              'product_name' => $this->input->post('product_name'),
              'quantity' => $this->input->post('quantity'),
              'price' => $this->input->post('price'),
              'category' => $this->input->post('category'),
        );

        $this->shop_model->product_update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT SERVICE OWNER RESTORE
  public function service_owner_restore(){

        $data = array(
              'status' => 1,
        );

        $this->shop_model->service_update(array('serviceid' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT BRANCH OWNER
  public function branch_owner_update(){

        $data = array(
              'branch_name' => $this->input->post('branch_name'),
        );

        $this->shop_model->branch_update(array('branch_id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }


  //EDIT LOCATION
  public function location_update(){

        $data = array(
              'loc_name' => $this->input->post('location_name'),
              'loc_info' => $this->input->post('location_info'),
              'latitude' => $this->input->post('latitude'),
              'longitude' => $this->input->post('longitude'),
              'branch_id' => $this->input->post('branch_name'),
        );

        $this->shop_model->location_update(array('mapid' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }

  //EDIT FREELANCE MEKANIKO LOCATION
  public function location_freelance_update(){

        $data = array(
              'loc_name' => $this->input->post('location_name'),
              'loc_info' => $this->input->post('location_info'),
              'latitude' => $this->input->post('latitude'),
              'longitude' => $this->input->post('longitude'),
        );

        $this->shop_model->location_update(array('mapid' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
  }



  //APPROVED SHOP OWNER
  public function shopowner_approved($id){
      $this->shop_model->shopowner_approved_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //DELETE DATA
  //DELETE SHOP
  public function user_delete($id){
      $this->shop_model->delete_shop_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
  //DELETE SHOP
  public function shop_delete($id){
      $this->shop_model->delete_shop_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //DELETE PROVINCE
  public function province_delete($id){
      $this->shop_model->delete_province_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //DELETE MUNICIPALITY
  public function municipality_delete($id){
      $this->shop_model->delete_municipality_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //DELETE BARANGAY
  public function barangay_delete($id){
      $this->shop_model->delete_barangay_by_id($id);
      echo json_encode(array("status" => TRUE));
  }


  //DELETE SERVICE
  public function service_delete($id){
      $this->shop_model->delete_service_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //DELETE PRODUCT
  public function product_delete($id){
      $this->shop_model->delete_product_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //DELETE BRANCH
  public function branch_delete($id){
      $this->shop_model->delete_branch_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //DELETE LOCATION
  public function location_delete($id){
      $this->shop_model->delete_location_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //PROCESS RESERVATION
  public function reservation_process($id){
      $this->shop_model->process_reservation_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //FINISH RESERVATION
  public function reservation_finish($id){
      $this->shop_model->finish_reservation_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //UNSOLVE RESERVATION
  public function reservation_unsolve($id){
      $this->shop_model->unsolve_reservation_by_id($id);
      echo json_encode(array("status" => TRUE));
  }

  //CANCEL RESERVATION
  public function reservation_cancel($id){
      $this->shop_model->cancel_reservation_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
}

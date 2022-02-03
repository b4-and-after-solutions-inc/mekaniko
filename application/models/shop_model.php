<?php
//models
defined('BASEPATH') OR exit('No direct script access allowed');

class shop_model extends CI_Model
{
  var $table = 'costumer_account';
  var $table1 = 'services';
  var $table2 = 'map_location';
  var $table3 = 'branch';
  var $table4 = 'reservation';
  var $table5 = 'municipality';
  var $table6 = 'barangay';
  var $table7 = 'province';
  var $table8 = 'products';
  var $table9 = 'product_avail';
  public function __construct(){
    date_default_timezone_set('Asia/Manila');
  }
  
  //COUNT FRO DASHBOARD
  public function get_costumerCount(){
      $query = "SELECT count(*) as count_costumer from costumer_account";
      $row = $this->db->query($query);
      return $row->result();  
  }
  //FOR DATA TABLES
  //USER DETAILS
  public function getUserDetails(){
      $query = "SELECT cosid, CONCAT(cosfirstname, ' ', coslastname) AS owners_name, cosfirstname, coslastname, cosusername, cospassword, coscontactnum, email_address, shopname, CONCAT(barangay, ' ', municipality, ' ', province) AS address, province, municipality, barangay, role from costumer_account WHERE role =2";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  public function getUserCustomerDetails(){
      $query = "SELECT cosid, CONCAT(cosfirstname, ' ', coslastname) AS owners_name, cosfirstname, coslastname, cosusername, cospassword, coscontactnum, email_address, shopname, CONCAT(barangay, ' ', municipality, ' ', province) AS address, province, municipality, barangay, role from costumer_account WHERE role=1";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //SHOP DETAILS
  public function getShopDetails(){
      $query = "SELECT cosid, CONCAT(cosfirstname, ' ', coslastname) AS owners_name, picture, business_number, cosfirstname, coslastname, cosusername, cospassword, coscontactnum, shopname, CONCAT(barangay, ' ', municipality, ' ', province) AS address, province, municipality, barangay, role, status, email_address from costumer_account WHERE role = 2 OR role = 3";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //SHOP DETAILS
  public function getShopDetailsForAllService(){
      $query = "SELECT cosid, CONCAT(cosfirstname, ' ', coslastname) AS owners_name, picture, business_number, cosfirstname, coslastname, cosusername, cospassword, coscontactnum, shopname, CONCAT(barangay, ' ', municipality, ' ', province) AS address, province, municipality, barangay, role, status, email_address from costumer_account WHERE role = 2";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //CUSTOMER DETAILS
  public function getCustomerDetailsAdmin(){
      $query = "SELECT cosid, CONCAT(cosfirstname, ' ', coslastname) AS customername, picture, business_number, cosfirstname, coslastname, cosusername, cospassword, coscontactnum, shopname, CONCAT(barangay, ' ', municipality, ' ', province) AS address, province, municipality, barangay, role, status, email_address from costumer_account WHERE role = 1";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //PROVINCE DETAILS
  public function getProvinceDetails(){
      $query = "SELECT id, province_name, status  FROM province";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //MUNICIPALITY DETAILS
  public function getMunicipalityDetails(){
      $query = "SELECT id, municipality_name, status  FROM municipality";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //BARANGAY DETAILS
  public function getBarangayDetails(){
      $query = "SELECT id, barangay_name, status  FROM barangay";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //CUSTOMER DETAILS
  public function getCustomerDetails(){
      $query = "SELECT cosid, CONCAT(cosfirstname, ' ', coslastname) AS owners_name, cosfirstname, coslastname, cosusername, cospassword, coscontactnum, email_address, shopname, CONCAT(barangay, ' ', municipality, ' ', province) AS address, province, municipality, barangay, role from costumer_account WHERE role = 1";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //SERVICE DETAILS
  public function getServiceDetails(){
      $query = "SELECT s.serviceid, s.ownersid, s.servicename,s.amount, CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM services as s INNER JOIN costumer_account as c ON s.ownersid = c.cosid WHERE s.status =1";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //SERVICE DETAILS FREELANCE
  public function getServiceFreelanceDetails(){

      $session_id = $this->session->userdata('cosid');
      $query = "SELECT s.serviceid, s.ownersid, s.servicename,s.amount, CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM services as s INNER JOIN costumer_account as c ON s.ownersid = c.cosid WHERE s.status =1 AND s.ownersid = $session_id";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //SERVICE OWNER
  public function getServiceOwnerDetails(){
      $session_id = $this->session->userdata('cosid');
      $query = "SELECT s.serviceid, s.ownersid, s.servicename, CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname,s.amount, p.product_name,p.quantity,p.price, p.category, p.id as product_id FROM services as s INNER JOIN costumer_account as c ON s.ownersid = c.cosid LEFT JOIN products as p ON p.serviceid = s.serviceid WHERE s.status =1 AND s.ownersid = $session_id"; /*GROUP BY p.product_name";*/
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //SERVICE OWNER ARCHIVED
  public function getServiceOwnerArchivedDetails(){
      $session_id = $this->session->userdata('cosid');
      $query = "SELECT s.serviceid, s.ownersid, s.servicename, CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM services as s INNER JOIN costumer_account as c ON s.ownersid = c.cosid WHERE s.status =0 AND s.ownersid = $session_id";
      $response = $this->db->query($query);
      return $response->result_array();
  }


  //BRANCH OWNER
  public function getBranchOwnerDetails(){
      $session_id = $this->session->userdata('cosid');
      $query = "SELECT b.branch_id, b.ownersid, b.branch_name, CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM branch as b INNER JOIN costumer_account as c ON b.ownersid = c.cosid WHERE b.ownersid = $session_id";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //TRANSACTION LIST OWNER
  public function getReservationOwnerDetails(){
      $session_id = $this->session->userdata('cosid');
      $query = "SELECT r.res_id, r.mapid, r.mapuserid, r.shop_name, r.loc_name, r.loc_info, r.branch_name,p.product_name, r.quantity, r.price, r.category,r.vehicle_type, s.servicename, s.amount, CONCAT(c.cosfirstname, ' ', c.coslastname) AS customername, r.status, r.latitude, r.longitude,r.issue FROM reservation as r LEFT JOIN services as s on r.serviceid = s.serviceid INNER JOIN costumer_account as c on r.customerid = c.cosid LEFT JOIN products as p ON r.product_name = p.id WHERE r.mapuserid = $session_id ";
      $response = $this->db->query($query);
      return $response->result_array();
  }


  //RESERVATION CUSTOMER
  public function getReservationCustomerDetails(){
      $session_id = $this->session->userdata('cosid');
      $query = "SELECT r.res_id, r.mapid, r.mapuserid, r.shop_name, r.loc_name, r.loc_info, r.branch_name, r.issue,s.serviceid, s.servicename, s.amount, CONCAT(c.cosfirstname, ' ', c.coslastname) AS customername, r.status FROM reservation as r LEFT JOIN services as s on r.serviceid = s.serviceid LEFT JOIN costumer_account as c on r.mapuserid = c.cosid WHERE r.customerid = $session_id ";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //REPORTS
  public function getReportsDetails(){
      $session_id = $this->session->userdata('cosid');
      $query = "SELECT r.res_id, r.mapid, r.mapuserid, r.shop_name, r.loc_name, r.loc_info, r.branch_name, s.servicename, s.amount, CONCAT(c.cosfirstname, ' ', c.coslastname) AS customername, r.status, r.latitude, r.longitude,r.issue FROM reservation as r LEFT JOIN services as s on r.serviceid = s.serviceid INNER JOIN costumer_account as c on r.customerid = c.cosid WHERE r.status = 4 AND r.mapuserid = $session_id ";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //REPORTS
  public function getReportsOwnerDetails(){
      $session_id = $this->session->userdata('cosid');
      $query = "SELECT r.res_id, r.mapid, r.mapuserid, r.shop_name, r.loc_name, r.loc_info, r.branch_name,p.product_name,r.vehicle_type, r.quantity, p.price, r.category,  s.servicename, s.amount, CONCAT(c.cosfirstname, ' ', c.coslastname) AS customername, r.status, r.latitude, r.longitude,r.issue FROM reservation as r LEFT JOIN services as s on r.serviceid = s.serviceid INNER JOIN costumer_account as c on r.customerid = c.cosid LEFT JOIN products as p ON r.product_name = p.id WHERE r.status = 4 AND r.mapuserid = $session_id ";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //LOCATION DETAILS
  public function getLocationDetails(){
  $session_id = $this->session->userdata('cosid');
      $query = "SELECT l.mapid, l.loc_name, l.loc_info, l.latitude, l.longitude, l.mapuserid, l.branch_id,b.branch_name,CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM map_location as l LEFT JOIN costumer_account as c ON l.mapuserid = c.cosid LEFT JOIN branch as b ON l.branch_id = b.branch_id WHERE l.mapuserid = $session_id";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //LOCATION DETAILS ALL FOR CUSTOMER
  public function getLocationAllDetails(){
  $session_id = $this->session->userdata('cosid');
      $query = "SELECT l.mapid, l.loc_name, l.loc_info, l.latitude, l.longitude, l.mapuserid, l.branch_id,b.branch_name,CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM map_location as l LEFT JOIN costumer_account as c ON l.mapuserid = c.cosid LEFT JOIN branch as b ON l.branch_id = b.branch_id WHERE c.role =2";
      $response = $this->db->query($query);
      return $response->result_array();
  }


  //LOCATION DETAILS ALL FOR FREELANCE
  public function getLocationAllFreelanceDetails(){
  $session_id = $this->session->userdata('cosid');
      $query = "SELECT l.mapid, l.loc_name, l.loc_info, l.latitude, l.longitude, l.mapuserid, l.branch_id,b.branch_name,CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM map_location as l LEFT JOIN costumer_account as c ON l.mapuserid = c.cosid LEFT JOIN branch as b ON l.branch_id = b.branch_id WHERE c.role =3";
      $response = $this->db->query($query);
      return $response->result_array();
  }

  //ADD TO DATABASE
  //ADD USER
  public function user_add($data){
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }


  //ADD SHOP
  public function shop_add($data){
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  //ADD PROVINCE
  public function province_add($data){
    $this->db->insert($this->table7, $data);
    return $this->db->insert_id();
  }

  //ADD MUNICIPALITY
  public function municipality_add($data){
    $this->db->insert($this->table5, $data);
    return $this->db->insert_id();
  }

  //ADD BARANGAY
  public function barangay_add($data){
    $this->db->insert($this->table6, $data);
    return $this->db->insert_id();
  }

  //ADD SERVICE
  public function service_add($data){
    $this->db->insert($this->table1, $data);
    return $this->db->insert_id();
  }

  //ADD PRODUCT
  public function product_add($data){
    $this->db->insert($this->table8, $data);
    return $this->db->insert_id();
  }

  public function reservation_product_add($data){
    $this->db->insert($this->table9, $data);
    return $this->db->insert_id();
  }

  //ADD BRANCH
  public function branch_add($data){
    $this->db->insert($this->table3, $data);
    return $this->db->insert_id();
  }


  //ADD LOCATION
  public function location_add($data){
    $this->db->insert($this->table2, $data);
    return $this->db->insert_id();
  }

  //ADD RESERVATION
  public function reservation_add($data){
    $this->db->insert($this->table4, $data);
    return $this->db->insert_id();
  }

  //Populate to Textfield
  //USER
  public function get_by_id_user($id){
    $this->db->from($this->table);
    $this->db->where('cosid',$id);
    $query = $this->db->get();
    return $query->row();
  }

  //SHOP
  public function get_by_id_shop($id){
    $this->db->from($this->table);
    $this->db->where('cosid',$id);
    $query = $this->db->get();
    return $query->row();
  }

  //CUSTOMER
  public function get_by_id_customer($id){
    $this->db->from($this->table);
    $this->db->where('cosid',$id);
    $query = $this->db->get();
    return $query->row();
  }

  //PROVINCE
  public function get_by_id_province($id){
    $this->db->from($this->table7);
    $this->db->where('id',$id);
    $query = $this->db->get();
    return $query->row();
  }

  //MUNICIPALITY
  public function get_by_id_municipality($id){
    $this->db->from($this->table5);
    $this->db->where('id',$id);
    $query = $this->db->get();
    return $query->row();
  }

  //BARANGAY
  public function get_by_id_barangay($id){
    $this->db->from($this->table6);
    $this->db->where('id',$id);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_by_id_service($id){

    $query = "SELECT s.serviceid, s.ownersid, s.servicename,s.amount, CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM services as s INNER JOIN costumer_account as c ON s.ownersid = c.cosid WHERE s.serviceid = $id";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  //PRODUCT
  public function get_by_id_product($id){

    $query = "SELECT id, product_name, quantity, price, category FROM products WHERE id = $id";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  public function get_by_id_branch($id){

    $query = "SELECT b.branch_id, b.ownersid, b.branch_name, CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM branch as b INNER JOIN costumer_account as c ON b.ownersid = c.cosid WHERE b.branch_id = $id";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  public function get_by_id_location($id){

    $query = "SELECT l.mapid, l.loc_name, l.loc_info, l.latitude, l.longitude, l.mapuserid, l.branch_id,b.branch_name,CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM map_location as l LEFT JOIN costumer_account as c ON l.mapuserid = c.cosid LEFT JOIN branch as b ON l.branch_id = b.branch_id WHERE l.mapid = $id";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  //LOCATION PLOT
  public function get_by_location_plot(){
  $session_id = $this->session->userdata('cosid');
    $query = "SELECT l.mapid, l.loc_name, l.loc_info, l.latitude, l.longitude, l.mapuserid, l.branch_id,b.branch_name,CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM map_location as l LEFT JOIN costumer_account as c ON l.mapuserid = c.cosid LEFT JOIN branch as b ON l.branch_id = b.branch_id WHERE l.mapuserid = $session_id";
    $response = $this->db->query($query);
    return $response->result_array();
  }


  //LOCATION CUSTOMER PLOT
  public function get_by_location_customer_plot($id){
  $session_id = $this->session->userdata('cosid');
    //$query = "SELECT r.res_id, r.mapuserid, r.shop_name, r.loc_name, r.loc_info, r.branch_name, s.servicename,CONCAT(c.cosfirstname, ' ', c.coslastname) AS customername,r.status, r.issue, r.latitude, r.longitude FROM reservation as r LEFT JOIN services as s ON r.serviceid = s.serviceid LEFT JOIN costumer_account as c ON r.customerid = c.cosid";

    $query = "SELECT r.res_id, r.mapuserid, r.shop_name, r.loc_name, r.loc_info, r.branch_name, s.servicename,CONCAT(c.cosfirstname, ' ', c.coslastname) AS customername,r.status, r.issue, r.latitude, r.longitude FROM reservation as r LEFT JOIN services as s ON r.serviceid = s.serviceid LEFT JOIN costumer_account as c ON r.customerid = c.cosid WHERE r.res_id =$id";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  //LOCATION PLOT ALL
  public function get_by_location_plot_all(){

    $query = "SELECT l.mapid, l.loc_name, l.loc_info, l.latitude, l.longitude, l.mapuserid, l.branch_id,b.branch_name,CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM map_location as l LEFT JOIN costumer_account as c ON l.mapuserid = c.cosid LEFT JOIN branch as b ON l.branch_id = b.branch_id WHERE c.role = 2";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  //LOCATION PLOT ALL
  public function get_by_location_plot_all_freelance(){

    $query = "SELECT l.mapid, l.loc_name, l.loc_info, l.latitude, l.longitude, l.mapuserid, CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name FROM map_location as l LEFT JOIN costumer_account as c ON l.mapuserid = c.cosid WHERE c.role =3";
    $response = $this->db->query($query);
    return $response->result_array();
  }


  //LOCATION RESERVATION
  public function get_by_id_reservation($id){
    $query = "SELECT l.mapid, l.loc_name, l.loc_info, l.latitude, l.longitude, l.mapuserid, l.branch_id,b.branch_name,CONCAT(c.cosfirstname, ' ', c.coslastname) AS owners_name, c.shopname FROM map_location as l LEFT JOIN costumer_account as c ON l.mapuserid = c.cosid LEFT JOIN branch as b ON l.branch_id = b.branch_id WHERE l.mapid = $id";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  // POPULATE DROPDOWN SERVICES
  public function get_by_id_reservation_services($id){
    $query = "SELECT s.serviceid, s.servicename, s.status, s.ownersid,s.amount, l.branch_id FROM services as s INNER JOIN map_location l ON s.ownersid = l.mapuserid WHERE s.status = 1 AND l.mapid = $id GROUP BY s.servicename";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  // POPULATE DROPDOWN PRODUCT
  public function get_by_id_reservation_customer_product($id){
    $query = "SELECT p.id, p.product_name, p.quantity, p.price, p.category FROM products as p WHERE serviceid = $id ";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  // POPULATE DROPDOWN PRODUCT
  public function get_by_id_reservation_product($id){
    $query = "SELECT s.serviceid, s.servicename, s.status, s.ownersid,s.amount, l.branch_id FROM services as s INNER JOIN map_location l ON s.ownersid = l.mapuserid WHERE s.status = 1 AND l.mapid = $id GROUP BY s.servicename";
    $response = $this->db->query($query);
    return $response->result_array();
  }

  //EDIT DATA
  //EDIT SHOP
  public function shop_update($where, $data){
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  //EDIT PROVINCE
  public function province_update($where, $data){
    $this->db->update($this->table7, $data, $where);
    return $this->db->affected_rows();
  }

  //EDIT MUNICIPALITY
  public function municipality_update($where, $data){
    $this->db->update($this->table5, $data, $where);
    return $this->db->affected_rows();
  }

  //EDIT BARANGAY
  public function barangay_update($where, $data){
    $this->db->update($this->table6, $data, $where);
    return $this->db->affected_rows();
  }

  //EDIT SERVICE
  public function service_update($where, $data){
    $this->db->update($this->table1, $data, $where);
    return $this->db->affected_rows();
  }

  //EDIT PRODUCT
  public function product_update($where, $data){
    $this->db->update($this->table8, $data, $where);
    return $this->db->affected_rows();
  }

  //EDIT BRANCH
  public function branch_update($where, $data){
    $this->db->update($this->table3, $data, $where);
    return $this->db->affected_rows();
  }

  //EDIT LOCATION
  public function location_update($where, $data){
    $this->db->update($this->table2, $data, $where);
    return $this->db->affected_rows();
  }



  //APPROVED SHOP OWNER

  public function shopowner_approved_by_id($id){
    //$data = status = 0;
    $where = array('cosid' => $id);
    $data = array(
      'status' => 2,
    );
    $this->db->update($this->table, $data, $where);
  }



  //DELETE DATA
  //DELETE USER
  public function delete_user_by_id($id){
    $this->db->where('cosid', $id);
    $this->db->delete($this->table);
  }

  //DELETE SHOP
  public function delete_shop_by_id($id){
    $this->db->where('cosid', $id);
    $this->db->delete($this->table);
  }

  //DELETE PROVINCE
  public function delete_province_by_id($id){
    $this->db->where('id', $id);
    $this->db->delete($this->table7);
  }

  //DELETE MUNICIPALITY
  public function delete_municipality_by_id($id){
    $this->db->where('id', $id);
    $this->db->delete($this->table5);
  }

  //DELETE BARANGAY
  public function delete_barangay_by_id($id){
    $this->db->where('id', $id);
    $this->db->delete($this->table6);
  }

  //DELETE SERVICE ARCHIVED
  /*public function delete_service_by_id($id){
    $this->db->where('serviceid', $id);
    $this->db->delete($this->table1);
  }*/

  


  public function delete_service_by_id($id){
    //$data = status = 0;
    $where = array('serviceid' => $id);
    $data = array(
      'status' => 0,
    );
    $this->db->update($this->table1, $data, $where);
  }

  //PROCESS RESERVATION
  public function process_reservation_by_id($id){
    //$data = status = 0;
    $where = array('res_id' => $id);
    $data = array(
      'status' => 2,
    );
    $this->db->update($this->table4, $data, $where);
  }
  //UNSOLVE RESERVATION
  public function unsolve_reservation_by_id($id){
    //$data = status = 0;
    $where = array('res_id' => $id);
    $data = array(
      'status' => 3,
    );
    $this->db->update($this->table4, $data, $where);
  }

  
  //FINISH RESERVATION
  public function finish_reservation_by_id($id){
    //$data = status = 0;
    $where = array('res_id' => $id);
    $data = array(
      'status' => 4,
    );
    $this->db->update($this->table4, $data, $where);
  }

  

  //CANCEL RESERVATION
  public function cancel_reservation_by_id($id){
    //$data = status = 0;
    $where = array('res_id' => $id);
    $data = array(
      'status' => 5,
    );
    $this->db->update($this->table4, $data, $where);
  }

  //DELETE BRANCH
  public function delete_product_by_id($id){
    $this->db->where('id', $id);
    $this->db->delete($this->table8);
  }

  //DELETE BRANCH
  public function delete_branch_by_id($id){
    $this->db->where('branch_id', $id);
    $this->db->delete($this->table3);
  }

  //DELETE LOCATION
  public function delete_location_by_id($id){
    $this->db->where('mapid', $id);
    $this->db->delete($this->table2);
  }

  //MAILING

  public function get_email_to_owner($id){

    $this->db->select("email_address");     
    $this->db->where('cosid',$id);                    
    $query = $this->db->get("costumer_account");          
    return $query->result();
  }


  //GET CUSTOMER NAME
  public function get_name($id){

    $this->db->select("CONCAT(cosfirstname, ' ', coslastname) AS customer_name");     
    $this->db->where('cosid',$id);                    
    $query = $this->db->get("costumer_account");          
    return $query->result();
  }


  //FOR OWNER ADD UPLOAD BUSINESS PERMIT
  public function owner_shop_add($post){

    //$this->db->insert($this->table2, $data);
    //return $this->db->insert_id();
    unset($post['id']);
    $post['picture'] = $this->upload_file($_FILES['picture']);
    $password = $this->input->post('cospassword');
    $post['cospassword']= md5($password);
    $this->db->insert('costumer_account', $post);

  }

  function upload_file($action){
    //$path = 'spare_parts';
    $config = array(
    'upload_path' => "./assets/img/shop_picture/",
    'allowed_types' => "jpg|png|jpeg",
    'overwrite' => TRUE,
    'max_size' => "10048000"
    );
    $this->load->library('upload', $config);
    if($this->upload->do_upload('picture')){
      $data = array('upload_data' => $this->upload->data());
      return $_FILES['picture']['name'];
    }
    else{
      $error = array('error' => $this->upload->display_errors());
      return 0;
    }
  }

  //FREELANCE MEKANIKO ADD
  public function freelance_mekaniko_add($post){
    unset($post['id']);
    //$post['picture'] = $this->upload_file($_FILES['picture']);
    $password = $this->input->post('cospassword');
    $post['cospassword']= md5($password);
    $this->db->insert('costumer_account', $post);

  }

}

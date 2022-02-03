<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class User_model extends CI_Model{
  var $table = 'tbl_user';
  
  function sign_in($input) {
    $sql = "SELECT `cosid`, `cosfirstname`,`coslastname`,`coscontactnum`,`shopname`,`province`,`municipality`,`barangay`, `role` FROM `costumer_account` WHERE  status = 2 AND (cosusername = ? AND cospassword = ?)";
    $query_result = $this->db->query($sql, array($input['username'], md5($input['password'])));
    if ($query_result->num_rows() > 0) {
      foreach ( $query_result->result() as $row ) {
        $sess_array = array(
          'cosid'    => $row->cosid,
          'cosfirstname'  => $row->cosfirstname,
          'coslastname'  => $row->coslastname,
          'coscontactnum' => $row->coscontactnum,
          'shopname' => $row->shopname,
          'province' => $row->province,
          'municipality' => $row->municipality,
          'barangay' => $row->barangay,
          'role' => $row->role
        );
        $this->session->set_userdata($sess_array);
      }
      return 1;
    }
    else
      return 0;
  }

  function sign_out() {
    $this->session->sess_destroy();
  }

  public function getUserDetails(){
      $query = "SELECT id,first_name,last_name,email_address,username, password, user_type, location from tbl_user";
      $row = $this->db->query($query);
      return $row->result_array();
      return $response;
  }

  public function user_add($data){
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();

  }


  public function get_by_id_user($id){
    $this->db->from($this->table);
    $this->db->where('id',$id);
    $query = $this->db->get();
    return $query->row();
  }

  public function user_update($where, $data){
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }
  

  //Delete
  public function delete_by_id($id){
    $this->db->where('id', $id);
    $this->db->delete($this->table);
  }

}
?>

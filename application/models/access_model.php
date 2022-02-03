<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class access_model extends CI_Model {

  function __construct()
  {
  		date_default_timezone_set('Asia/Manila');
  }

  function validatecredentials($input)
  {
    // $input['username']; $input['password'];
    // TODO Felms
  }

}

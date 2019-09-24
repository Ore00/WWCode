<?php

require_once("includes/functions.inc");
class Couples{
  protected $couple_id;
  protected $groom_first_name;
  protected $groom_last_name;
  protected $groom_email;
  protected $bride_first_name;
  protected $bride_last_name;
  protected $bride_email;
  protected $primary_contact;
  protected $couple_address;
  protected $couple_city;
  protected $couple_state;
  protected $couple_zip;
  protected $create_date;
  protected $last_update_date;


  function Couples($couple_id = null){

    if($couple_id != null){
      self::set_value('couple_id', $couple_id);
      self::read();
    }
  }
  function create(){
    //create a new couple in the database
  }
  function read(){
    //get couple details from the database
  }
  function update(){
    //update couple in the database

  }
  function delete(){
    //remove a couple from the database

  }
  function get_all(){
    //get all couples from the database
  }

  function get_state_list(){   global $state_codes;  return $state_codes;   }
  function set_value($attribute, $value ){
    //this model doesn't accept any null values
    if($value == null || trim($value) == ""){ throw new Exception("Null value for attribute " . $attribute . " not allowed.");}

    switch($attribute){

      case "couple_id":
      $this->couple_id = $value;
      break;
      case "groom_first_name":
      $this->groom_first_name = $value;
      break;
      case "groom_last_name":
      $this->groom_last_name = $value;
      break;
      case "groom_email":
      $this->groom_email = $value;
      break;
      case "bride_first_name":
      $this->bride_first_name = $value;
      break;
      case "bride_last_name":
      $this->bride_last_name = $value;
      break;
      case "bride_email":
      $this->bride_email = $value;
      break;
      case "primary_contact":
      if($value == "Groom" || $value == "Bride"){
        $this->primary_contact = $value;
      }else{
        throw new Exception("Attribute Primary Contact must equal 'Groom or Bride'. Value " . $value . " is invalid.");
      }
      break;
      case "couple_address":
      $this->couple_address = $value;
      break;
      case "couple_city":
      $this->couple_city = $value;
      break;
      case "couple_state":
      global $state_codes;
      if(!in_array($value, $this->get_state_list())){   throw new Exception("Invalid state code " . $value);}
      $this->couple_state = $value;
      break;
      case "couple_zip":
      $this->couple_zip = $value;
      break;
      case "create_date":
      $this->create_date = $value;
      break;
      case "last_update_date":
      $this->last_update_date = $value;
      break;
      default:
      throw new Exception("Attribute " . $attribute . " not found.");
    }
  }

  function get_couple_id(){ return $this->couple_id; }
  function get_groom_first_name(){ return $this->groom_first_name; }
  function get_groom_last_name(){ return $this->groom_last_name; }
  function get_groom_email(){ return $this->groom_email; }
  function get_bride_first_name(){ return $this->bride_first_name; }
  function get_bride_last_name(){ return $this->bride_last_name; }
  function get_bride_email(){ return $this->bride_email; }
  function get_primary_contact(){ return $this->primary_contact; }
  function get_couple_address(){ return $this->couple_address; }
  function get_couple_city(){ return $this->couple_city; }
  function get_couple_state(){ return $this->couple_state; }
  function get_couple_zip(){ return $this->couple_zip; }
  function get_create_date(){ return $this->create_date; }
  function get_last_update_date(){ return $this->last_update_date; }



}
?>

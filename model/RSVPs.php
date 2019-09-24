<?php

require_once("includes/functions.inc");
class RSVPs{
  protected $rsvp_id;
  protected $event_id;
  protected $first_name;
  protected $last_name;
  protected $email;
  protected $events;
  protected $number_in_party;
  protected $status;
  protected $create_date;
  protected $last_update_date;


  function RSVPs($rsvp_id = null){

    if($rsvp_id != null){
      self::set_value('rsvp_id', $rsvp_id);
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
  function set_value($attribute, $value ){
    //this model doesn't accept any null values
    if($value == null || trim($value) == ""){ throw new Exception("Null value for attribute " . $attribute . " not allowed.");}

    switch($attribute){

      case "event_id":
      $this->event_id = $value;
      break;
      case "rsvp_id":
      $this->rsvp_id = $value;
      break;
      case "first_name":
      $this->first_name = $value;
      break;
      case "last_name":
      $this->last_name = $value;
      break;
      case "email":
      $this->email = $value;
      break;
      case "events":
      if($value == "Wedding" || $value == "Reception" || $value == "All Events"){
        $this->events = $value;
      }else{
        throw new Exception("Attribute Event Type must equal 'Wedding, Reception or All Events'. Value " . $value . " is invalid.");
      }
      break;
      case "status":
      if($value == "Going" || $value == "Not Going"){
        $this->status = $value;
      }else{
        throw new Exception("Attribute Staus must equal 'Going or Not Going'. Value " . $value . " is invalid.");
      }
      break;
      case "number_in_party":
      $this->number_in_party = $value;
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
  function get_rsvp_id(){ return $this->rsvp_id; }
  function get_event_id(){ return $this->event_id; }
  function get_first_name(){ return $this->first_name; }
  function get_last_name(){ return $this->last_name; }
  function get_email(){ return $this->email; }
  function get_events(){ return $this->events; }
  function get_status(){ return $this->status; }
  function get_number_in_party(){ return $this->number_in_party; }
  function get_create_date(){ return $this->create_date; }
  function get_last_update_date(){ return $this->last_update_date; }
}
?>

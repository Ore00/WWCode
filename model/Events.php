<?php

require_once("includes/functions.inc");
class Events{
  protected $event_id;
  protected $master_event_id;
  protected $couple_id;
  protected $name;
  protected $type;
  protected $address;
  protected $city;
  protected $state;
  protected $zip;
  protected $create_date;
  protected $last_update_date;
  protected $start_date_time;
  protected $end_date_time;
  protected $reply_by_date;

  function Events($event_id = null){

    if($event_id != null){
      self::set_value('event_id', $event_id);
      self::read();
    }
  }
  function create(){
    //create a new event in the database
  }
  function read(){
    //get event details from the database
  }
  function update(){
    //update event in the database

  }
  function delete(){
    //remove a event from the database

  }
  function get_all(){
    //get all event from the database
  }

  function get_state_list(){   global $state_codes;  return $state_codes;   }
  function set_value($attribute, $value ){
    //this model doesn't accept any null values
    if($value == null || trim($value) == ""){ throw new Exception("Null value for attribute " . $attribute . " not allowed.");}

    switch($attribute){

      case "event_id":
      $this->event_id = $value;
      break;
      case "couple_id":
      $this->couple_id = $value;
      break;
      case "master_event_id":
      $this->master_event_id = $value;
      break;
      case "name":
      $this->name = $value;
      break;
      case "type":
      if($value == "Wedding" || $value == "Reception"){
        $this->type = $value;
      }else{
        throw new Exception("Attribute Event Type must equal 'Wedding or Reception'. Value " . $value . " is invalid.");
      }
      break;
      case "address":
      $this->address = $value;
      break;
      case "city":
      $this->city = $value;
      break;
      case "state":
      global $state_codes;
      if(!in_array($value, $this->get_state_list())){   throw new Exception("Invalid state code " . $value);}
      $this->state = $value;
      break;
      case "zip":
      $this->zip = $value;
      break;
      case "create_date":
      $this->create_date = $value;
      break;
      case "last_update_date":
      $this->last_update_date = $value;
      break;
      case "reply_by_date":
      $this->reply_by_date = $value;
      break;
      case "start_date_time":
      $this->start_date_time = $value;
      break;
      case "end_date_time":
      $this->end_date_time = $value;
      break;
      default:
      throw new Exception("Attribute " . $attribute . " not found.");
    }
  }

  function get_event_id(){ return $this->event_id; }
  function get_couple_id(){ return $this->couple_id; }
  function get_master_event_id(){ return $this->master_event_id; }
  function get_name(){ return $this->name; }
  function get_type(){ return $this->type; }
  function get_start_date_time(){ return $this->start_date_time; }
  function get_end_date_time(){ return $this->endpoint_date_time; }
  function get_reply_by_date(){ return $this->reply_by_date; }
  function get_address(){ return $this->address; }
  function get_city(){ return $this->city; }
  function get_state(){ return $this->state; }
  function get_zip(){ return $this->zip; }
  function get_create_date(){ return $this->create_date; }
  function get_last_update_date(){ return $this->last_update_date; }
}
?>

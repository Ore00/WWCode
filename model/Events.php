<?php

require_once("includes/functions.inc");
if(!class_exists("DBQuery")){

  require_once(base_path .'/vendor/DBQuery.php');
}
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
    $insertId = NULL;

    self::set_value("last_update_date", 'CURRENT_TIMESTAMP');
    self::set_value("create_date", 'CURRENT_TIMESTAMP');

    if(self::get_master_event_id() == null){ self::set_value("master_event_id", '0');}
    self::validate_values();
    $connection = new DBQuery();
    if($connection->sql_error()  == false){
      $labelArray = array("couple_id", "master_event_id", "name", "type", "start_date_time",
       "end_date_time", "reply_by_date", "address", "city", "state", "zip", "create_date", "last_update_date");

      $valueArray = array("'" . $this->get_couple_id() ."'", "'" .$this->get_master_event_id(). "'", "'" .$this->get_name() ."'",
      "'". $this->get_type() ."'", "'". $this->get_start_date_time() ."'", "'" . $this->get_end_date_time() ."'",
      "'". $this->get_reply_by_date(). "'", "'". $this->get_address() ."'", "'". $this->get_city() ."'", "'". $this->get_state() ."'",
      "'". $this->get_zip() ."'",
      $this->get_create_date(),
      $this->get_last_update_date());
      $col = implode(",", $labelArray) ;
      $val = implode(", ", $valueArray);
      $sql = "INSERT INTO events ( $col ) values ( $val )";
      
      $connection->query($sql);

      $error = $connection->sql_error();
      if($connection->sql_error() == false){
        $insertId = $connection->lastInsertedID();
        self::read($insertId);
      }else{
        throw new Exception($connection->sql_error());
      }
      $connection->close();
    }else{
      throw new Exception($connection->sql_error());
    }

    return $insertId;
  }
  function read($event_id = null){
    //get event details from the database
    if($event_id != NULL || $event_id != "")
    {
      $connection = new DBQuery;
      if($connection->sql_error() == false){
        $sql = "SELECT * FROM `events` where couple_id = $event_id";
        $result = $connection->query($sql);
        if($connection->sql_error() == false){
          if( $connection->numRows($result) > 0)
          {
            $data = $connection->fetchAssoc($result);
            //set all values to row
            if(is_array($data)){ self::set_all($data); }

          }else{

            throw new Exception("Event id " . $event_id . " not found.");
          }

        }else{

          throw new Exception($connection->sql_error());
        }
      }
      $connection->freeResult($result);
      $connection->close();
    }else {

      throw new Exception("Search incomplete: event id is missing.");
    }

    return  (isset($data) && is_array($data)) ? $data : array();
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
  function set_all($data = array()){

    if(is_array($data) && count($data) > 1){

      foreach($data as $key => $value){
        self::set_value($key, $value);
      }
    }else{
      throw new Exception("Cannot set all couples array of values not provided.");
    }
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
  function get_end_date_time(){ return $this->end_date_time; }
  function get_reply_by_date(){ return $this->reply_by_date; }
  function get_address(){ return $this->address; }
  function get_city(){ return $this->city; }
  function get_state(){ return $this->state; }
  function get_zip(){ return $this->zip; }
  function get_create_date(){ return $this->create_date; }
  function get_last_update_date(){ return $this->last_update_date; }
  function validate_values(){

    if(self::get_couple_id() == null){throw new Exception("Couple id is required.");}
    if(self::get_name() == null){throw new Exception("Event name is required.");}
    if(self::get_type() == null){throw new Exception("Event Type is required.");}
    if(self::get_address() == null){throw new Exception("Address is required.");}
    if(self::get_city() == null){throw new Exception("City is required.");}
    if(self::get_state() == null){throw new Exception("State is required.");}
    if(self::get_zip() == null){throw new Exception("Zip is required.");}
    if(self::get_reply_by_date() == null){throw new Exception("Reply By date is required.");}
    if(self::get_start_date_time() == null){throw new Exception("Start date time is required.");}
    if(self::get_end_date_time() == null){throw new Exception("End date time is required.");}
    if(self::get_create_date() == null){throw new Exception("Create date is required.");}
    if(self::get_last_update_date() == null){throw new Exception("Last update date is required.");}


  }
}
?>

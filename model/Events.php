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
      self::read($event_id);
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

      $name = $connection->escapeString($this->get_name());
      $type = $connection->escapeString($this->get_type());
      $address = $connection->escapeString($this->get_address());
      $city = $connection->escapeString($this->get_city());
      $state = $connection->escapeString($this->get_state());
      $zip = $connection->escapeString($this->get_zip());

      $valueArray = array("'" . $this->get_couple_id() ."'", "'" .$this->get_master_event_id(). "'", "'" . $name ."'",
      "'". $type ."'", "'". $this->get_start_date_time() ."'", "'" . $this->get_end_date_time() ."'",
      "'". $this->get_reply_by_date(). "'", "'". $address ."'", "'". $city ."'", "'". $state ."'",
      "'". $zip ."'",
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
        $sql = "SELECT * FROM `events` where event_id = $event_id";
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
    throw new Exception("Updating an event isn't configured for this project.");
  }
  function delete(){
    //remove a event from the database
    throw new Exception("Deleting an event isn't allowed for this project.");

  }
  function get_all($event_id = null){
    //get all event from the database
    if($event_id != null || $event_id != "")
    {
      $connection = new DBQuery;
      if($connection->sql_error() == false){
        $sql = "SELECT * FROM `events` where event_id = $event_id or master_event_id = $event_id";
        $result = $connection->query($sql);
        if($connection->sql_error() == false){
          if( $connection->numRows($result) > 0)
          {
            $data = $connection->fetchAll($result);

          }else{

            throw new Exception("No event were found.");
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
  function set_all($data = array()){

    if(is_array($data) && count($data) > 1){

      foreach($data as $key => $value){
        self::set_value($key, $value);
      }
    }else{
      throw new Exception("Cannot set all events, array of values not provided.");
    }
  }
  function get_all_weddings($event_id = null){
    //get all wedding events from the database

      $connection = new DBQuery;
      if($connection->sql_error() == false){

        $sql = ($event_id !=null ) ? "SELECT * FROM `wedding_list` where event_id = $event_id" : "SELECT * FROM `wedding_list`";
        $result = $connection->query($sql);
        if($connection->sql_error() == false){
          if( $connection->numRows($result) > 0)
          {
            $data = $connection->fetchAll($result);

          }else{

            throw new Exception("Event List not found.");
          }

        }else{

          throw new Exception($connection->sql_error());
        }
      }
      $connection->freeResult($result);
      $connection->close();
    return  (isset($data) && is_array($data)) ? $data : array();
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

  function get_event_types($event_id = null){
    if($event_id == null){  throw new Exception("Can't determin Event types because the event id is missing."); }
    $events_with_master_id = self::get_all($event_id);
    $event_type = array();
    foreach ($events_with_master_id as $key){

      array_push($event_type, $key["type"]);

    }
    return $event_type;
  }
  function get_events_by_couple($couple_id = null){
    //get event details from the database
    if($couple_id != NULL || $couple_id != "")
    {
      $connection = new DBQuery;
      if($connection->sql_error() == false){
        $sql = "SELECT * FROM `events` where couple_id = $couple_id";
        $result = $connection->query($sql);
        if($connection->sql_error() == false){
          if( $connection->numRows($result) > 0)
          {
            $data = $connection->fetchall($result);

          }else{

            throw new Exception("Event not found.");
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
  function get_event_details($result = array() ){
    // $start_datetime = strtotime($event_wedding["start_date_time"]);
    // $start_time = date("g:i A", $start_datetime);
    // $wedding_date = date("d.m.Y", $start_datetime);
    $data = array();
    if( gettype($result) == "array" && count($result) > 0)
    {
      foreach($result as $row){
        $start_datetime = strtotime($row["start_date_time"]);

        $data["type"] = $row["type"];
        if($row["type"] == "Wedding"){
          $data["wedding_event_id"] = $row["event_id"];
          $data["start_datetime"] = strtotime($row["start_date_time"]);
          $data["reply_datetime"] = strtotime($row["reply_by_date"]);
          $data["wedding_time"] = date("g:i A",   $data["start_datetime"]);
          $data["wedding_date"] = date("d.m.Y",   $data["start_datetime"]);
          $data["reply_date"] = date("F, Y",   $data["reply_datetime"]);
          $data["reply_date_disable"] = date("Y, m, d",   $data["reply_datetime"]);
          $data["wedding_venue"] = $row["name"];
          $data["wedding_address"] = $row["address"] . " " . $row["city"] . ", " . $row["state"] . " " . $row["zip"];
        }elseif($row["type"] == "Reception"){
          $data["reception_event_id"] = $row["event_id"];
           $data["reception_start_datetime"] = strtotime($row["start_date_time"]);
          $data["reception_time"] = date("g:i A",   $data["reception_start_datetime"]);
          $data["reception_date"] = date("d.m.Y",   $data["reception_start_datetime"]);
          $data["reception_venue"] = $row["name"];
          $data["reception_address"] = $row["address"] . " " . $row["city"] . ", "  . $row["state"] . " " . $row["zip"];
        }

      }
    }
    return $data;
  }

}
?>

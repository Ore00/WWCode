<?php

require_once("includes/functions.inc");
if(!class_exists("DBQuery")){

  require_once(base_path .'/vendor/DBQuery.php');
}
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
      self::read($rsvp_id);
    }
  }
  function create(){
    //create a new rsvp in the database
    $insertId = NULL;

    self::set_value("last_update_date", 'CURRENT_TIMESTAMP');
    self::set_value("create_date", 'CURRENT_TIMESTAMP');


    self::validate_values();
    $connection = new DBQuery();
    if($connection->sql_error()  == false){
      $labelArray = array("event_id", "first_name", "last_name", "email", "events",
       "number_in_party", "status", "create_date", "last_update_date");

      $valueArray = array("'" . $this->get_event_id() ."'", "'" .$this->get_first_name(). "'", "'" .$this->get_last_name() ."'",
      "'". $this->get_email() ."'", "'". $this->get_events() ."'", "'" . $this->get_number_in_party() ."'",
      "'". $this->get_status(). "'",
      $this->get_create_date(),
      $this->get_last_update_date());
      $col = implode(",", $labelArray) ;
      $val = implode(", ", $valueArray);
      $sql = "INSERT INTO rsvps ( $col ) values ( $val )";

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
  function read($rsvp_id = null){
    //get rsvp details from the database
    if($rsvp_id != NULL || $rsvp_id != "")
    {
      $connection = new DBQuery;
      if($connection->sql_error() == false){
        $sql = "SELECT * FROM `rsvps` where rsvp_id = $rsvp_id";
        $result = $connection->query($sql);
        if($connection->sql_error() == false){
          if( $connection->numRows($result) > 0)
          {
            $data = $connection->fetchAssoc($result);
            //set all values to row
            if(is_array($data)){ self::set_all($data); }

          }else{

            throw new Exception("RSVP id " . $rsvp_id . " not found.");
          }

        }else{

          throw new Exception($connection->sql_error());
        }
      }
      $connection->freeResult($result);
      $connection->close();
    }else{

      throw new Exception("Search incomplete: RSVP id is missing.");
    }

    return  (isset($data) && is_array($data)) ? $data : array();
  }
  function update($rsvp_id = null){
    //update couple in the database

    $affectedRows = NULL;
    self::set_value("last_update_date","CURRENT_TIMESTAMP");
    self::validate_values();


    if( $rsvp_id != null || trim($rspv_id)!= ""){
      $connection = new DBQuery();
      if($connection->sql_error()  == false){
          $sql = "UPDATE `rsvps` SET `event_id` = '". $this->event_id . "' ,  `first_name` = '" . $this->first_name  .  "' ,  `last_name` = '" . $this->last_name  .  "',  `email` = '" . $this->email  .  "',
           `events` = '". $this->events . "' ,  `number_in_party` = '". $this->number_in_party . "' ,  `status` = '". $this->status . "' ,  `last_update_date` = $this->last_update_date   WHERE `rsvp_id` = $rsvp_id";

            $connection->link->query($sql);
            //check to see if the sql error
            if($connection->sql_error() == false){
                  $affectedRows = $connection->affectedRows();
            }else{
              throw new Exception($connection->sql_error());
            }

      }else{
          throw new Exception($connection->sql_error());
      }
    }else{

      throw new Exception("RSVP Id is missing");
    }

    return $affectedRows;
  }
  function delete($rsvp_id = null){
    //remove a rsvp from the database
      throw new Exception("Deleting a rsvp isn't allowed for this project.");
  }
  function get_all($event_id = null){
    //get all rsvps from the database

      $connection = new DBQuery;
      if($connection->sql_error() == false){

        $sql = ($event_id !=null ) ? "SELECT * FROM `rsvps` where event_id = $event_id" : "SELECT * FROM `rsvps`";
        $result = $connection->query($sql);
        if($connection->sql_error() == false){
          if( $connection->numRows($result) > 0)
          {
            $data = $connection->fetchAll($result);

          }else{

            throw new Exception("RSVP id " . $rsvp_id . " not found.");
          }

        }else{

          throw new Exception($connection->sql_error());
        }
      }
      $connection->freeResult($result);
      $connection->close();
    return  (isset($data) && is_array($data)) ? $data : array();
  }
  function set_all($data = array()){

    if(is_array($data) && count($data) > 1){

      foreach($data as $key => $value){
        self::set_value($key, $value);
      }
    }else{
      throw new Exception("Cannot set all rsvps, array of values not provided.");
    }
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

  function validate_values(){

    if(self::get_event_id() == null){throw new Exception("Event id is required.");}
    if(self::get_first_name() == null){throw new Exception("First name is required.");}
    if(self::get_last_name() == null){throw new Exception("Last name is required.");}
    if(self::get_email() == null){throw new Exception("Email is required.");}
    if(self::get_events() == null){throw new Exception("Events is required.");}
    if(self::get_number_in_party() == null){throw new Exception("Number in party is required.");}
    if(self::get_status() == null){throw new Exception("Status is required.");}
    if(self::get_create_date() == null){throw new Exception("Create date is required.");}
    if(self::get_last_update_date() == null){throw new Exception("Last update date is required.");}


  }
}
?>

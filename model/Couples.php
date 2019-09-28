<?php

require_once("includes/functions.inc");

if(!class_exists("DBQuery")){

  require_once(base_path .'/vendor/DBQuery.php');
}

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
  protected $couple_story;
  protected $create_date;
  protected $last_update_date;


  function Couples($couple_id = null){

    if($couple_id != null){
      self::set_value('couple_id', $couple_id);
      self::read($couple_id);
    }
  }
  function create(){
    //create a new couple in the database

    $insertId = NULL;

    self::set_value("last_update_date", 'CURRENT_TIMESTAMP');
    self::set_value("create_date", 'CURRENT_TIMESTAMP');
    self::validate_values();

    $connection = new DBQuery();
    if($connection->sql_error()  == false){
      $labelArray = array("groom_first_name", "groom_last_name", "groom_email", "bride_first_name", "bride_last_name",
       "bride_email", "primary_contact", "couple_address", "couple_city", "couple_state", "couple_zip",
        "couple_story", "create_date", "last_update_date");

        //groom info
        $gfname = $connection->escapeString($this->get_groom_first_name());
        $glname = $connection->escapeString($this->get_groom_last_name());
        $gemail = $connection->escapeString($this->get_groom_email());

        //bride info
        $bfname = $connection->escapeString($this->get_bride_first_name());
        $blname = $connection->escapeString($this->get_bride_last_name());
        $bemail = $connection->escapeString($this->get_bride_email());

        //couple info
        $contact = $connection->escapeString($this->get_primary_contact());
        $address = $connection->escapeString($this->get_couple_address());
        $city = $connection->escapeString($this->get_couple_city());
        $state = $connection->escapeString($this->get_couple_state());
        $zip = $connection->escapeString($this->get_couple_zip());
        $story = $connection->escapeString($this->get_couple_story());


      $valueArray = array("'" . $gfname ."'", "'" . $glname . "'", "'" . $gemail ."'", "'". $bfname ."'", "'". $blname ."'", "'" . $bemail ."'",
      "'". $contact . "'", "'". $address ."'", "'". $city ."'", "'". $state ."'",
      "'". $zip ."'", "'". $story ."'",
      $this->get_create_date(),
      $this->get_last_update_date());

      $col = implode(",", $labelArray) ;
      $val = implode(", ", $valueArray);
      $sql = "INSERT INTO couples ( $col ) values ( $val )";

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
  function read($couple_id = null){
    //get a couple row of  details from the database
    if($couple_id != NULL || $couple_id != "")
    {
      $connection = new DBQuery;
      if($connection->sql_error() == false){
        $sql = "SELECT * FROM `couples` where couple_id = $couple_id";
        $result = $connection->query($sql);
        if($connection->sql_error() == false){
          if( $connection->numRows($result) > 0)
          {
            $data = $connection->fetchAssoc($result);
            //set all values to row
            if(is_array($data)){ self::set_all($data); }

          }else{

            throw new Exception("Couple id " . $couple_id . " not found.");
          }

        }else{

          throw new Exception($connection->sql_error());
        }
      }
      $connection->freeResult($result);
      $connection->close();
    }else {

      throw new Exception("Search incomplete: couple id is missing.");
    }

    return  (isset($data) && is_array($data)) ? $data : array();
  }
  function update(){
    //update couple in the database
      throw new Exception("Updating a couple isn't configured for this project.");
  }
  function delete(){
    //remove a couple from the database
      throw new Exception("Deleting a couple isn't allowed for this project.");
  }
  function get_all(){
    //get all couples from the database

      $connection = new DBQuery;
      if($connection->sql_error() == false){
        $sql = "SELECT * FROM `couples`";
        $result = $connection->query($sql);
        if($connection->sql_error() == false){
          if( $connection->numRows($result) > 0)
          {
            $data = $connection->fetchAll($result);

          }else{

            throw new Exception("No Couples found.");
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
      throw new Exception("Cannot set all couples array of values not provided.");
    }
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
      case "couple_story":
      $this->couple_story = $value;
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
  function get_couple_story(){ return $this->couple_story; }
  function get_create_date(){ return $this->create_date; }
  function get_last_update_date(){ return $this->last_update_date; }

  function validate_values(){

    if(self::get_groom_first_name() == null){throw new Exception("Groom First name is required.");}
    if(self::get_groom_last_name() == null){throw new Exception("Groom Last name is required.");}
    if(self::get_groom_email() == null){throw new Exception("Groom email is required.");}
    if(self::get_bride_first_name() == null){throw new Exception("Bride First name is required.");}
    if(self::get_bride_last_name() == null){throw new Exception("Bride Last name is required.");}
    if(self::get_bride_email() == null){throw new Exception("Bride email is required.");}
    if(self::get_couple_address() == null){throw new Exception("Couple Address is required.");}
    if(self::get_couple_city() == null){throw new Exception("Couple city is required.");}
    if(self::get_couple_state() == null){throw new Exception("Couple state is required.");}
    if(self::get_couple_zip() == null){throw new Exception("Couple zip is required.");}
    if(self::get_primary_contact() == null){throw new Exception("Primary contact is required.");}
    if(self::get_create_date() == null){throw new Exception("Create date is required.");}
    if(self::get_last_update_date() == null){throw new Exception("Last update date is required.");}


  }


}
?>

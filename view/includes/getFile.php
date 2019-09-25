<?php
//error_reporting('E_NONE');
if(!class_exists("DBQuery")){

  require_once(base_path .'/vendor/DBQuery.php');
}
if(!class_exists("RSVPs")){
  require_once("../../model/RSVPs.php");
}
try{
  if(isset($_GET['type'])){
     if($_GET['type'] == "F"){
       getExcelFile($_GET['client']);
     }
  }

}catch(Exception $e){
      $error .= $e->getMessage();
}
function getEvents($client, $tableID){

  $con = new DBQuery();
  if($all != False){
    $sql = "select distinct client_name from " . $tableID . " where client_name = '". $client . "'";
  }else{
    $sql = "select distinct client_name from " . $tableID;
  }
  if($con->sql_error() == false){
    if($result = $con->query($sql)){
        if($con->sql_error()  == 0){$num = $con->numRows($result);}
        if($num > 0){
           $rows = $con->fetchAll($result);
           if(isset($num) && @$num > 0 ){
             foreach($rows as $row){
                $results["data"][] =  $row["client_name"];
             }
             $con->close();
           }
         }else{
           $results["data"] = array();
         }
    }
  }else{
    $results["error"] = $con->sql_error();
  }
  return $results;
}
function getReportDetails($client, $tableID="DataList", $all=False, $type="dashboard"){
  try{
    $rsvp = new RSVPs();
    $rows = $rsvp->get_all($client);
    $num = (isset($rows) && count($rows) > 0) ? $rows : 0;
    
    //Create table headers
    if($type == "dashboard"){
      $theads = '<table  id="' . $tableID . '" class="table table-responsive-sm table-hover table-condensed">
        <thead><tr>
            <td> Name </td>
            <td> # in Party </td>
            <td> Events </td>
            <td> RSVP </td></tr>
            <thead><tbody>';
    }else{
      $theads = '<table id="' . $tableID . '" class="table collapse table-condensed table-responsive-sm">
        <thead><tr>
            <td> RSVP ID</td>
            <td> Name </td>
            <td> Email </td>
            <td> # in Party </td>
            <td> Events </td>
            <td> RSVP </td>
            <td> Created</td></thead>
        </thead><tbody>';
      }
      //create table body
        $tbody = '';
    if (isset($num) && @$num > 0 ){
      foreach($rows as $row){
         $field1name = $row["rsvp_id"];
        // $field2name = $row["client_name"];
         $field3name = $row["first_name"] . " ". $row["last_name"];
         $field4name = $row["email"];
         $field5name = $row["number_in_party"];
         $field6name = $row["events"];
         $field7name = $row["status"];
         $field8name = $row["create_date"];

         if($type == "dashboard"){
           $tbody .= '<tr>
                    <td>'.$field3name.'</td>
                     <td>'.$field5name.'</td>
                     <td>'.$field6name.'</td>
                      <td>'.$field7name.'</td>
                 </tr>';

         }else{
           $tbody .= '<tr>
                    <td>'.$field1name.'</td>
                    <td>'.$field3name.'</td>
                    <td>'.$field4name.'</td>
                     <td>'.$field5name.'</td>
                     <td>'.$field6name.'</td>
                      <td>'.$field7name.'</td>
                      <td>'.$field8name.'</td>
                 </tr>';
               }

      }
    //  $con->close();
    }
    //create table footer

     if($type == "dashboard"){
          $tfoot = '</tbody><tfoot><tr><td></td><td></td><td></td><td></td></tr></tfoot></table>';
        }else{
           $tfoot = '</tbody><tfoot><tr><td></td><td></td><td></td><td></td><td>
           </td><td></td><td></td></tr></tfoot></table>';
        }

    }catch(Exception $e){
        $error .= $e->getMessage();
    }
      $result = (@$error <> "") ? $error : $theads . $tbody . $tfoot;

    return $result;
}


?>

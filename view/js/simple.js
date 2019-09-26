$(document).ready(function() {

  var replyDate = document.getElementById("reply_date").value;
  var endDate = new Date(replyDate);

var currentDate = new Date();

if(currentDate >= endDate ){
   document.getElementById("btnGoing").disabled = true;
   document.getElementById("btnNotGoing").disabled = true;
   document.getElementById("msg_closed_rsvp").style.display = "block";
}


});
function showText(){
  document.getElementById("more_dots").style.display = "none";
  document.getElementById("more_text").style.display = "block";
}
function getFormValues(formName){
 var frm = document.getElementById(formName);
 var values = "";
 var i;
 for (i = 0; i < frm.length; i++){
     values = values + frm.elements[i].name + ": " + frm.elements[i].value + "<br>";
 }
 return values;
}

function checkFormInput(FormName){
     var inputStr = "";
     var frmList = document.getElementById(FormName);
     var i;
    for(i = 0; i < frmList.length; i++){
        if(frmList.elements[i].name !== ""){
         inputStr +=   frmList.elements[i].name + ": " + frmList.elements[i].value + "\n";
     }
    }
    alert(inputStr);
}

function getArrayElement(arr){
   var thisArray = arr.values();
   var thisStr = "";
   for(let item of thisArray){
       thisStr = thisStr.concat(item,  "<br />");
   }
   return thisStr;
}

function getAjaxProcess(data, url, callback){

    var step;
    var result = "";
    $.ajax({
    url: url,
    type: 'POST',
    async: false,
    //timeout: 180000,
    data: data
    }).done(function(data){
    // alert(JSON.stringify(data));
    var JSONstr = JSON.parse(data);
         //check whether process ran successfully

         if(JSONstr.sysError == ""){
              step = true;
              createStatusBox("statusBox", "alert alert-success", "formStatus");
             result =  JSONstr.msg;
             $("#statusBox").append(result + "<br>" );
           }else{
                          //if process rendered an error
             step = false;
             createStatusBox("statusBox", "alert alert-danger", "formStatus");
             result = JSONstr.sysError;
            $("#statusBox").append(result + "<br>");
          }
            callback(step);
       }).fail(function(jqXHR, textStatus){
         createStatusBox("statusBox", "alert alert-danger", "formStatus");
         result = "System error: " + textStatus + " : " + jqXHR.responseText;
         $("#statusBox").append(result + "<br />");
       });
}
function getAjaxResults(data, url, callback){
    var step;
    var result = "";

    $.ajax({
    url: url,
    type: 'POST',
    async: false,
    timeout: 180000,
    data: data
    }).done(function(data){

    var JSONstr = JSON.parse(data);
            step =  JSONstr;
            callback(step);
       }).fail(function(jqXHR, textStatus){
         step = "System error: " + textStatus + " : " + jqXHR.responseText;
       });
}
function urlValid(url){
  var http = new XMLHttpRequest();
  http.open('HEAD', url, false);
  http.send();
  return (http.status == 200) ? true: false;
}
function isProcessingBTN(theButton, status=true){
    //theButton.disabled = status;
    if(status === true){
    $("#" + theButton).attr("disabled", "disabled");
    }else{
    $("#" + theButton).removeAttr("disabled");
}

 }
 function getReportTotals(client){
   var data = {client: client};
   var step;
     getAjaxResults(data, "view/includes/getCounts.php", function(d){  step = d; });
     return step;
 }
 function getProcessForm(email, first_name, last_name, events, guest, rsvp_val, client){
 var data = {email: email, first_name: first_name, last_name: last_name, events: events, guest: guest, rsvp_val: rsvp_val, client: client} ;
 var step;

   getAjaxProcess(data, "view/includes/processForm.php", function(d){  step = d; });
   return step;
 }
function processForm(rsvp_val){

  if(validateForm("rsvp_form")){
     var email = document.getElementById("email").value;
     var first_name = document.getElementById("first_name").value;
     var last_name = document.getElementById("last_name").value;
     var events = document.getElementById("events").value;
     var guest = document.getElementById("guest").value;
     var client = document.getElementById("clientID").value;
     var result = getProcessForm(email, first_name, last_name, events, guest, rsvp_val, client);

}else{
    createStatusBox("statusBox", "alert alert-danger", "formStatus");
    $("#statusBox").append("All fields are required.");
    return;
}

//  $("#statusBox").append(" " + result + "<br>");
}

function createStatusBox(statusBoxName, statusBoxClass, mainBox){
    if( $("#" + statusBoxName).length){
    $("#" + statusBoxName).remove();
    }
    var setBox = page_error_nohead(statusBoxName);
    $("#" + mainBox).append(setBox);
    $("#" + statusBoxName).removeClass();
    $("#" + statusBoxName).addClass(statusBoxClass);
    $("#" + statusBoxName).show();
}
function page_error_nohead(divID){
 var box = "<div id='";
 box = box + divID;
 box = box + "'>";
 box = box + "<span class='close'";
 box = box + 'onclick="';
 box = box + "this.parentElement.style.display='none'";
 box = box + ';"';
 box = box + ">";
 box = box + "&times;</span></div>";

 return box;
}

function validateForm(FormName) {
  // This function deals with validation of the form fields
  var y, i, valid = true;
  y = document.getElementById(FormName);
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "" && y[i].type != "button") {
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }

  return valid; // return the valid status
}
$(window).on('resize', function() {
  var win = $(this);
 if (win.width() < 700) {
     $("h1").removeClass('w3-jumbo');
     $("h2").removeClass('w3-xxxlarge');
     $("h3").removeClass('w3-xxlarge');
     $("h1").addClass('w3-xxlarge');
     $("h2").addClass('w3-xlarge');
     $("h3").addClass('w3-large');
     $("#rvsp").addClass('w3-center');
     $("#aboutText").addClass('w3-center');
     $("#registers").addClass('w3-medium');
     $("#registers").removeClass('w3-large');
     $("#btn_rsvp_top").show();
     $("#metric-one").addClass('well-small');
     $("#metric-two").addClass('well-small');
     $("#metric-three").addClass('well-small');
     $("#metric-four").addClass('well-small');
     $("#chartNotGoing").addClass('miniChart');
     $("#dashNotGoing").removeClass('reportRow');
  }
   else {
    $("h1").addClass('w3-jumbo');
    $("h1").removeClass('w3-xxlarge');
    $("h2").addClass('w3-xxxlarge');
    $("h2").removeClass('w3-xxlarge');
    $("h3").addClass('w3-xxlarge');
    $("h3").removeClass('w3-large');
    $("#rvsp").removeClass('w3-center');
    $("#aboutText").removeClass('w3-center');
    $("#registers").removeClass('w3-medium');
    $("#registers").addClass('w3-large');
    $("#btn_rsvp_top").hide();
    $("#metric-one").removeClass('well-small');
    $("#metric-two").removeClass('well-small');
    $("#metric-three").removeClass('well-small');
    $("#metric-four").removeClass('well-small');
    $("#chartNotGoing").removeClass('miniChart');
    $("#dashNotGoing").addClass('reportRow');
  }
});
$(window).on('load', function() {
  var win = $(this);
 if (win.width() < 700) {
     $("h1").removeClass('w3-jumbo');
     $("h2").removeClass('w3-xxxlarge');
     $("h3").removeClass('w3-xxlarge');
     $("h1").addClass('w3-xxlarge');
     $("h2").addClass('w3-xlarge');
     $("h3").addClass('w3-large');
     $("#rvsp").addClass('w3-center');
     $("#aboutText").addClass('w3-center');
     $("#registers").addClass('w3-medium');
     $("#registers").removeClass('w3-large');
     $("#btn_rsvp_top").show();
     $("#metric-one").addClass('well-small');
     $("#metric-two").addClass('well-small');
     $("#metric-three").addClass('well-small');
     $("#metric-four").addClass('well-small');
     $("#chartNotGoing").addClass('miniChart');
     $("#dashNotGoing").removeClass('reportRow');
  }
   else {
    $("h1").addClass('w3-jumbo');
    $("h1").removeClass('w3-xxlarge');
    $("h2").addClass('w3-xxxlarge');
    $("h2").removeClass('w3-xxlarge');
    $("h3").addClass('w3-xxlarge');
    $("h3").removeClass('w3-large');
    $("#rvsp").removeClass('w3-center');
    $("#aboutText").removeClass('w3-center');
    $("#registers").removeClass('w3-medium');
    $("#registers").addClass('w3-large');
    $("#btn_rsvp_top").hide();
    $("#metric-one").removeClass('well-small');
    $("#metric-two").removeClass('well-small');
    $("#metric-three").removeClass('well-small');
    $("#metric-four").removeClass('well-small');
    $("#chartNotGoing").removeClass('miniChart');
    $("#dashNotGoing").addClass('reportRow');
  }
});

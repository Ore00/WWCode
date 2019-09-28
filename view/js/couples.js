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

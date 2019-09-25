$("#eID").change(function(){
    window.reload = getDash();
});
window.onload = getDash();
function getDash() {
var eID = document.getElementById("eID").value;

var reportTotals = getReportTotals(eID);

//Goong vs Not Going Chart
var GoingCountWedding = reportTotals.reportInfo[1];
var notGoingCountWedding = reportTotals.reportInfo[2];
var goingCountReception = reportTotals.reportInfo[3];
var notGoingCountReception = reportTotals.reportInfo[4];
var errorTotalCount = reportTotals.reportInfo[0];
var totalVisitors = GoingCountWedding + notGoingCountWedding  + goingCountReception + notGoingCountReception;

//RSVP Chart
var chrtRSVP = document.getElementById("rsvpChart").getContext('2d');
var Wedding = reportTotals.reportInfo[1];
var Reception = reportTotals.reportInfo[3];
var totalRSVP = reportTotals.reportInfo[5];
$("#countRSVPs").html(totalRSVP);

var myChartRSVP = new Chart(chrtRSVP, {
  type: 'doughnut',
  data: {
    labels: ["Wedding", "Reception"],
    datasets: [{
      backgroundColor: [
        "#06CA31",
        "#B5B6BA"
      ],
      data: [Wedding, Reception]
    }]
  },
  options: {
        rotation: 1 * Math.PI,
        circumference: 1 * Math.PI,
        legend: {
          display: true,
          position: 'bottom',
            labels: {
              fontColor: "#000000",
            }
          },
          label: {
            label: 'value',
          }
    }
});

//Remaining RSVP availibility
var chrtAvail = document.getElementById("availChart").getContext('2d');
var rsvpLimit = reportTotals.reportInfo[8];
var confirmed = reportTotals.reportInfo[1];
var rsvpConfirmed = (rsvpLimit < confirmed) ? rsvpLimit : confirmed;
var rsvpAvail = ((rsvpLimit - confirmed) > 0) ? rsvpLimit - confirmed : 0;
var rsvpWait = (rsvpAvail == 0) ? confirmed - rsvpLimit : 0;
$("#countAvailable").html(rsvpAvail);
if(rsvpWait > 0){
  var thisData = [rsvpConfirmed, rsvpWait];
  var thisLabel = ["Reserved", "Waiting"];
  var thisColor = ["#06CA31",  "red",];
}else{
  var thisData = [rsvpConfirmed, rsvpAvail];
  var thisLabel = ["Reserved", "Available"];
  var thisColor = ["#06CA31",  "#B5B6BA",];
}

var myChartAvailable= new Chart(chrtAvail, {
  type: 'doughnut',
  data: {
    labels: thisLabel,
    datasets: [{
      backgroundColor: thisColor,
      data: thisData
    }]
  },
  options: {
        rotation: 1 * Math.PI,
        circumference: 1 * Math.PI,
        legend: {
          display: true,
          position: 'bottom',
            labels: {
              fontColor: "#000000",
            }
          }
    }
});

//Response Chart
var chrtResponse = document.getElementById("responseChart").getContext('2d');
var invitations = reportTotals.reportInfo[7];
var responses =  reportTotals.reportInfo[6];
var totalResponse = reportTotals.reportInfo[6];
$("#countResponses").html(totalResponse);
$("#countInvitations").html(invitations);
var noReply = invitations - responses;
var myChart = new Chart(chrtResponse, {
  type: 'doughnut',
  data: {
    labels: ["Responses", "No Response"],
    datasets: [{
      backgroundColor: [
        "#06CA31",
        "#B5B6BA"
      ],
      data: [responses, noReply]
    }]
  },
  options: {
        rotation: 1 * Math.PI,
        circumference: 1 * Math.PI,
        legend: {
          display: true,
          position: 'bottom',
            labels: {
              fontColor: "#000000",
            }
          }
    }
});
}
function exportReport(){
  $("#DataList").table2csv({
    separator: ',',
    newline: '\n',
    quoteFields: true,
    excludecolumns: '',
    excludeRows: '',
    filename: 'ReservationList.csv'
  });
}

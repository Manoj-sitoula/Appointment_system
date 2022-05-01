function getNoOfOfficers()
{
    $.ajax({
        type:"GET",
        url:"totalOfficers",
        success:function(response){
            $('#total_officer').text(response);
        }
    });
}

function getNoOfVisitors()
{
    $.ajax({
        type:"GET",
        url:"totalVisitors",
        success:function(response){
            $('#total_visitor').text(response);
        }
    });
}

function getNoOfAppointments()
{
    $.ajax({
        type:"GET",
        url:"totalAppointments",
        success:function(response){
            $('#total_appointment').text(response);
        }
    });
}

$(document).ready(function(){
    setInterval(getNoOfOfficers,100);
    setInterval(getNoOfVisitors,100);
    setInterval(getNoOfAppointments,100);
   });
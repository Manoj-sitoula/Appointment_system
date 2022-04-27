
$(document).ready(function(){
    
$(".chosen").chosen({width: "95%"});
});


$('#start_time').datetimepicker({
    format: 'HH:mm'
});

$('#end_time').datetimepicker({
    useCurrent: false,
    format: 'HH:mm'
});

var token_id = $("meta[name='csrf-token']").attr("content");


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

$('#newstart_time').datetimepicker({
    format: 'HH:mm'
});

$('#newend_time').datetimepicker({
    useCurrent: false,
    format: 'HH:mm'
});

$('#first_time').datetimepicker({
    format: 'HH:mm'
});

$('#second_time').datetimepicker({
    useCurrent: false,
    format: 'HH:mm'
});

$(document).ready(function(){
    $(document).on('click','#updatebutton',function(){
        var user_id = $(this).val();
        $.ajax({
            type:"GET",
            url:"getActivityDetail/"+user_id,
            success:function(response){
                dataActivity = response.activity;
                $.each(dataActivity,function(index,item){
                    $('#newactivity_id').val(item.activity_id);
                    $('#newname').val(item.name);
                    $('#newdate').val(item.date);
                    $('#newstart_time').val(item.start_time);
                    $('#newend_time').val(item.end_time);
                });
                
                dataOfficer = response.officername;
                $.each(dataOfficer,function(index,item){
                    var officer_name = item.officer_first_name+" "+item.officer_last_name ;

                    $("select option").each(function(){
                        if ($(this).text() == officer_name)
                          $(this).attr("selected","selected");
                      });

                });

                dataVisitor = response.visitorname;
                $.each(dataVisitor,function(index,item){
                    var visitor_name = item.visitor_first_name+" "+item.visitor_last_name ;
                    $("select option").each(function(){
                        if ($(this).text() == visitor_name)
                          $(this).attr("selected","selected");
                      });
                });  
            }
        });
    });
});



$("#filter").change(function() {
    var data = ($(this).find("option:selected").val());
    if(data == 'officer' || data == 'visitor' || data== 'type' || data == 'status')
    { 
        $('#filter_key').val(data);
        $('#search').css("display","block");
        $('#searchdate').css("display","none");
        $('#time').css("display","none");
    }
    else if(data == 'date')
    {
        $("#search").removeAttr("style");
        $("#searchdate").removeAttr("style");
        $("#time").removeAttr("style");
        $('#search').css("display","none");
        $('#searchdate').css("display","block");
        $('#time').css("display","none");
    }
    else if(data == 'time')
    {
        $("#search").removeAttr("style");
        $("#searchdate").removeAttr("style");
        $("#time").removeAttr("style");
        $('#search').css("display","none");
        $('#searchdate').css("display","none");
        $('#time').css("display","block");
    }
});
      


$(document).ready(function(){
    $("input[type = 'text']").on('keyup',function(){

        $.ajax({
            type:"GET",
            url:"searchResult",
            data:{
                key : $('#filter_key').val(),
                searchData : $('#search').val(),
            },
            success:function(response){
                
        console.log(response);
                var i =1;
                $('#activity_table').html(' ');
                $.each(response,function(index,item){

                    if(item.visitor_first_name == null && item.visitor_last_name == null)
                    {
                        var name = " ";
                    }
                    else
                    {
                        var name  = item.visitor_first_name+' '+item.visitor_last_name;
                    }
                if (item.type == 'Appointment')
                {
                   var type = '<button class="btn btn-primary btn-sm">Appointment</button>';
                }
                else if(item.type == 'Leave')
                {
                    var type = '<button class="btn btn-danger btn-sm">Leave</button>';
                }
                else if(item.type == 'Break')
                {
                    var type = '<button class="btn btn-warning btn-sm">Break</button>';
                }


                if (item.status == 'active')
                {
                    var status = ' <form action="/updateActivityStatus" method="POST"> <input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /> <input name="_method" type="hidden" value="PUT"> <input type="hidden" name="officer_id" id="officer_id" value="'+item.officer_id+'"><input type="hidden" name="visitor_id" id="visitor_id" value="'+item.visitor_id+'"><input type="hidden" name="activity_id" id="activity_id" value="'+item.activity_id+'"> <input type="hidden" name="status_value" id="status_value" value="'+item.status+'"><button class="btn btn-sm btn-success" value="active">Active</button></form>';
                    // var status = '<button class="btn btn-sm btn-success">Active</button>';
                }else if(item.status == 'inactive')
                {    
                    var status = ' <form action="/updateActivityStatus" method="POST"> <input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /> <input name="_method" type="hidden" value="PUT"> <input type="hidden" name="officer_id" id="officer_id" value="'+item.officer_id+'"><input type="hidden" name="visitor_id" id="visitor_id" value="'+item.visitor_id+'"><input type="hidden" name="activity_id" id="activity_id" value="'+item.activity_id+'"> <input type="hidden" name="status_value" id="status_value" value="'+item.status+'"><button class="btn btn-sm btn-danger" value="active">InActive</button></form>';
                    // var status = '<button class="btn btn-sm btn-danger">InActive</button>';
                }else{
                    var status = '<button class="btn btn-sm btn-warning">Cancelled</button>';   
                }

                var action ='<div class="row"><div class="col-lg-4 col-xl-5 col-md-12 col-sm-12 col"><button type="button" class="btn btn-info btn-sm" id="updatebutton" data-bs-toggle="modal" data-bs-target="#updateActivity" value="'+item.activity_id+'">Update</button></div><div class="col-lg-5 col-xl-5 col-md-12 col-sm-12"><form action="\cancelActivity" method="POST"><input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /><input name="_method" type="hidden" value="PUT"><button class="btn btn-sm btn-danger" name="activity_id"  value="'+item.activity_id+'">Cancel</button></form></div></div>';
             
                    
                $('#activity_table').append('<tr><td>'+i +'</td><td>'+ item.officer_first_name+' '+item.officer_last_name+'</td><td>'+name +'</td><td>'+ item.name+'</td> <td>'+ type+'</td><td>'+status +'</td><td>'+item.date +'</td><td>'+item.start_time +'</td><td>'+item.end_time +'</td><td>'+action +'</td></tr>');
                    i++;
                });
            }
        });
    });

    $('#searchdatebtn').on('click',function(){
        $.ajax({
            type:"GET",
            url:"searchResult",
            data:{
                key : $('#filter_date').val(),
                fromdate : $('#first_date').val(),
                todate : $('#last_date').val(),
            },
            success:function(response){
                var i =1;
                $('#activity_table').html(' ');
                $.each(response,function(index,item){

                    if(item.visitor_first_name == null && item.visitor_last_name == null)
                    {
                        var name = " ";
                        
                    }
                    else
                    {
                        var name  = item.visitor_first_name+' '+item.visitor_last_name;
                    }

                if (item.type == 'Appointment')
                {
                   var type = '<button class="btn btn-primary btn-sm">Appointment</button>';
                }
                else if(item.type == 'Leave')
                {
                    var type = '<button class="btn btn-danger btn-sm">Leave</button>';
                }
                else if(item.type == 'Break')
                {
                    var type = '<button class="btn btn-warning btn-sm">Break</button>';
                }

                if (item.status == 'active')
                {
                    var status = ' <form action="/updateActivityStatus" method="POST"> <input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /> <input name="_method" type="hidden" value="PUT"> <input type="hidden" name="officer_id" id="officer_id" value="'+item.officer_id+'"><input type="hidden" name="visitor_id" id="visitor_id" value="'+item.visitor_id+'"><input type="hidden" name="activity_id" id="activity_id" value="'+item.activity_id+'"> <input type="hidden" name="status_value" id="status_value" value="'+item.status+'"><button class="btn btn-sm btn-success" value="active">Active</button></form>';
                }else if(item.status == 'inactive')
                {    
                    var status = ' <form action="/updateActivityStatus" method="POST"> <input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /> <input name="_method" type="hidden" value="PUT"> <input type="hidden" name="officer_id" id="officer_id" value="'+item.officer_id+'"><input type="hidden" name="visitor_id" id="visitor_id" value="'+item.visitor_id+'"><input type="hidden" name="activity_id" id="activity_id" value="'+item.activity_id+'"> <input type="hidden" name="status_value" id="status_value" value="'+item.status+'"><button class="btn btn-sm btn-danger" value="active">InActive</button></form>';
                }else{
                    var status = '<button class="btn btn-sm btn-warning">Cancelled</button>';   
                }

                var action ='<div class="row"><div class="col-lg-4 col-xl-5 col-md-12 col-sm-12 col"><button type="button" class="btn btn-info btn-sm" id="updatebutton" data-bs-toggle="modal" data-bs-target="#updateActivity" value="'+item.activity_id+'">Update</button></div><div class="col-lg-5 col-xl-5 col-md-12 col-sm-12"><form action="\cancelActivity" method="POST"><input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /><input name="_method" type="hidden" value="PUT"><button class="btn btn-sm btn-danger" name="activity_id"  value="'+item.activity_id+'">Cancel</button></form></div></div>';
             
                    
                $('#activity_table').append('<tr><td>'+i +'</td><td>'+ item.officer_first_name+' '+item.officer_last_name+'</td><td>'+name +'</td><td>'+ item.name+'</td> <td>'+ type+'</td><td>'+status +'</td><td>'+item.date +'</td><td>'+item.start_time +'</td><td>'+item.end_time +'</td><td>'+action +'</td></tr>');
                    i++;
                });
            }
        });

    });
    $('#searchtimebtn').on('click',function(){
        $.ajax({
            type:"GET",
            url:"searchResult",
            data:{
                key : $('#filter_time').val(),
                fromtime : $('#first_time').val(),
                totime : $('#second_time').val(),
            },
            success:function(response)
            {
                var i =1;
                $('#activity_table').html(' ');
                $.each(response,function(index,item){

                    if(item.visitor_first_name == null && item.visitor_last_name == null)
                    {
                        var name = " ";
                        
                    }
                    else
                    {
                        var name  = item.visitor_first_name+' '+item.visitor_last_name;
                    }

                if (item.type == 'Appointment')
                {
                   var type = '<button class="btn btn-primary btn-sm">Appointment</button>';
                }
                else if(item.type == 'Leave')
                {
                    var type = '<button class="btn btn-danger btn-sm">Leave</button>';
                }
                else if(item.type == 'Break')
                {
                    var type = '<button class="btn btn-warning btn-sm">Break</button>';
                }

                if (item.status == 'active')
                {
                    var status = ' <form action="/updateActivityStatus" method="POST"> <input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /> <input name="_method" type="hidden" value="PUT"> <input type="hidden" name="officer_id" id="officer_id" value="'+item.officer_id+'"><input type="hidden" name="visitor_id" id="visitor_id" value="'+item.visitor_id+'"><input type="hidden" name="activity_id" id="activity_id" value="'+item.activity_id+'"> <input type="hidden" name="status_value" id="status_value" value="'+item.status+'"><button class="btn btn-sm btn-success" value="active">Active</button></form>';
                }else if(item.status == 'inactive')
                {    
                    var status = ' <form action="/updateActivityStatus" method="POST"> <input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /> <input name="_method" type="hidden" value="PUT"> <input type="hidden" name="officer_id" id="officer_id" value="'+item.officer_id+'"><input type="hidden" name="visitor_id" id="visitor_id" value="'+item.visitor_id+'"><input type="hidden" name="activity_id" id="activity_id" value="'+item.activity_id+'"> <input type="hidden" name="status_value" id="status_value" value="'+item.status+'"><button class="btn btn-sm btn-danger" value="active">InActive</button></form>'; 
                }else{
                    var status = '<button class="btn btn-sm btn-warning">Cancelled</button>';   
                }

                var action ='<div class="row"><div class="col-lg-4 col-xl-5 col-md-12 col-sm-12 col"><button type="button" class="btn btn-info btn-sm" id="updatebutton" data-bs-toggle="modal" data-bs-target="#updateActivity" value="'+item.activity_id+'">Update</button></div><div class="col-lg-5 col-xl-5 col-md-12 col-sm-12"><form action="\cancelActivity" method="POST"><input type="hidden" name="_token" id="csrf-token" value="'+token_id+'" /><input name="_method" type="hidden" value="PUT"><button class="btn btn-sm btn-danger" name="activity_id"  value="'+item.activity_id+'">Cancel</button></form></div></div>';
             
                    
                $('#activity_table').append('<tr><td>'+i +'</td><td>'+ item.officer_first_name+' '+item.officer_last_name+'</td><td>'+name+'</td><td>'+ item.name+'</td> <td>'+ type+'</td><td>'+status +'</td><td>'+item.date +'</td><td>'+item.start_time +'</td><td>'+item.end_time +'</td><td>'+action +'</td></tr>');
                    i++;
                });
            }
        });
    });   
});
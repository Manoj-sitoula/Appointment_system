$(document).ready(function(){
    $(document).on('click','#updatebtn',function(){
        var user_id = $(this).val();
        $.ajax({
            type:"GET",
            url:"getVisitorDetail/"+user_id,
            success:function(response){
                $('#visitor_id').val(response.visitor.id);
                $('#new_visitor_first_name').val(response.visitor.visitor_first_name);
                $('#new_visitor_last_name').val(response.visitor.visitor_last_name);
                $('#new_phone_no').val(response.visitor.mobile_number);
                $('#new_email').val(response.visitor.email);
            }

        });
    });
});


$(document).ready( function () {
    $('#myTable').DataTable();
} );


$(document).ready(function(){
    $(document).on('click','#visitorAppointmentbtn',function(){
        var user_id = $(this).val();
        $('#visitorAppointment').modal('show');
        var i = 1;
        data = " ";
        $.ajax({
            type:"GET",
            url:"getVisitorAppointments/"+user_id,
            success:function(response){
                console.log(response);
                $.each(response,function(index,item){
                    $.each(item,function(key, value){ 
                        if(value.status == 'active')
                        {
                            data =data + "<tr><td>"+i+"</td><td>"+value.officer_first_name +" "+ value.officer_last_name+"</td><td>"+value.date+"</td><td>"+value.start_time+"</td><td>"+value.end_time+"</td><td><a class='btn btn-sm btn-success'>Active</a></td></tr>";
                        }else if(value.status == 'inactive')
                        {
                            data =data + "<tr><td>"+i+"</td><td>"+value.officer_first_name +" "+ value.officer_last_name+"</td><td>"+value.date+"</td><td>"+value.start_time+"</td><td>"+value.end_time+"</td><td><a class='btn btn-sm btn-danger'>InActive</a></td></tr>";
                        }else
                        {
                            data =data + "<tr><td>"+i+"</td><td>"+value.officer_first_name +" "+ value.officer_last_name+"</td><td>"+value.date+"</td><td>"+value.start_time+"</td><td>"+value.end_time+"</td><td><a class='btn btn-sm btn-warning'>Cancalled</a></td></tr>";
                        }
                        i++;
                    });
                });
                $('#visitorAppointmentTbl').html(data);
            }
        });
    });
});


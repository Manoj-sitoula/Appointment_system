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
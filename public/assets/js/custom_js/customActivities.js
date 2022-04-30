
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
    console.log(data);
    $('#searchbtn').val(data);
    if(data == 'officer' || data == 'visitor' || data== 'type' || data == 'status')
    {
        
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
        
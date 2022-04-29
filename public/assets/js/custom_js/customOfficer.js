
    $('#work_start_time').datetimepicker({
        format: 'HH:mm'
    });

    $('#work_end_time').datetimepicker({
        useCurrent: false,
        format: 'HH:mm'
    });

    $('#new_work_start_time').datetimepicker({
        format: 'HH:mm'
    });

    $('#new_work_end_time').datetimepicker({
        useCurrent: false,
        format: 'HH:mm'
    });

    let firstName = document.querySelector("#officer_first_name");
    let lastName = document.querySelector("#officer_last_name");
    
    let register = document.querySelector("#register");

    let fnameTest;
    let lnameTest;

    firstName.addEventListener("blur", (e) => {
        let fullnameRegex = /^[A-Za-z]{3,15}$/i;
        if (fullnameRegex.test(firstName.value)) {
            e.target.classList.remove("is-invalid");
            e.target.classList.add("is-valid");
            fnameTest = true;
        } else {
            e.target.classList.remove("is-valid");
            e.target.classList.add("is-invalid");
            fnameTest = false;
        }
    });

      lastName.addEventListener("blur", (e) => {
        let fullnameRegex = /^[A-Za-z]{3,15}$/i;
        if (fullnameRegex.test(lastName.value)) {
            e.target.classList.remove("is-invalid");
            e.target.classList.add("is-valid");
            lnameTest = true;
        } else {
            e.target.classList.remove("is-valid");
            e.target.classList.add("is-invalid");
            lnameTest = false;
        }
    });

    setInterval(function() {
        if (fnameTest && lnameTest ) {
            register.removeAttribute("disabled", "disabled");
        } else {
            register.setAttribute("disabled", "disabled");
        }
    }, 500);


    $(document).ready(function(){
        $(document).on('click','#updatebtn',function(){
            var user_id = $(this).val();
            $.ajax({
                type:"GET",
                url:"getOfficerDetail/"+user_id,
                success:function(response){

                    $('input[type=checkbox]').each(function() 
                    { 
                        $(this).prop('checked', false); 
                    });

                    data = response.workdays;
                    $.each(data,function(index,item){
                        if(item.day_of_week == 'sunday')
                        {
                            $('#newsunday').prop("checked", true);
                        } 
                        if(item.day_of_week == 'monday')
                        {
                            $('#newmonday').prop("checked", true);
                        }
                        if(item.day_of_week == 'tuesday')
                        {
                            $('#newtuesday').prop("checked", true);
                        }
                        if(item.day_of_week == 'wednesday')
                        {
                            $('#newwednesday').prop("checked", true);
                        }
                        if(item.day_of_week == 'thursday')
                        {
                            $('#newthursday').prop("checked", true);
                        }
                        if(item.day_of_week == 'friday')
                        {
                            $('#newfriday').prop("checked", true);
                        }
                        if(item.day_of_week == 'saturday')
                        {
                            $('#newsaturday').prop("checked", true);
                        }
                    });

                    $('#officer_id').val(response.officer.id);
                    $('#new_officer_first_name').val(response.officer.officer_first_name);
                    $('#new_officer_last_name').val(response.officer.officer_last_name);
                    $('#new_post').val(response.officer.officer_post);
                    $('#new_work_start_time').val(response.officer.work_start_time);
                    $('#new_work_end_time').val(response.officer.work_end_time);
                }
            });
        });
    });
    

    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    

    $(document).ready(function(){
        $(document).on('click','#appointments',function(){
            var user_id = $(this).val();
            $('#appointment').modal('show');
            var i = 1;
            data = " ";
            $.ajax({
                type:"GET",
                url:"getAppointments/"+user_id,
                success:function(response){
                    $.each(response,function(index,item){
                        $.each(item,function(key, value){ 
                            if(value.status == 'active')
                            {
                                data =data + "<tr><td>"+i+"</td><td>"+value.visitor_first_name +" "+ value.visitor_last_name+"</td><td>"+value.date+"</td><td>"+value.start_time+"</td><td>"+value.end_time+"</td><td><a class='btn btn-sm btn-success'>Active</a></td></tr>";
                            }else if(value.status == 'inactive')
                            {
                                data =data + "<tr><td>"+i+"</td><td>"+value.visitor_first_name +" "+ value.visitor_last_name+"</td><td>"+value.date+"</td><td>"+value.start_time+"</td><td>"+value.end_time+"</td><td><a class='btn btn-sm btn-danger'>InActive</a></td></tr>";
                            }else
                            {
                                data =data + "<tr><td>"+i+"</td><td>"+value.visitor_first_name +" "+ value.visitor_last_name+"</td><td>"+value.date+"</td><td>"+value.start_time+"</td><td>"+value.end_time+"</td><td><a class='btn btn-sm btn-warning'>Cancalled</a></td></tr>";
                            }
                            i++;
                        });
                    });
                    $('#tblappointment').html(data);
                }
            });
        });
    });

